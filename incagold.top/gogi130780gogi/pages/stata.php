
<?php


$_OPTIMIZATION["title"] = "Статистика";


#ДЕРЕБАН ПРИБЫЛИ
if (isset($_GET["dereban"]) && $_GET["dereban"] == "go") {
    $AdminAccSend = array(2, 3, 4); // id админских аккаунтов для деребана

    $db->Query("SELECT * FROM `".$pref."_admin_auth` WHERE `id` = '1'");
    $data_ub = $db->FetchArray();

    $na_troix = 0;
    if ($data_ub["money_packs_rub"] > 0) {
        $na_troix = $data_ub["money_packs_rub"] / 3;
        $db->Query("UPDATE `".$pref."_admin_auth` SET `money_packs_rub` = '0' WHERE `id` = '1'");
        for ($i = 0; $i < 3; $i++) {
            $db->Query("UPDATE `".$pref."_users` SET `money_rur` = `money_rur` + '".$na_troix."' WHERE `id` = '".$AdminAccSend[$i]."'");
            $db->Query("INSERT INTO `".$pref."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$AdminAccSend[$i]."', 'RUB', '".$na_troix."', '+', 'adminprofitcoin', 'Начисление командной-админской прибыли с HDC')");
        }
    }

    $na_troix = 0;
    if ($data_ub["money_packs_usd"] > 0) {
        $na_troix = $data_ub["money_packs_usd"] / 3;
        $db->Query("UPDATE `".$pref."_admin_auth` SET `money_packs_usd` = '0' WHERE `id` = '1'");
        for ($i = 0; $i < 3; $i++) {
            $db->Query("UPDATE `".$pref."_users` SET `money_usd` = `money_usd` + '".$na_troix."' WHERE `id` = '".$AdminAccSend[$i]."'");
            $db->Query("INSERT INTO `".$pref."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$AdminAccSend[$i]."', 'USD', '".$na_troix."', '+', 'adminprofitcoin', 'Начисление командной-админской прибыли с HDC')");
        }
    }

    $na_troix = 0;
    if ($data_ub["money_packs_coin"] > 0) {
        $na_troix = $data_ub["money_packs_coin"] / 3;
        $db->Query("UPDATE `".$pref."_admin_auth` SET `money_packs_coin` = '0' WHERE `id` = '1'");
        for ($i = 0; $i < 3; $i++) {
            $db->Query("UPDATE `".$pref."_users` SET `money_coin` = `money_coin` + '".$na_troix."' WHERE `id` = '".$AdminAccSend[$i]."'");
            $db->Query("INSERT INTO `".$pref."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$AdminAccSend[$i]."', 'COIN', '".$na_troix."', '+', 'adminprofitcoin', 'Начисление командной-админской прибыли с HDC')");
        }
    }

}




$db->Query("SELECT * FROM `".$pref."_admin_auth` WHERE `id` = '1'");
$admin_profit = $db->FetchArray();



$db->Query("SELECT SUM(`money_rur`) FROM `".$pref."_users`");
$rub_balans = $db->FetchRow();

$db->Query("SELECT SUM(`reserve_rur`) FROM `".$pref."_users`");
$rub_reserve = $db->FetchRow();

$db->Query("SELECT SUM(`profit_rur`) FROM `".$pref."_users`");
$rub_profit = $db->FetchRow();

$db->Query("SELECT SUM(`amount`) FROM `".$pref."_transactions` WHERE `val` = 'RUB' AND `type` = '+' AND `type_tr` REGEXP '^[0-9]+$' ");
$rub_deposit = $db->FetchRow();

$db->Query("SELECT SUM(`amount`) FROM `".$pref."_withdrawal` WHERE `paysys` = 'RUB' AND `stat` = '1'");
$rub_withdrawal = $db->FetchRow();

$db->Query("SELECT SUM(`price`) FROM `".$pref."_matrix` WHERE `currency` = 'RUB' AND `matrix` = '1' AND `uid` <> '0'");
$rub_matrix = $db->FetchRow();






$db->Query("SELECT SUM(`money_usd`) FROM `".$pref."_users`");
$usd_balans = $db->FetchRow();

$db->Query("SELECT SUM(`reserve_usd`) FROM `".$pref."_users`");
$usd_reserve = $db->FetchRow();

$db->Query("SELECT SUM(`profit_usd`) FROM `".$pref."_users`");
$usd_profit = $db->FetchRow();

$db->Query("SELECT SUM(`amount`) FROM `".$pref."_transactions` WHERE `val` = 'USD' AND `type` = '+' AND `type_tr` REGEXP '^[0-9]+$' ");
$usd_deposit = $db->FetchRow();

$db->Query("SELECT SUM(`amount`) FROM `".$pref."_withdrawal` WHERE `paysys` = 'USD' AND `stat` = '1'");
$usd_withdrawal = $db->FetchRow();

$db->Query("SELECT SUM(`price`) FROM `".$pref."_matrix` WHERE `currency` = 'USD' AND `matrix` = '1' AND `uid` <> '0'");
$usd_matrix = $db->FetchRow();






$db->Query("SELECT SUM(`money_coin`) FROM `".$pref."_users`");
$coin_balans = $db->FetchRow();

$db->Query("SELECT SUM(`profit_coin`) FROM `".$pref."_users`");
$coin_profit = $db->FetchRow();

$db->Query("SELECT SUM(`amount`) FROM `".$pref."_withdrawal` WHERE `paysys` = 'COIN' AND `stat` = '1'");
$coin_withdrawal = $db->FetchRow();

$db->Query("SELECT SUM(`amount`) FROM `".$pref."_packs`");
$coin_matrix = $db->FetchRow();



?>
<style>
    .bdd .col-sm-3 {
        color: #ff0000;
    }
    .ddssr {
        color: #999!important;
    }
</style>

<div class="row">
    <div class="col-sm-3 col-lg-3 ddssr"></div>
    <div class="col-sm-3 col-lg-3">Рубли</div>
</div>
<div class="bdd">
<br>
<div class="row">
    <div class="col-sm-3 ddssr">Всего пополнено: </div>
    <div class="col-sm-3"><?=round($rub_deposit,2);?> руб.</div>
    <div class="col-sm-3"></div>
</div>
<br>
<div class="row">
    <div class="col-sm-3 ddssr">Всего выведено: </div>
    <div class="col-sm-3"><?=round($rub_withdrawal,2);?> руб.</div>
</div>
<br>
<div class="row">
    <div class="col-sm-3 ddssr">Всего на балансах:</div>
    <div class="col-sm-3"><?=round($rub_balans,2);?> руб.</div>
</div>
<br>
<div class="row">
    <div class="col-sm-3 ddssr">Всего на резервных балансах: </div>
    <div class="col-sm-3"><?=round($rub_reserve,2);?> руб.</div>
    <div class="col-sm-3"></div>
</div>
<br>
<div class="row">
    <div class="col-sm-3 ddssr">Всего прибыли у участников: </div>
    <div class="col-sm-3"><?=round($rub_profit,2);?> руб.</div>
</div>
<br>
<div class="row">
    <div class="col-sm-3 ddssr">Сумма купленых матриц: </div>
    <div class="col-sm-3"><?=round($rub_matrix,2);?> руб.</div>
</div>
<br>
<br>
<br>
<div class="row">
    <div class="col-sm-3 ddssr">Админская прибыль (текущий баланс): </div>
    <div class="col-sm-3"><?=round($admin_profit["money_rur"],2);?> руб.</div>
                            
                            
                            
                            
    
    <div class="col-sm-3"></div>
</div>
<br>
<div class="row">
    <div class="col-sm-3 ddssr">Админская прибыль за всё время: </div>
    <div class="col-sm-3"><?=round($admin_profit["profit_rur"],2);?> руб.</div>

    <div class="col-sm-3"></div>
</div>


</div>





















            <div class="row">
                <div class="col-sm-12">
                    <div class="bottom-section text-center">
                        <div class="row">
                            <?php $uptime_co = 2; ?>
                            <div class="col-sm-3 col-xs-6">
                                <div class="left-section section">
                                    <h2><i class="fa fa-users" aria-hidden="true"></i><span class="sr-only">icon</span>
                                    </h2>
                                    <h3>
                                        <?php
                                        $cookname = "h_invday";
                                        if (isset($_COOKIE[$cookname])) {
                                            $content = $_COOKIE[$cookname];
                                        } else {
                                     $content = (time()+1000152300)/6000000;
                                            $content = round($content);
                                            setcookie($cookname, $content, time() + $uptime_co);
                                        }
                                        echo number_format($content, 0, '', ' ');
                                        ?>
                                    </h3>
                                
                   
<script src="/lp/js/jquery1.12.4.jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript"
        src="http://maps.google.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U"></script>
<script src="/lp/js/gmaps.min.js"></script>
<script type="text/javascript" src="/lp/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
<script type="text/javascript" src="/lp/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
<script type="text/javascript" src="/lp/js/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="/lp/js/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="/lp/js/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="/lp/js/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="/lp/js/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="/lp/js/revolution.extension.actions.min.js"></script>
<script src="/lp/js/bootstrap.min.js"></script>
<script src="/lp/js/jquery.responsiveTabs.min.js"></script>
<script src="/lp/js/owl.carousel.min.js"></script>
<script src="/lp/js/jquery.fancybox.pack.js"></script>
<script src="/lp/js/jquery.fancybox-thumbs.js"></script>
<script src="/lp/js/wow.js"></script>
<script src="/lp/js/script.js"></script>
<script>


</script>
</body>
</html>
