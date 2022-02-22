

﻿<?php if ($auth_check == false) { Header("Location: /"); return; } # Блокировка сессии ?>

<?php
$uid = $_SESSION["uid"];
?>

<section id="portfolio">
    <div id="portfolio3" class="row center">
        <div class="col-sm-12 col-lg-6">
            <div class="pricing-table" style="text-align: left">
                <div class="price">
                    <div class="row">
                        <div class="col-sm-12">
                        <h3><font color="ffffff"><b>GOLD 100</h3>
                        </div>
                    </div>
                </div>
                <ul class="packages">
                    <li><i class="fa fa-check" aria-hidden="true"></i>Вход 100р. - Прибыль 25 300р.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Автозаполнение матриц системой</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Плюс личные приглашения</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Реинвесты. Клоны.</li>
                </ul>
                <a class="btn button btn-block" href="/orders/rub">Купить сейчас</a>
     </b></font>       </div>
        </div>
        <div class="col-sm-12 col-lg-6">
           <div class="pricing-table" style="text-align: left">
                <div class="price">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3><font color="ffffff"><b>GOLD 300</h3>
                        </div>
                    </div>
                </div>
                <ul class="packages">
                    <li><i class="fa fa-check" aria-hidden="true"></i>Вход 300р. - Прибыль 75 900р.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Автозаполнение матриц системой</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Плюс личные приглашения</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Реинвесты. Клоны.</li>
                </ul>
                <a class="btn button btn-block" href="/orders/rub">Купить сейчас</a>
       </b></font>     </div>
        </div>
    </div>
    <br>
    <div id="portfolio3" class="row center">
        <div class="col-sm-12 col-lg-6">
            <div class="pricing-table" style="text-align: left">
                <div class="price">
                    <div class="row">
                        <div class="col-sm-12">
                        <h3><font color="ffffff"><b>GOLD 500</h3>
                        </div>
                    </div>
                </div>
                <ul class="packages">
                    <li><i class="fa fa-check" aria-hidden="true"></i>Вход 500р. - Прибыль 126 500р.</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Автозаполнение матриц системой</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Плюс личные приглашения</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i>Реинвесты. Клоны.</li>
                </ul>
                <a class="btn button btn-block" href="/orders/rub">Купить сейчас</a>
         </b></font>   </div>
        </div>

</section>

   <br>
<?php
$dayStart = mktime(0,0,0);
$base->Query("SELECT `login`, `referer` FROM `".$pr."_users` WHERE `id` = '".$uid."'");
$d_log = $base->FetchArray();
$u_login = $d_log["login"];
$u_refrr = $d_log["referer"];
?>
<div class="row center acc-stat">
    <div class="col-sm-12 col-lg-4">
        <table class="table table-bordered acc-s-link" style="width: 100%">
            <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="2"><i class="fa fa-mouse-pointer"></i> ПЕРЕХОДОВ</th>

            </tr>
            </thead>
            <thead class="thead-light table-sm">
            <tr>
                <th scope="col">Всего</th>
                <th scope="col">Сегодня</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td style="width: 50%; height: 106px; padding-top: 35px;">
                    <?php
                    $base->Query("SELECT `id` FROM `".$pr."_linkstat` WHERE `login` = '".$u_login."'");
                    echo $base->NumRows();
                    ?>
                </td>
                <td style="width: 50%; height: 106px; padding-top: 35px;">
                    <?php
                    $base->Query("SELECT `id` FROM `".$pr."_linkstat` WHERE `login` = '".$u_login."' AND UNIX_TIMESTAMP(`date`) > '".$dayStart."'");
                    echo $base->NumRows();
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12 col-lg-4">
        <table class="table table-bordered acc-s-reg" style="width: 100%">
            <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="2"><i class="fa fa-vcard"></i>РЕГИСТРАЦИЙ</th>

            </tr>
            </thead>
            <thead class="thead-light table-sm">
            <tr>
                <th scope="col">Всего</th>
                <th scope="col">Оплаченных</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td style="width: 50%; height: 106px; padding-top: 35px;">
                    <?php
                    $base->Query("SELECT `id` FROM `".$pr."_users` WHERE `referer` = '".$uid."'");
                    echo $base->NumRows();
                    ?>
                </td>
                <td style="width: 50%; height: 106px; padding-top: 35px;">
                    <?php
                    $base->Query("SELECT `id`, `referer`, `id` as src_id FROM `".$pr."_users` HAVING (SELECT count(id) FROM `".$pr."_matrix` WHERE `uid` = src_id) > '0' AND `referer` = '".$uid."'");
                    echo $base->NumRows();
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12 col-lg-4">
        <table class="table table-bordered acc-s-profit" style="width: 100%">
            <thead class="thead-dark">
            <tr>
                <th scope="col" colspan="3"><i class="fa fa-money"></i>ЗАРАБОТАНО</th>

            </tr>
            </thead>
            <thead class="thead-light table-sm">
            <tr>
                <th scope="col">Валюта</th>
                <th scope="col">Всего</th>
                <th scope="col">Сегодня</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <th scope="row">RUB</th>
                <td><?=round($user_data['profit_rur'],4);?></td>
                <td>
                    <?php
                    $base->Query("SELECT SUM(`amount`) FROM `" . $pr . "_transactions` WHERE `uid` = '" . $uid . "' AND `type` = '+' AND UNIX_TIMESTAMP(`date`) > '".$dayStart."' AND `val` = 'RUB'");
                    if ($base->NumRows() > 0) {
                        $data_n_b = $base->FetchRow();
                        echo round($data_n_b,4);
                    }
                    ?>
                </td>
            </tr>
         
            </tbody>
        </table>
    </div>
</div>

    <div class="row" style="margin-top: 10px; background: #0f1010">
        <script type="text/javascript" src="/js/clipboard.min.js"></script>
        <div class="col-sm-12 col-lg-4" style="color: #fff; padding-top: 11px; height: 50px;">Ваша реферальная ссылка:</div>
        <div class="col-sm-12 col-lg-4">
            <input class="input_page" id="input_ref" type="text" style="width: 100%; border: 0px; margin-top: 4px; height: 42px; box-shadow: none; color: #000; font-weight: bold; background: #f5f5f5;" value="https://<?=$_SERVER['HTTP_HOST']; ?>/?r=<?=$user_data['login']?>" readonly>
        </div>
        <div class="col-sm-12 col-lg-4" style="padding-top: 12px; color: #fff; cursor: pointer;" id="btn-clipboard" data-clipboard-target="#input_ref"> СКОПИРОВАТЬ В БУФЕР</div>
    </div>

<script>
    new Clipboard('#btn-clipboard');
    $(document).on('click', '#btn-clipboard', function() {
        alert('Ваша партнерская ссылка скопирована');
    });
</script>



<div class="row center all-stat" style="margin-top: 50px;">
    <div class="col-sm-12">
        <h1><font color="000000"><b>Общая статистика компании</b></font></h1>
    </div>
</div>

<div class="row center all-stat">
    <div class="col-sm-12 col-lg-4">
        <?php
        if ($u_refrr > 0) {
        $base->Query("SELECT `login`, `avatar`, `firstname`, `lastname`, `email`, `skype`, `vk`, `phone` FROM `".$pr."_users` WHERE `id` = '".$u_refrr."'");
        $d_rerr = $base->FetchArray();
        ?>
        <table class="table table-bordered acc-s-user" style="width: 100%">
            <thead class="thead-dark">
            <tr>
                <th scope="col"><i class="fa fa-user-circle"></i> ВАШ НАСТАВНИК</th>

            </tr>
            </thead>
            <tbody class="table-sm">
            <tr> <td>
                    <div class="avatar" style="margin: 1px;">
                        <div style="background: url('<?=$d_rerr["avatar"]?>') no-repeat; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;" class="avadiv"></div>
                    </div>
                </td> </tr>
            <tr> <td><?=$d_rerr["login"]?></td> </tr>
            <tr> <td><?=$d_rerr["lastname"]?> <?=$d_rerr["firstname"]?></td> </tr>
            <tr> <td>скайп: <?=$d_rerr["skype"]?></td> </tr>
            <tr> <td><a href="<?=$d_rerr["vk"]?>" target="_blank"><?=$d_rerr["vk"]?></td> </tr>
            <tr> <td><?=$d_rerr["phone"]?></td> </tr>
            </tbody>
        </table>
        <?php
        }
        ?>
    </div>
    <div class="col-sm-12 col-lg-4">
        <table>
            <thead>
            <tr>
                <th scope="col" colspan="2"><i class="fa fa-list-alt"></i>ПОСЛЕДНИЕ РЕГИСТРАЦИИ</th>

            </tr>
            </thead>
            <thead>
            <tr>
                <th scope="col">Логин</th>
                <th scope="col">Дата</th>
            </tr>
            </thead>

            <tbody>

            <?php
            $base->Query("SELECT * FROM `" . $pr . "_users` ORDER BY `id` DESC LIMIT 10");
            while ($data_reg = $base->FetchArray()) {
                ?>
                <tr>
                    <td><?=$data_reg["login"]?></td>
                    <td><?=$data_reg["datareg"]?></td>
                </tr>
                <?php
            }
            ?>

            </tbody>
        </table>
    </div>
 
</div>
<br /><br /><br />
