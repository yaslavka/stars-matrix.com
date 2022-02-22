<?php
$uid = intval($_SESSION['uid']);
$base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$uid."'");
$user_data = $base->FetchArray();

$conf = new config;
?>

<div class="content_block">
    <div class="text_title"><span class="fa fa-sign-in"></span> Пополнить баланс</div>
    <hr class="hr_green">


    <?php /*
    if ($uid != 2) {
        echo  "Пополнение счета временно приостановлено. До решения технических проблем</div>"; return;
    }
 */
    ?>


    
    <script>
        function enterSum() {
            var sum = parseFloat($('#payment').val());
            var uid = parseInt($('#uid').val());
            var re = /[^0-9\.]/gi;
            var desc = $('#desc').val();
            var curr = $('#curr').val();


            if (re.test(sum)) {
                sum = sum.replace(re, '');
                sum = Math.ceil(sum * 100) / 100;
                $('#payment').val(sum);
            }


            $('#payment').val(sum);

            if (((sum >= 1 && curr == "RUB") || (sum >= 1 && curr == "USD")) && sum <= 1000000)  {
                $('#warning').removeClass().html('');
                $('#buy [type=submit]').removeAttr('disabled');
                //$('#sum_points').html(sum * <?=$conf->PDepositBonus?>);
            } else {
                $('#warning').addClass('errorArea').html('Минимум для пополнения 1 руб. или 1 доллар');
                $('#buy [type=submit]').attr('disabled', true);
               // $('#sum_points').html('0');
            }


            $.get('../includes/payeer_data.php?prepare_once=1&uid=' + uid + '&sum=' + sum + '&curr=' + curr + '&desc=' + desc, function(data) {
                var v = JSON.parse(data);
                $('#paymentsend').val(v[0]);
                $('#descsend').val(v[1]);
                $('#s').val(v[2]);
            });

        }
    </script>

    <div style="width: 300px; margin: 0 auto">
    <form id="buy" method="GET" action="https://payeer.com/merchant/">
        <input type="hidden" name="m_shop" value="<?=$conf->PayeerMerchantId?>">
        <input type="hidden" name="m_orderid" id="uid" value="<?=$uid?>">
        <label>Сумма</label>
        <input type="text" class="input_page" id="payment" value="100" onchange="enterSum();" onkeyup="enterSum();">
        <input type="hidden" name="m_amount" id="paymentsend">
        <br>
        <label>Валюта</label>
        <select name="m_curr" class="input_page" id="curr" onchange="enterSum();">
            <option value="RUB">Рубли</option>
        </select>
        <input type="hidden" id="desc" value="deposit">
        <input type="hidden" name="m_desc" id="descsend">
        <input type="hidden" name="m_sign" id="s" value="0">
        <br> <br>
        <input type="submit" name="m_process" class="btn btn-success" style="width: 100%;" value=' Пополнить '>
    </form>
    </div>


    <script>
        enterSum(100);
    </script>
    <div id="warning"></div>


    <br><br>
    <br><br>

</div>
