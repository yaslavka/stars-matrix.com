<?php
ini_set('display_errors','Off');
error_reporting(E_ALL | E_STRICT);

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

session_start();

# Автозагрузка классов
function __autoload($name) {
    include('class/class.'.$name.'.php');
}

$conf = new config;
$func = new functions;
$mail = new mail;
$base = new database($conf->Host, $conf->User, $conf->Pass, $conf->Base);
$pr = $conf->Pr;


$array_cron = array();
if (isset($_GET["packs"]) && $_GET["packs"] == "go") {              // запускать - каждую минуту
    $array_cron[] = "packs";
}


$PercGo = $conf->PacksDayPercent;
$IntervalGo = $conf->PacksInterval;


/* НАЧИСЛЕНИЕ АКТИВОВ */
//if (in_array("packs", $array_cron)) {   //echo "+packs";
    /*  Выборка пакетов для начисления  */
    $base->Query("SELECT * FROM `".$pr."_packs` WHERE `stat` = '0' AND `profit` < `profitgoal` AND (`datelastget` < NOW() - INTERVAL ".$IntervalGo." SECOND OR `datelastget` IS NULL)");
    $packs_data = array();
    while ($data = $base->FetchArray()) {
        $packs_data[] = $data["id"];
    }
    /*  Конец - Выборка пакетов  */


    foreach ($packs_data as $res_id) {
        $base->Query("SELECT * FROM `".$pr."_packs` WHERE `id` = '".$res_id."' ");
        $data = $base->FetchArray();
        $plus = $data["amount"] * $PercGo;
        $plus = round($plus, 7);
        $statend = "";
        if ($data["profit"] + $plus >= $data["profitgoal"]) { $statend = ", `stat` = '1' "; }
        $base->Query("UPDATE `".$pr."_packs` SET `profit` = `profit` + '".$plus."', `datelastget` = NOW() ".$statend." WHERE `id` = '".$res_id."'");
        $base->Query("UPDATE `".$pr."_users` SET `money_coin` = `money_coin` + '".$plus."', `profit_coin` = `profit_coin` + '".$plus."' WHERE `id` = '".$data["uid"]."'");
    }

//}
/* КОНЕЦ - НАЧИСЛЕНИЕ АКТИВОВ  */




?>