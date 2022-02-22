<?php
$uid = intval($_SESSION['uid']);
$base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$uid."'");
$user_data = $base->FetchArray();

$conf = new config;
?>

<div class="content_block">
    <div class="text_title"><span class="fa fa-list"></span> История операций</div>
    <hr class="hr_green">
   
    <?php
    $base->Query("SELECT * FROM `".$pr."_transactions` WHERE `uid` = '".$uid."' ORDER BY `id` DESC LIMIT 1000");
    if ($base->NumRows() > 0) {
        ?>
    <table class="table_stats" style="width: 100%">
            <thead>
                <tr>
                    <td style="width: 40px"><font color="ffffff">№</td>
                    <td><font color="ffffff">Сумма</td>
                    <td><font color="ffffff">Детали</td>
                    <td><font color="ffffff">Дата</td>
                </tr>
            </thead>
            <?php
            $i = 1;
            while ($order_data = $base->FetchArray()) {
                ?>
                <tr>
                    <td><?=$i; ?></td>
                    <td <?=($order_data['type'] == "-") ? "style='color: #f00;'" : "";?> ><?=$order_data['type']; ?> <?=$order_data['amount']; ?>
                        <?php
                        switch ($order_data['val']) {
                            case "USD" : echo "$"; break;
                            case "RUB" : echo "руб."; break;
                            case "COIN" : echo "HDC"; break;
                        }
                        ?>
                    </td>
                    <td><?=$order_data['descr']; ?></td>
                    <td><?=$order_data['date']; ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <?php
    } else echo '<div class="alert alert-danger" role="alert"><b>Ещё не было ни одной транзакции</b></div>';
    ?>
</div>





