<?php
session_start();
$uid = intval($_SESSION['uid']);

# Автозагрузка классов
function __autoload($name) {
    include('../class/class.'.$name.'.php');
}

$conf = new config;
$func = new functions;
$base = new database($conf->Host, $conf->User, $conf->Pass, $conf->Base);
$pr = $conf->Pr;
$PDepPoints = $conf->PDepositPoints;
$pay_sys_arr = $conf->PaySysArr;

if (isset($_POST['money']) && $_POST['money'] == 'convert') {
    //$uid = intval($_POST['uid']);
    $amount = floatval($_POST['amount']);
    $error = 0;

    $base->Query("SELECT `money` FROM `".$pr."_users` WHERE `id` = '".$uid."'");
    $money = $base->FetchRow();

    if ($money < $amount or $amount <= 0) {
        $error = 1;
        echo json_encode(array('message' => 'Не достаточно средств', 'status' => 'error'));
        return;
    }

    if ($error == 0) {
        $points = intval($amount * $PDepPoints);
        $base->Query("UPDATE `".$pr."_users` SET `balance` = `balance` + '".$points."', `money` = `money` - '".$amount."', `oborot` = `oborot` + '".$amount."' WHERE `id` = '".$uid."'");
        echo json_encode(array('message' => 'Средства успешно конвертированы!', 'status' => 'success'));
        return;
    }
}


if (isset($_POST['money']) && $_POST['money'] == 'withdrawal') {
    //$uid = intval($_POST['uid']);
    $amount = floatval($_POST['amount']);
    $pay_sys = strval($_POST['pay_sys']);
    $pay_acc = strval($_POST['pay_acc']);

    $error = 0;

    if (!in_array($pay_sys, $pay_sys_arr)) {
        $error = 1;
        echo json_encode(array('message' => 'Не верная валюта', 'status' => 'error'));
        return;
    }
    switch ($pay_sys) {
        case "RUB" : $mbal = "money_rur"; $min_w = 5; break;
        case "USD" : $mbal = "money_usd"; $min_w = 2; break;
        case "COIN" : $mbal = "money_coin"; $min_w = 0.1; break;
    }

    $base->Query("SELECT `".$mbal."`, `payeer` FROM `".$pr."_users` WHERE `id` = '".$uid."'");
    $money_data = $base->FetchArray();

    if ($money_data[$mbal] < $amount or $amount <= 0) {
        $error = 1;
        echo json_encode(array('message' => 'Не достаточно средств', 'status' => 'error'));
        return;
    }
    if ($amount < $min_w) {
        $error = 1;
        echo json_encode(array('message' => 'Минимальный запрос на вывод '.$min_w.' '.$pay_sys, 'status' => 'error'));
        return;
    }

    if ($money_data["payeer"] == null) {
        if ($pay_acc == "") {
            $error = 1;
            echo json_encode(array('message' => 'Не указан кошелек!', 'status' => 'error'));
            return;
        }
        $sql_payeer = ", `payeer` = '".$pay_acc."'";
    } else {
        $pay_acc = $money_data["payeer"];
        $sql_payeer = " ";
    }



    if ($error == 0) {
        $base->Query("UPDATE `".$pr."_users` SET `".$mbal."` = `".$mbal."` - '".$base->Real($amount)."' ".$sql_payeer." WHERE `id` = '".$uid."'");
        $base->Query("INSERT INTO `".$pr."_withdrawal` (`uid`, `amount`, `paysys`, `payacc`, `stat`) VALUES ('".$base->Real($uid)."', '".$base->Real($amount)."', '".$base->Real($pay_sys)."', '".$base->Real($pay_acc)."', '0')");
        $id_w = $base->LastInsert();
        $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$base->Real($uid)."', '".$base->Real($pay_sys)."', '".$base->Real($amount)."', '-', '".$id_w."', 'Запрос на вывод средств отправлен')");
        echo json_encode(array('message' => 'Запрос на вывод успешно отправлен! Время исполнения - 24 часа.', 'status' => 'success'));
        return;
    }
}


if (isset($_POST['money']) && $_POST['money'] == 'send') {
    //$uid = intval($_POST['uid']);
    $amount = floatval($_POST['amount']);
    $reslogin = $base->Real($_POST['reslogin']);  $reslogin = preg_replace('/\s+/', '', $reslogin);
    $pay_sys = strval($_POST['pay_sys']);


    $error = 0;

    if (!in_array($pay_sys, $pay_sys_arr)) {
        $error = 1;
        echo json_encode(array('message' => 'Не верная валюта', 'status' => 'error'));
        return;
    }
    switch ($pay_sys) {
        case "RUB" : $mbal = "money_rur"; $min_w = 1; break;
        case "USD" : $mbal = "money_usd"; $min_w = 1; break;
    }

    $base->Query("SELECT `".$mbal."`, `login` FROM `".$pr."_users` WHERE `id` = '".$uid."'");
    $money_data = $base->FetchArray();

    if ($money_data[$mbal] < $amount or $amount <= 0) {
        $error = 1;
        echo json_encode(array('message' => 'Не достаточно средств', 'status' => 'error'));
        return;
    }

    if ($reslogin == "" or $reslogin == " " or $reslogin == "  ") {
        $error = 1;
        echo json_encode(array('message' => 'Пользователь с таким логином не найден', 'status' => 'error'));
        return;
    }

    $base->Query("SELECT `id` FROM `".$pr."_users` WHERE `login` = '".$reslogin."'");
    if ($base->NumRows() == 0) {
        $error = 1;
        echo json_encode(array('message' => 'Пользователь с таким логином не найден', 'status' => 'error'));
        return;
    } else {
        $id4s = $base->FetchArray();
        $resuid = $id4s["id"];
    }


    if ($error == 0) {
        $base->Query("UPDATE `".$pr."_users` SET `".$mbal."` = `".$mbal."` - '".$base->Real($amount)."' WHERE `id` = '".$uid."'");
        $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$base->Real($uid)."', '".$base->Real($pay_sys)."', '".$base->Real($amount)."', '-', 'send', 'Перевод пользователю ".$reslogin."')");
        $base->Query("UPDATE `".$pr."_users` SET `".$mbal."` = `".$mbal."` + '".$base->Real($amount)."' WHERE `id` = '".$base->Real($resuid)."'");
        $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$base->Real($resuid)."', '".$base->Real($pay_sys)."', '".$base->Real($amount)."', '+', 'send', 'Перевод от пользователя ".$money_data["login"]."')");
        echo json_encode(array('message' => 'Средства успешно отправлены!', 'status' => 'success'));
        return;
    }
}

?>