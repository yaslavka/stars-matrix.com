<?php

// ФУНКЦИЯ:  ОПРЕДЕЛЕНИЕ СПОНСОРА
function getsponsor($guid) {
    $config = new config;
    $base = new database($config->Host, $config->User, $config->Pass, $config->Base);
    $pr = $config->Pr;

    $base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$guid."'");
    if ($base->NumRows() > 0) {
        $data_sponsor = $base->FetchArray();
        $sponsor_id = $data_sponsor["referer"]; if ($sponsor_id <= 0) { $sponsor_id = 1; }
    } else {
        $sponsor_id = end($config->AdminsAcc);
    }
    return $sponsor_id;
}
// ---------


// ФУНКЦИЯ:  ОПРЕДЕЛЕНИЕ АКТИВНОГО СПОНСОРА
function getsponsor_act($guid) {
    $config = new config;
    $base = new database($config->Host, $config->User, $config->Pass, $config->Base);
    $pr = $config->Pr;
    $base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$guid."'");
    if ($base->NumRows() > 0) {
        $data_sponsor = $base->FetchArray();
        $sponsor_id = $data_sponsor["referer"]; if ($sponsor_id <= 0) { $sponsor_id = 1; }
        $base->Query("SELECT `pid` FROM `".$pr."_orders` WHERE `uid` = '".$sponsor_id."' AND `stat` = '2'");
        if ($base->NumRows() == 0) { $sponsor_id = getsponsor_act($sponsor_id); }
    } else {
        $sponsor_id = end($config->AdminsAcc);
    }
    return $sponsor_id;
}
// ---------

// ФУНКЦИЯ:  ПОИСКА СПОНСОРА
function findsponsor($guid, $finduid) {
    $config = new config;
    $base = new database($config->Host, $config->User, $config->Pass, $config->Base);
    $pr = $config->Pr;
    $base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$guid."'");
    if ($base->NumRows() > 0) {
        $data_sponsor = $base->FetchArray();
        $sponsor_id = $data_sponsor["referer"];
        if ($sponsor_id <= 0) { $finded = false; return $finded;}
        if ($sponsor_id == $finduid) { $finded = true; } else { $finded = findsponsor($sponsor_id, $finduid); }
    } else {
        $finded = false;
    }
    return $finded;
}
// ---------


?>