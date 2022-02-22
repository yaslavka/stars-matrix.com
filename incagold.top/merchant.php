<?php
session_start();


//if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

include('class/class.config.php');
include('class/class.database.php');


$config = new config;
$base = new database($config->Host, $config->User, $config->Pass, $config->Base);
$pr = $config->Pr;


if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])) {
    $m_key = $config->PayeerMerchantSecret;

    $arHash = array(
        $_POST['m_operation_id'],
        $_POST['m_operation_ps'],
        $_POST['m_operation_date'],
        $_POST['m_operation_pay_date'],
        $_POST['m_shop'],
        $_POST['m_orderid'],
        $_POST['m_amount'],
        $_POST['m_curr'],
        $_POST['m_desc'],
        $_POST['m_status']
    );

    if (isset($_POST['m_params'])) {
        $arHash[] = $_POST['m_params'];
    }

    $arHash[] = $m_key;

    $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

    if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success') {

        $base->Query("SELECT `type_tr` FROM `".$pr."_transactions` WHERE `type_tr` = '".$base->Real($_POST['m_operation_id'])."'");
        if ($base->NumRows() == 0) {
            if ($_POST['m_curr'] == "USD") {
                $m_bal = "money_usd";
            } else {
                $m_bal = "money_rur";
            }
            $base->Query("UPDATE `".$pr."_users` SET `".$m_bal."` = `".$m_bal."` + '".$base->Real($_POST['m_amount'])."' WHERE `id` = '".$base->Real($_POST['m_orderid'])."'");
            $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$base->Real($_POST['m_orderid'])."', '".$base->Real($_POST['m_curr'])."', '".$base->Real($_POST['m_amount'])."', '+', '".$base->Real($_POST['m_operation_id'])."', 'Пополнение счета')");
        }
        echo $_POST['m_orderid'].'|success';
        exit;
    }

    echo $_POST['m_orderid'].'|error';
}


?>