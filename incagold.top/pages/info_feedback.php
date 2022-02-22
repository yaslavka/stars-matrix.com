
<div class="content_block ">
    <div class="text_title"><span class="fa fa-handshake-o"></span> Отзывы</div>
    <hr class="hr_green">

<?php
    $base->Query("SELECT * FROM `".$pr."_feedback` WHERE `uid` = '".$uid."' AND `stat` = '2'");
    if ($base->NumRows() == 0) {
?>
    <div class="row center">
        <div class="col-sm-12 ">
            <form method="POST" id="edit_acc">
                <input type="hidden" name="feedback" value="create">
                <input type="hidden" name="uid" value="<?=$uid; ?>">

                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Тема </span>
                    </div>
                    <input type="text" name="theme" class="form-control" placeholder="Заголовок отзыва" aria-label="Заголовок отзыва" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Отзыв</span>
                    </div>
                    <textarea name="mess" class="form-control" aria-label="Отзыв" aria-describedby="basic-addon2" style="height: 150px;"> </textarea>
                </div>

                <div class="input-group mb-1">
                    <button type="submit" class="btn btn-success" style="width: 100%">Отправить</button>
                </div>

            </form>

        </div>
    </div>

<br>
<br>
<?php
    }
?>

    <div class="row center">
        <div class="col-sm-12 ">

<?php
    $base->Query("SELECT * FROM `".$pr."_feedback` WHERE `stat` = '2' ORDER BY `id` DESC");
    if ($base->NumRows() > 0) {
?>
        <table class="table table-bordered acc-s-user" style="width: 100%;">
        <thead class="thead-dark">
        <tr>
            <th scope="col" colspan="2"> Отзывы</th>

        </tr>
        </thead>

        <tbody class="table-sm">

<?php
        while ($data_fb = $base->FetchArray()) {
            $base2->Query("SELECT `avatar` FROM `".$pr."_users` WHERE `id` = '".$data_fb["uid"]."'");
            $avka = $base2->FetchRow();
?>
                <tr>
                    <td>
                        <div class="avatar" style="margin: 17px;">
                            <div style="background: url('<?=$avka?>') no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" class="avadiv"></div>
                        </div>
                    </td>
                    <td style="text-align: left; font-size: 14px; padding: 20px;">
                        <span style="font-weight: bold">Заголовок:</span> <span><?=$data_fb["theme"]?></span>
                        <br>
                        <span style="font-weight: bold">Отзыв:</span> <div style="word-wrap: break-word; font-size: 12px; width: 500px;"><?=$data_fb["mess"]?></div>
                        <div style="text-align: right; font-size: 12px;"><?=$data_fb["date"]?></div>
                    </td>
                </tr>


<?php
        }
?>
        </tbody>
        </table>

<?php
    }

?>

        </div>
    </div>



</div>
<br><br>
