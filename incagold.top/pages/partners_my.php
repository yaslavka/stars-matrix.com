
<div class="content_block">
    <div class="text_title"><span class="fa fa-users"></span> Мои партнеры</div>
    <hr class="hr_green">
<?php
/*
$users_classic = array();
$base->Query("SELECT `id`, `login`, `firstname`, `lastname`, `otchestvo`, `referer`, `phone`, `actpackid`, `city` FROM `".$pr."_users` WHERE `referer` = '".$uid."' ORDER BY `id` ASC");
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
        $countref++;
    }
}
*/
?>

        <div class="row center mypart">
            <div class="col-sm-12">


                <div id="tys_<?=$uid?>" style='display: none;'></div>
                <table id='snu_<?=$uid?>' style='display: none; width: 100%;'><tr><td id='answ_<?=$uid?>'></td></tr></table>

            </div>
        </div>




</div>
<br><br>




<script>
    function showMyStruc(uid) {
        if (document.getElementById("snu_"+uid).style.display == "none") {
            document.getElementById("snu_"+uid).style.display = "block";
            document.getElementById("tys_"+uid).innerText = "-";

            showTaskLoader();

            $.ajax({
                url: "/ajax/ajax_show_struc.php",
                type: "POST",
                data: {
                    uid: uid
                },
                cache: false,
                success: function(server) {
                    $("#answ_"+uid).html("");
                    $("#answ_"+uid).append(server).fadeIn(200);
                }
            });
            hideTaskLoader();
            return;

        } else {
            document.getElementById("snu_"+uid).style.display = "none";
            document.getElementById("tys_"+uid).innerText = "+";
        }
    }
    showMyStruc(<?=$uid?>);
</script>