<?php


function Payment_BuyMatrix($matrix, $currency, $price, $uid, $type) {     // Матрица (номер), Валюта, Цена, Юзер ID, Тип(buy/upgrade/reinvest)
    $config = new config;
    $base = new database($config->Host, $config->User, $config->Pass, $config->Base);
    $pr = $config->Pr;

    $matrix_up1 = $config->MatrixPercent[1];
    $matrix_up2 = $config->MatrixPercent[2];

    $matrix = $base->Real($matrix);
        if ($matrix < 1) { $matrix = 1; }
        if ($matrix > 3) { $matrix = 3; }
    $currency = $base->Real($currency);
        if ($currency == "RUB") {
            if ($type == "buy") { $sql_cur = "money_rur"; } else { $sql_cur = "reserve_rur"; }
            $sql_money = "money_rur";
            $sql_reserve = "reserve_rur";
            $sql_profit = "profit_rur";
        }
        if ($currency == "USD") {
            if ($type == "buy") { $sql_cur = "money_usd"; } else { $sql_cur = "reserve_usd"; }
            $sql_money = "money_usd";
            $sql_reserve = "reserve_usd";
            $sql_profit = "profit_usd";
        }
    $price = $base->Real($price);
    $uid = $base->Real($uid);
    $type = $base->Real($type);

    $sql_matrix = "`matrix` = '".$matrix."' AND `currency` = '".$currency."' AND `price` = '".$price."'";

    $base->Query("SELECT `id` FROM `".$pr."_matrix` WHERE ".$sql_matrix." AND `uid` = '".$uid."' AND `stat` = '0' ");
    if ($type == "buy") {
        if ($base->NumRows() > 0) return "AlreadyExists";
    }

    $base->Query("SELECT `".$sql_cur."`, `referer` FROM `".$pr."_users` WHERE `id` = '".$uid."'");
    $user_data = $base->FetchArray();
    if ($user_data[$sql_cur] < $price) return "SumError";

    $to_refererr = $user_data["referer"];

    if ($to_refererr == 0) {
        for ($isql = 0; $isql <= 2; $isql++) {
            $base->Query("SELECT `uid` FROM `".$pr."_matrix` WHERE ".$sql_matrix." AND `stat` = '0' AND `count_ref` = '".$isql."' ORDER BY `id` ASC LIMIT 1");
            if ($base->NumRows() > 0) {
                $to_refererr = $base->FetchRow();
                        $slctr = rand(1, 100);
                        if ($slctr < 40) {
                            $slctr = rand(1, 100);
                            $to_refererr = 2;
                            if ($slctr < 20) { $to_refererr = 3; }
                            if ($slctr > 80) { $to_refererr = 4; }
                        }
                $isql += 100;
            }
        }
    }


    $isset_matrix = 0;
    while ($isset_matrix == 0) {
        $base->Query("SELECT * FROM `".$pr."_matrix` WHERE ".$sql_matrix." AND `uid` = '".$to_refererr."' AND `stat` = '0' ");
        $isset_matrix = $base->NumRows();
        if ($to_refererr == 0 && $isset_matrix == 0) {
            $base->Query("INSERT INTO `".$pr."_matrix` (`matrix`, `currency`, `price`, `uid`, `stat`, `referr_m_id`, `count_ref`)
        VALUES ('".$matrix."', '".$currency."', '".$price."', '0', '0', '0', '0')");
            $user_matrix["id"] = $base->LastInsert();
            $user_matrix["uid"] = 1;
            $user_matrix["count_ref"] = 0;
            $user_matrix["referr_m_id"] = $user_matrix["id"];
            $base->Query("UPDATE `".$pr."_matrix` SET `referr_m_id` = '".$user_matrix["id"]."' WHERE `id` = '".$user_matrix["id"]."'");
        } else {
            if ($isset_matrix == 0) {
                $base->Query("SELECT `referer` FROM `".$pr."_users` WHERE `id` = '".$to_refererr."'");
                $user_data = $base->FetchArray();
                $to_refererr = $user_data["referer"];
            } else {
                $user_matrix = $base->FetchArray();
            }
        }
    }


    if ($user_matrix["count_ref"] < 3) {
        $podkogo = $user_matrix["id"];
    } else {
        $base->Query("SELECT * FROM `".$pr."_matrix` WHERE ".$sql_matrix." AND `referr_m_id` = '".$user_matrix["id"]."' AND `count_ref` < '3' ORDER BY RAND() LIMIT 1");
        $user_matrix = $base->FetchArray();
        $podkogo = $user_matrix["id"];
    }


    $base->Query("INSERT INTO `".$pr."_matrix` (`matrix`, `currency`, `price`, `uid`, `stat`, `referr_m_id`, `count_ref`)
    VALUES ('".$matrix."', '".$currency."', '".$price."', '".$uid."', '0', '".$podkogo."', '0')");
    $base->Query("UPDATE `".$pr."_users` SET `".$sql_cur."` = `".$sql_cur."` - '".$price."' WHERE `id` = '".$uid."'");
    switch ($type) {
        case "buy" : $sql_descr = "Покупка ".$matrix."-й платформы"; break;
        case "upgrade" : $sql_descr = "Апгрейд на ".$matrix."-ю платформу"; break;
        case "reinvest" : $sql_descr = "Реинвест ".$matrix."-й платформы"; break;
    }
    $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$uid."', '".$currency."', '".$price."', '-', '".$type."', '".$sql_descr."')");


    if ($matrix == 1) {
        $matrix_upgrade = $matrix + 1;
        $price_upgrade = $price * $matrix_up1 / 100;
        if ($user_matrix["count_ref"] < 3) {
            $sql_stat = "";
            switch ($user_matrix["count_ref"]) {
                case 0 : $sql_m_plus = $sql_money; break;
                case 1 : $sql_m_plus = $sql_reserve; break;
                case 2 : $sql_m_plus = $sql_reserve; $sql_stat = " `stat` = '1', "; break;
            }
            $base->Query("UPDATE `".$pr."_users` SET `".$sql_m_plus."` = `".$sql_m_plus."` + '".$price."', `".$sql_profit."` = `".$sql_profit."` + '".$price."' WHERE `id` = '".$user_matrix["uid"]."'");
            $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$user_matrix["uid"]."', '".$currency."', '".$price."', '+', '".$type."', 'Начисление с ".$matrix."-й платформы')");
            $base->Query("UPDATE `".$pr."_matrix` SET ".$sql_stat." `count_ref` = `count_ref` + '1' WHERE `id` = '".$user_matrix["id"]."'");
            if ($user_matrix["count_ref"] == 2) {
                //echo "2, ".$currency.", ".$price_upgrade.", ".$user_matrix["uid"].", upgrade";
                echo "<br>m1up = ". Payment_BuyMatrix($matrix_upgrade, $currency, $price_upgrade, $user_matrix["uid"], "upgrade");
            }
        }
    }

    if ($matrix >= 2) {
        $matrix_reinvest = $matrix - 1;
        $matrix_upgrade = $matrix + 1;
        $need_reinvest = 0;
        $sql_m_plus = $sql_money;
        $sql_m_plus2 = $sql_reserve;

        if ($matrix == 2) {
            $price_reinvest = $price * 0.5;
            $price_now = $price * 0.5;
            $price_upgrade = $price * $matrix_up2 / 100;
        }
        if ($matrix == 3) {
            $price_reinvest = $price * 0.22223; $price_reinvest = round($price_reinvest);
            $price_now = $price * 0.77778; $price_now = round($price_now);
            //$price_upgrade = $price * $matrix_up2 / 100;
            $sql_m_plus2 = $sql_money;
        }

        if ($user_matrix["count_ref"] < 3) {
            if ($user_matrix["count_ref"] == 0 && $matrix < 3) {
                $base->Query("SELECT `id` FROM `".$pr."_matrix` WHERE `matrix` = '".$matrix_reinvest."' AND `currency` = '".$currency."' AND `price` = '".$price_reinvest."' AND `uid` = '".$user_matrix["uid"]."' AND `stat` = '0' ");
                if ($base->NumRows() == 0) {
                    $need_reinvest = 1;
                    $sql_m_plus = $sql_reserve;
                }
            }

            $base->Query("UPDATE `".$pr."_users` SET `".$sql_m_plus."` = `".$sql_m_plus."` + '".$price_reinvest."', `".$sql_profit."` = `".$sql_profit."` + '".$price_reinvest."' WHERE `id` = '".$user_matrix["uid"]."'");
            $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$user_matrix["uid"]."', '".$currency."', '".$price_reinvest."', '+', '".$type."', 'Начисление с ".$matrix."-й платформы')");
            $base->Query("UPDATE `".$pr."_matrix` SET  `count_ref` = `count_ref` + '1' WHERE `id` = '".$user_matrix["id"]."'");

            $base->Query("SELECT * FROM `".$pr."_matrix` WHERE `id` = '".$user_matrix["referr_m_id"]."'");
            $user_matrix2 = $base->FetchArray();
            $base->Query("UPDATE `".$pr."_users` SET `".$sql_m_plus2."` = `".$sql_m_plus2."` + '".$price_now."', `".$sql_profit."` = `".$sql_profit."` + '".$price_now."' WHERE `id` = '".$user_matrix2["uid"]."'");
            $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$user_matrix2["uid"]."', '".$currency."', '".$price_now."', '+', '".$type."', 'Начисление с ".$matrix."-й платформы')");
            $base->Query("UPDATE `".$pr."_matrix` SET  `count_ref_2` = `count_ref_2` + '1' WHERE `id` = '".$user_matrix2["id"]."'");

            if ($user_matrix2["count_ref_2"] >= 8 && $matrix == 2) {
                $base->Query("UPDATE `".$pr."_matrix` SET  `stat` = '1' WHERE `id` = '".$user_matrix2["id"]."'");
                echo "<br>m2up = ". Payment_BuyMatrix($matrix_upgrade, $currency, $price_upgrade, $user_matrix2["uid"], "upgrade");
            }

            if ($need_reinvest == 1) {
                echo "<br>mR = ". Payment_BuyMatrix($matrix_reinvest, $currency, $price_reinvest, $user_matrix["uid"], "reinvest");
            }
        }
    }




    return "ok";
}









function Payment_BuyPacks($currency, $payamount, $uid) {
    $config = new config;
    $base = new database($config->Host, $config->User, $config->Pass, $config->Base);
    $pr = $config->Pr;

    $kurs_usd = $config->PacksCoinCourse[0];
    $kurs_rub = $config->PacksCoinCourse[1];

    $ref_lvl1 = $config->PacksRefPercent[0];
    $ref_lvl2 = $config->PacksRefPercent[1];

    $FirstDepoMax = $config->PacksFirstDepoMax;
    $SecondDepoPerc = $config->PacksSecondDepoPerc;
    $NetProfitGoal = $config->PacksProfitGoal;
    $MaxAllDepo = $config->PacksMaxDepo;

    $AdminPercent = $config->PacksAdminPercent;

    $pay_sys_arr = $config->PaySysArr;
    if (!in_array($currency, $pay_sys_arr)) { return array("ErrorNoPaySys", ""); }

    $uid = $base->Real($uid);
    $payamount = $base->Real(floatval($payamount));
    $currency = $base->Real($currency);
    switch ($currency) {
        case "COIN" :
            $sql_money = "money_coin";
            $sql_profit = "profit_coin";
            $sql_money_admin = "money_packs_coin";
            $sql_profit_admin = "profit_packs_coin";
            $needmoney = $payamount;
            $buycoin = $payamount;
            $Get4Admin = $needmoney * $AdminPercent;
            $Get4Ref_1 = $needmoney * $ref_lvl1;
            $Get4Ref_2 = $needmoney * $ref_lvl2;
            $mindepo = 0.001;
            break;
        case "USD" :
            $sql_money = "money_usd";
            $sql_profit = "profit_usd";
            $sql_money_admin = "money_packs_usd";
            $sql_profit_admin = "profit_packs_usd";
            $needmoney = $payamount;
            $buycoin = round($payamount / $kurs_usd, 7);
            $Get4Admin = $needmoney * $AdminPercent;
            $Get4Ref_1 = $needmoney * $ref_lvl1;
            $Get4Ref_2 = $needmoney * $ref_lvl2;
            $mindepo = 0.1;
            break;
        case "RUB" :
            $sql_money = "money_rur";
            $sql_profit = "profit_rur";
            $sql_money_admin = "money_packs_rub";
            $sql_profit_admin = "profit_packs_rub";
            $needmoney = $payamount;
            $buycoin = round($payamount / $kurs_rub, 7);
            $Get4Admin = $needmoney * $AdminPercent;
            $Get4Ref_1 = $needmoney * $ref_lvl1;
            $Get4Ref_2 = $needmoney * $ref_lvl2;
            $mindepo = 1;
            break;
    }
    $base->Query("SELECT `".$sql_money."`, `referer` FROM `".$pr."_users` WHERE `id` = '".$uid."'");
    $user_data = $base->FetchArray();
    if ($user_data[$sql_money] < $needmoney) { return array("ErrorSum", ""); }

    if ($needmoney < $mindepo) { return array("ErrorMinSum", $mindepo." ".$currency); }

    // Определение споносров для рефских
    $uid_ref1 = $user_data["referer"];
    $base->Query("SELECT `referer` FROM `".$pr."_users` WHERE `id` = '".$uid_ref1."'");
    if ($base->NumRows() != 0) {
        $uid_ref2 = $base->FetchRow();
    } else { $uid_ref2 = 0; }


    // Определение допустимого количества покупки коинов
    $base->Query("SELECT SUM(`amount`) FROM `".$pr."_packs` WHERE `uid` = '".$uid."' AND `stat` = '0' ");
    $sum_packs = $base->FetchRow();
    if ($sum_packs < $FirstDepoMax) {
        $canpercent = $sum_packs * $SecondDepoPerc;
        $canpay = $FirstDepoMax - $sum_packs;
        if ($canpay < $canpercent) { $canpay = $canpercent; }
    } else {
        $base->Query("SELECT SUM(`amount`) FROM `".$pr."_packs` WHERE `uid` = '".$uid."' AND `stat` = '0' 
        AND `datepay` > CURDATE()");        // dateadd(DAY, datediff(day, 0, getdate()),0)
        $sum_packs_nowday = $base->FetchRow();
        $canpercent = ($sum_packs - $sum_packs_nowday) * $SecondDepoPerc;
        if ($sum_packs_nowday < $canpercent) {
            $canpay = $canpercent - $sum_packs_nowday;
            if ($canpay < 0.001) { $canpay = 0; }
        } else { $canpay = 0; }
    }

    if ($buycoin > $canpay) { return array("ErrorLimit", $canpay); }
    if ($sum_packs > $MaxAllDepo) { return array("ErrorMaxLimit", ""); }

    $ProfitGoal = $buycoin + ($buycoin * $NetProfitGoal);


    $base->Query("INSERT INTO `".$pr."_packs` (`uid`, `amount`, `profit`, `datelastget`, `profitgoal`, `stat`) VALUES ('".$uid."', '".$buycoin."', '0', NOW(), '".$ProfitGoal."', '0')");
    $base->Query("UPDATE `".$pr."_users` SET `".$sql_money."` = `".$sql_money."` - '".$needmoney."' WHERE `id` = '".$uid."' ");
    $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$uid."', '".$currency."', '".$needmoney."', '-', 'buycoin', 'Депозит ".$buycoin." HoliDay Coin')");


    // Реферальные отчисления
    if ($uid_ref1 > 0) {
        $base->Query("UPDATE `".$pr."_users` SET `".$sql_money."` = `".$sql_money."` + '".$Get4Ref_1."', `".$sql_profit."` = `".$sql_profit."` + '".$Get4Ref_1."' WHERE `id` = '".$uid_ref1."' ");
        $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$uid_ref1."', '".$currency."', '".$Get4Ref_1."', '+', 'refcoin', 'Реферальные начисления HoliDay Coin с 1-го уровня')");
    } else { $Get4Admin += $Get4Ref_1; }

    if ($uid_ref2 > 0) {
        $base->Query("UPDATE `".$pr."_users` SET `".$sql_money."` = `".$sql_money."` + '".$Get4Ref_2."', `".$sql_profit."` = `".$sql_profit."` + '".$Get4Ref_2."' WHERE `id` = '".$uid_ref2."' ");
        $base->Query("INSERT INTO `".$pr."_transactions` (`uid`, `val`, `amount`, `type`, `type_tr`, `descr`) VALUES ('".$uid_ref2."', '".$currency."', '".$Get4Ref_2."', '+', 'refcoin', 'Реферальные начисления HoliDay Coin со 2-го уровня')");
    } else { $Get4Admin += $Get4Ref_2; }



    $base->Query("UPDATE `".$pr."_admin_auth` SET `".$sql_money_admin."` = `".$sql_money_admin."` + '".$Get4Admin."', `".$sql_profit_admin."` = `".$sql_profit_admin."` + '".$Get4Admin."' WHERE `id` = '1'");


    return array("ok", $buycoin);
}



?>