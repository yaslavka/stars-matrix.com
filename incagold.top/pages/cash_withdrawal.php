<?php
$base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$uid."'");
$user_data = $base->FetchArray();


?>

<div class="row" style="margin-bottom:  20px; padding: 20px 0 20px 0; background: #000; color: #ffff00; font-weight: bold;">
    <div class="col-12"> СТАРТ ПРОЕКТА 13.09.2019 В  19.00 МСК</div>
</div>



<div class="content_block">
    <div class="text_title"><span class="fa fa-sign-out"></span> Вывод средств</div>
    <?php // echo "</div>"; return; ?>
    <hr class="hr_green">
    <form method="POST" id="withdrawal_money">
        <input type="hidden" name="money" value="withdrawal">
        <input type="hidden" name="uid" value="<?=$uid; ?>">
        <div style="width: 430px; margin: 0 auto">

            <div style="width: 100%; margin-bottom: 10px">
                <div style="margin: 10px 0px">

                    <label>Счет</label>
                        <select class="input_page" name="pay_sys" id="curr" onchange="enterSum();">
                            <option value="RUB">Рубли</option>
 </select><br>
                    <label>Сумма</label>
                    <input type="text" name="amount" class="input_page" maxlength="20"  AUTOCOMPLETE="off" id="payment" onchange="enterSum();" onkeyup="enterSum();"> <b id="convert"></b>

                </div>
            </div>
            <div style="width: 100%; margin-bottom: 10px">
                <div style="margin: 10px 0px">

                        <label>Ваш Payeer кошелек</label>
                    <?php
                    if ($user_data["payeer"] == null) {
                        echo "<label style='color: #ff0000;'>ВНИМАНИЕ! Изменить кошелек будет НЕВОЗМОЖНО!  <br>Указывайте верно! </label>";
                        echo '<input type="text" name="pay_acc" class="input_page" maxlength="40" placeholder="Payeer кошелек">';
                    } else {
                        echo '<input type="text" class="input_page" value="'.$user_data["payeer"].'" disabled>';
                    }
                    ?>

                </div>
            </div>
            <div style="text-align: center; padding: 15px 0px">
    <button type="submit" class="btn btn-success" style="width: 100%;">Вывести</button>

            </div>
        </div>
    </form>
    <br><br>
</div>


   