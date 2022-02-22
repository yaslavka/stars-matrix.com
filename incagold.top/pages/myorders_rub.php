
<div class="content_block">
    <div class="text_title"><span class="fa fa-rub"></span> Рублевые</div>
    <hr class="hr_green">



    <?php
        $ftype = 0;
        $sql_ftype = " AND `stat` = '0' ";
        if (isset($_COOKIE['ftype_rub'])) {
            $ftype = $_COOKIE['ftype_rub'];
            switch ($ftype) {
                case 0 : $sql_ftype = " AND `stat` = '0' "; break;
                case 1 : $sql_ftype = " AND `stat` = '1' "; break;
                case 2 : $sql_ftype = " "; break;
                default : $sql_ftype = " "; break;
            }
        }
        $fprice = 100;
        $matrix_now = 100;
        if (isset($_COOKIE['fprice_rub'])) {
            $fprice = $_COOKIE['fprice_rub'];
            switch ($fprice) {
                case 100 : $matrix_now = 100; break;
                case 300 : $matrix_now = 300; break;
                case 500 : $matrix_now = 500; break;
                default : $matrix_now = 100; break;
            }
        }
    ?>
    <div class="row">
        <div class="col-sm-12 col-lg-1"></div>
        <div class="col-sm-12 col-lg-4">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">

                <label class="btn btn-secondary <?=($ftype == 0) ? "active" : "";?>" onclick="filter_type(1, 0)">
                    <input type="radio" name="options" id="option2" autocomplete="off" <?=($ftype == 0) ? "checked" : "";?>> Активные
                </label>
                <label class="btn btn-secondary <?=($ftype == 1) ? "active" : "";?>" onclick="filter_type(1, 1)">
                    <input type="radio" name="options" id="option3" autocomplete="off" <?=($ftype == 1) ? "checked" : "";?>> Завершенные
                </label>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <?php
                foreach ($conf->MatrixPriceRUR as $matrix) {
                ?>
                    <label class="btn btn-success <?=($fprice == $matrix) ? "active" : "";?>" onclick="filter_type(2, <?=$matrix?>)">
                        <input type="radio" name="options" id="option<?=$matrix?>" autocomplete="off" <?=($fprice == $matrix) ? "checked" : "";?>> <?=$matrix?> руб.
                    </label>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-12 col-lg-1"></div>
    </div>

    <script>
        function filter_type(psi, vals) {
            if (psi == 1) { $.cookie('ftype_rub', vals, { expires: 30, path: '/' }); }
            if (psi == 2) { $.cookie('fprice_rub', vals, { expires: 30, path: '/' }); }
            window.location = '';
        }
    </script>




        <div class="row center myhisord">
            <div class="col-sm-12">



<?php
        $uid4show = $uid;
        $avatar4show = $avatar;
        include 'functions/getsponsor.php';
        if (isset($_GET["uidd"])) {
            $uid4sget = $base->Real(intval($_GET["uidd"]));
            if (findsponsor($uid4sget, $uid)) {
                $uid4show = $uid4sget;
                $base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$uid4show."' LIMIT 1");
                $ush_data = $base->FetchArray();
 if ($ush_data['avatar'] != null) { $avatar4show = "/".$ush_data['avatar']; } else { $avatar4show = '/img/noavatar.png'; }
                echo "<a href='/myorders/rub' class='btn btn-success'>Назад</a>";
            }
        }


        for ($i = 1; $i <= 3; $i++) {
            $base->Query("SELECT * FROM `".$pr."_matrix` WHERE `matrix` = '".$i."' AND `currency` = 'RUB' AND `uid` = '".$uid4show."' AND `price` = '".$matrix_now."' ".$sql_ftype." ORDER BY `id` ASC");
            if ($base->NumRows() > 0) {
                $data_m = array();
                $data_m_stat = array();
                while ($data_matrix = $base->FetchArray()) {
                    $data_m[] = $data_matrix["id"];
                    $data_m_stat[] = $data_matrix["stat"];
                }
                foreach ($data_m as $co => $m_id) {
                    echo "<hr>";
                    switch ($data_m_stat[$co]) {
                        case 0: $clr = " opacity: 1; "; break;
                        case 1: $clr = " opacity: 0.4; "; break;
                    }
                    echo "<div style='width: 96%; margin: 40px 3%;'>
                        <table border='0' style='width: 100%;  ".$clr."'><tr><td></td><td style='width: 33%;' align='center'>
                        <div style=\"border: 1px dashed #000; background: url(/img/dobro1.jpg) no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; width: 100px; height: 100px; border-radius: 50%; \"></div>
                        </td><td style='width: 33%; font-size: 13px; color:#ffffff;' align='left'>Платформа <b>".$matrix_now." руб.</b></td></tr>";
                    $base->Query("SELECT * FROM `".$pr."_matrix` WHERE `referr_m_id` = '".$m_id."'");
                    $data_mym_user = array();
                    $data_mym_mid = array();
                    while ($data_mym = $base->FetchArray()) {
                        $data_mym_user[] = $data_mym["uid"];
                        $data_mym_mid[] = $data_mym["id"];
                    }
                    echo "<tr>";
                    foreach ($data_mym_user as $mcount => $show_u) {
                        $base->Query("SELECT `login`, `avatar` FROM `" . $pr . "_users` WHERE `id` = '" . $show_u . "' LIMIT 1");
                        $um_data = $base->FetchArray();
                        echo "<td align='center' valign='top'>";
echo findsponsor($show_u, $uid) ? "<a href='/myorders/rub/".$show_u."'>" : " ";
echo "<div style=\"margin-top: 15px; border: 1px dashed #ffffff; background: url(/img/dobro1.jpg) no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; width: 80px; height: 80px; border-radius: 50%; \"><p style='margin-top: 85px; font-size: 10px;'>".$um_data['login']."</p></div>
</a>
<br>";
                        if ($i > 1) {
                            echo "<div style='width: 180px; text-align: center;'>";
                            $base->Query("SELECT * FROM `".$pr."_matrix` WHERE `referr_m_id` = '".$data_mym_mid[$mcount]."'");
                            $data_mym_lv2_uid = array();
                            while ($data_mym_lv2 = $base->FetchArray()) {
                            
                                $data_mym_lv2_uid[] = $data_mym_lv2["uid"];
                            }
                            foreach ($data_mym_lv2_uid as $show_uava) {
                                $base->Query("SELECT `login`, `avatar` FROM `" . $pr . "_users` WHERE `id` = '" . $show_uava . "' LIMIT 1");
                                $umava_data = $base->FetchArray();
                                echo findsponsor($show_uava, $uid) ? "<a href='/myorders/rub/".$show_uava."'>" : " ";
                                echo "<div style=\"float: left; margin: 10px; border: 1px dashed #ffffff; background: url(/img/dobro1.jpg) no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; width: 40px; height: 40px; border-radius: 50%; \"><p style='margin-top: 45px; font-size: 8px;'>".$umava_data['login']."</p></div></a>";
                            }
                            echo "</div>";
                        }
                        echo "</td>";
                    }
                    switch ($mcount) {
                        case 0: echo "<td></td><td></td>";
                        case 1: echo "<td></td>";
                    }

                    echo "</tr>";
                    echo "</table></div>";
                }
            }
            $matrix_now = $matrix_now * $conf->MatrixPercent[$i] / 100;

        }



?>

            </div>
        </div>

</div>
<br><br>