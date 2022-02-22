
<?php


$_OPTIMIZATION["title"] = "Запросы на вывод";

# Подтверждение Запроса
if (isset($_GET["cancel"])) {
    $сid = intval($_GET["cancel"]);
    $db->Query("SELECT * FROM `".$pref."_withdrawal` WHERE `id` = '".$сid."' AND `stat` = '0'");
    if ($db->NumRows() > 0) {
        $data_w = $db->FetchArray();
        $db->Query("UPDATE `".$pref."_withdrawal` SET `stat` = '6' WHERE `id` = '".$сid."'");
        switch ($data_w["paysys"]) {
            case "RUB" : $mbal = "money_rur";  break;
            case "USD" : $mbal = "money_usd";  break;
            case "COIN" : $mbal = "money_coin";  break;
        }
        $db->Query("UPDATE `".$pref."_users` SET `".$mbal."` = `".$mbal."` + '".$data_w["amount"]."' WHERE `id` = '".$data_w["uid"]."'");
        $db->Query("INSERT INTO `".$pref."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$db->Real($data_w["uid"])."', '".$db->Real($data_w["paysys"])."', '".$db->Real($data_w["amount"])."', '+', '".$data_w["id"]."', 'Отмена вывода. Возврат')");

    }
}

if (isset($_GET["confirm"])) {
    $oid = intval($_GET["confirm"]);

    $db->Query("SELECT * FROM `".$pref."_withdrawal` WHERE `id` = '".$oid."' AND `stat` = '0'");
    if ($db->NumRows() > 0) {
        $data_w = $db->FetchArray();
        $amount4with = $data_w["amount"];
        $sys4with = $data_w["paysys"];

        if (isset($_GET["valuta"])) {
            switch ($_GET["valuta"]) {
                case "usd" :
                    $amount4with =  $amount4with * $conf->PacksCoinCourse[0];
                    $sys4with = "USD";
                    break;
                case "rub" :
                    $amount4with =  $amount4with * $conf->PacksCoinCourse[1];
                    $sys4with = "RUB";
                    break;
                default :
                    $amount4with =  $amount4with * $conf->PacksCoinCourse[1];
                    $sys4with = "RUB";
                    break;
            }
        }

        $admin_profit = $amount4with * $conf->AdmPercWithdraw;
        $sum2withdrawal = round($amount4with - $admin_profit, 2);

        require_once('../includes/cpayeer.php');
        $accountNumber = $conf->PayeerWithdrawAcc;
        $apiId = $conf->PayeerWithdrawId;
        $apiKey = $conf->PayeerWithdrawSecret;
        $payeer = new CPayeer($accountNumber, $apiId, $apiKey);
        if ($payeer->isAuth()) {
            $arTransfer = $payeer->transfer(array(
                'curIn' => $sys4with,
                'sum' => $sum2withdrawal,
                'curOut' => $sys4with,
                //'sumOut' => 1,
                'to' => $data_w["payacc"],
                //'to' => 'client@mail.com',
                'comment' => $_SERVER['HTTP_HOST'],
                //'anonim' => 'Y',
                //'protect' => 'Y',
                //'protectPeriod' => '3',
                //'protectCode' => '12345',
            ));
            if (empty($arTransfer['errors'])) {
                $db->Query("UPDATE `".$pref."_withdrawal` SET `stat` = '1' WHERE `id` = '".$oid."'");
                $db->Query("UPDATE `".$pref."_transactions` SET `descr` = 'Средства успешно выведены' WHERE `type_tr` = '".$data_w["id"]."'");

                switch ($sys4with) {
                    case "RUB" : $mbal = "money_rur"; $mprof = "profit_rur"; break;
                    case "USD" : $mbal = "money_usd"; $mprof = "profit_usd"; break;
                }
                $db->Query("UPDATE `".$pref."_admin_auth` SET `".$mbal."` = `".$mbal."` + '".$admin_profit."', `".$mprof."` = `".$mprof."` + '".$admin_profit."' WHERE `id` = '1'");
            } else { echo '<pre>'.print_r($arTransfer["errors"], true).'</pre>'; }
        } else { echo '<pre>'.print_r($payeer->getErrors(), true).'</pre>'; }
    }
}
?>


<?php
$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) - 1) : 0;
$lim = $num_p * 50;
$db->Query("SELECT * FROM `".$pref."_withdrawal` WHERE `stat` = '0' ORDER BY `id` ASC LIMIT ".$lim.", 50");
?>

<table class="table_info" style="width: 770px; font-size: 11px;">
    <thead>
        <tr>
            <td>№</td>
            <td>UserID</td>
            <td>Сумма</td>
            <td>Платежка</td>
            <td>Кошелек</td>
            <td>Дата</td>
            <td>Действие</td>
        </tr>
    </thead>
    <?php
    if ($db->NumRows() > 0) {
        while($data_orders = $db->FetchArray()) {
            ?>
			<tr>
				<td><?=$data_orders['id']; ?></td>
				<td><a class="link" href="?menu=auth&sel=users&edit=<?=$data_orders['uid']; ?>"><?=$data_orders['uid']; ?></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="/gogi130780gogi/?menu=auth&sel=users_auth&uid=<?=$data_orders['uid']; ?>" target="_blank">Войти</a>
                </td>
                <td><span style="color:#ff0000;"><?=$data_orders['amount']; ?> </span>
                    <?php
                        $minusperc = 0;
                        switch ($data_orders["paysys"]) {
                            case "RUB" : $minusperc = $data_orders['amount']-($data_orders['amount']*$conf->AdmPercWithdraw);  break;
                            case "USD" : $minusperc = $data_orders['amount']-($data_orders['amount']*$conf->AdmPercWithdraw);  break;
                            case "COIN" :
                                $musd =  $data_orders['amount'] * $conf->PacksCoinCourse[0]; $musd = $musd - ($musd * $conf->AdmPercWithdraw);
                                $mrub =  $data_orders['amount'] * $conf->PacksCoinCourse[1]; $mrub = $mrub - ($mrub * $conf->AdmPercWithdraw);
                                $minusperc = "<br>".round($mrub, 2)." руб. / $".round($musd, 2);
                                break;
                        }
                    ?>

                    <i style="color: #009906;"><?=$minusperc?></i>
                <br>
                    <a class="link" href="?menu=auth&sel=withdrawal&cancel=<?=$data_orders['id']; ?>">Отмена</a>
                </td>
				<td><?=$data_orders["paysys"]; ?></td>
				<td><?=$data_orders["payacc"]; ?></td>
				<td><?=$data_orders["date"]; ?></td>
                <td>
                    <?php
                    if ($data_orders["paysys"] == "COIN") {
                        echo '<a class="link" href="?menu=auth&sel=withdrawal&confirm='.$data_orders['id'].'&valuta=rub">Выплатить в RUB</a><br>';
                        echo '<a class="link" href="?menu=auth&sel=withdrawal&confirm='.$data_orders['id'].'&valuta=usd">Выплатить в USD</a>';
                    } else {
                        echo '<a class="link" href="?menu=auth&sel=withdrawal&confirm='.$data_orders['id'].'">Выплатить</a>';
                    }
                    ?>
                </td>
  			</tr>
            <?php
		}
    } else echo '<div class="message_error">Нет запросов!</div>';
	?>
</table>

<?php
$db->Query("SELECT COUNT(*) FROM `".$pref."_withdrawal` WHERE `stat` = '0' ");
$all_pages = $db->FetchRow();
if ($all_pages > 50) {
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	echo '<div style="text-align: center">'.$nav->Navigation(10, $page, ceil($all_pages / 50), '/gogi130780gogi/?menu=auth&sel=withdrawal&page='), '</div>';
}
?>
