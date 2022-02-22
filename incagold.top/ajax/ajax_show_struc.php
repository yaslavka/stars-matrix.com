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


if (isset($_POST['uid'])) {

    $error = 0;
    $usid = $base->Real($_POST['uid']);
    $base->Query("SELECT `id` FROM `".$pr."_users` WHERE `id` = '".$usid."'");
    if ($base->NumRows() == 0) { die("nouser"); }


    $users_classic = array();
    $base->Query("SELECT `id`, `login`, `firstname`, `lastname`, `otchestvo`, `referer`, `phone`, `actpackid`, `city`, `skype`, `vk_verif`, `vk`, `fb_verif` FROM `".$pr."_users` WHERE `referer` = '".$usid."' ORDER BY `id` ASC");
    if ($base->NumRows() > 0) {
        $countref = 0;
        while ($data_ref = $base->FetchArray()) {
            $users_classic[$countref][1] = $data_ref["id"];
            $users_classic[$countref][2] = $data_ref["firstname"];
            $users_classic[$countref][3] = $data_ref["lastname"];
            $users_classic[$countref][4] = $data_ref["otchestvo"];
            $users_classic[$countref][5] = $data_ref["referer"];
            $users_classic[$countref][6] = $data_ref["phone"];
            $users_classic[$countref][7] = $data_ref["actpackid"];
            $users_classic[$countref][8] = $data_ref["city"];
            $users_classic[$countref][9] = $data_ref["login"];
            $users_classic[$countref][10] = $data_ref["skype"];
            ($data_ref["vk_verif"] != null) ? $users_classic[$countref][11] = "https://vk.com/id".$data_ref["vk_verif"] : $users_classic[$countref][11] = $data_ref["vk"];
            ($data_ref["fb_verif"] != null) ? $users_classic[$countref][12] = $data_ref["fb_verif"] : $users_classic[$countref][12] = "";



            $countref++;
        }
    }
?>

    <table class="table">
        <thead class="thead-light" style="text-align: center;">
        <tr><th></th><th>№</th><th>Логин</th><th>Платформы</th><th>ФИО</th><th>Тел</th><th>Скайп</th><th>Вконтакте</th></tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        foreach ($users_classic as $res_user) {
            $i++;
            $base->Query("SELECT `id` FROM `".$pr."_users` WHERE `referer` = '".$res_user[1]."'");
            if ($base->NumRows() > 0) { $openstruc = "<a href='#' style='font-size: 12px; color: #f00;' id='tys_".$res_user[1]."' onclick='showMyStruc(".$res_user[1].");'>+</a>"; } else { $openstruc = ""; }

            $base->Query("SELECT `currency`, `stat`, `uid`, `price` FROM `".$pr."_matrix` WHERE `uid` = '".$res_user[1]."' ");
            if ($base->NumRows() > 0) {
                $uact = "";
                while ($data_uact = $base->FetchArray()) {
                    switch ($data_uact["stat"]) {
                        case "0" : $clrm = "#009906"; break;
                        case "1" : $clrm = "#ccc"; break;
                    }
                    $uact .= "<span style='color: ".$clrm.";'>".$data_uact["currency"]."-".$data_uact["price"].",</span> ";
                }
            } else { $uact = ""; }


            echo "<tr><td>".$openstruc."</td><td style='color: #999; text-align: center;'>".$i."</td><td style='color: #1aafd0;'>".$res_user[9]."</td><td style='color: #1aafd0;'>".$uact."</td><td>".$res_user[3]." ".$res_user[2]." ".$res_user[4]."</td><td>".$res_user[6]."</td><td>".$res_user[10]."</td><td><a href='".$res_user[11]."' target='_blank'>".$res_user[11]."</a></td>";





            echo "</tr>";
            echo "<tr><td colspan='9'><table id='snu_".$res_user[1]."' style='display: none; width: 100%;'><tr><td id='answ_".$res_user[1]."'></td></tr></table></td></tr>";
        }
        ?>
        </tbody>
    </table>


<?php
}
?>