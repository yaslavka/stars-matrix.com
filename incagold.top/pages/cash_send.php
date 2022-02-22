<?php
$base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$uid."'");
$user_data = $base->FetchArray();
?>



<div class="content_block">
    <div class="text_title"><span class="fa fa-forward"></span> Перевод средств</div>
    <hr class="hr_green">
    <form method="POST" id="send_money">
        <input type="hidden" name="money" value="send">
        <input type="hidden" name="uid" value="<?=$uid; ?>">
        <div style="width: 430px; margin: 0 auto">
            <div style="width: 100%; margin-bottom: 10px">
                <div style="margin: 10px 0px">
                    <label>Баланс: <?=$user_data["money_rur"]?> руб. / $<?=$user_data["money_usd"]?> </label>
<br>
<br>
                        <label>Сумма</label>
                        <input type="text" name="amount" class="input_page" maxlength="20" AUTOCOMPLETE="off">

                </div>
            </div>
            <div style="width: 100%; margin-bottom: 10px">
                <div style="margin: 10px 0px">

                    <label>Валюта</label>
                    <select class="input_page" name="pay_sys">
                        <option value="RUB">Рубли</option>
                        <option value="USD">Доллары</option>
                    </select>

                </div>
            </div>
            <div style="width: 100%; margin-bottom: 10px">
                <div style="margin: 10px 0px">

                    <label>Логин пользователя</label>

                        <input type="text" name="reslogin" class="input_page" maxlength="40" autocomplete="off">

                </div>
            </div>
            <div style="text-align: center; padding: 15px 0px">
                <button type="submit" class="btn btn-success" style="width: 100%">Перевести пользователю</button>
            </div>
        </div>
    </form>

    <br><br>
</div>

