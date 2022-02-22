
<?php

$_OPTIMIZATION["title"] = "Заказы клиентов";

# Подтверждение Запроса
if (isset($_POST["oid"])) {
    $oid = intval($_POST["oid"]);
    $nakl = strval($_POST["nakl"]);
    $delivery = strval($_POST["delivery"]);
    //echo "===== ".$oid;

    $db->Query("UPDATE `".$pref."_orders` SET `delivery` = '1', `delivery_descr` = '".$db->Real($nakl)."', `delivery_price` = '".$db->Real($delivery)."' WHERE `id` = '".$db->Real($oid)."' AND `delivery` = '0' AND `stat` > '0'");
}
?>


<?php
$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) - 1) : 0;
$lim = $num_p * 50;
$db->Query("SELECT * FROM `".$pref."_orders` WHERE `delivery` = '0' AND `stat` > '0' ORDER BY `id` ASC LIMIT ".$lim.", 50");
?>

<table class="table_info" style="width: 770px; font-size: 11px;">
    <thead>
        <tr>
            <td>№</td>
            <td>UserID</td>
            <td>Пакет №</td>
            <td>Кол-во</td>
            <td>ФИО</td>
            <td>Адрес</td>
            <td>Контакты</td>
            <td>Действие</td>
        </tr>
    </thead>
    <?php
    if ($db->NumRows() > 0) {
        while($data_orders = $db->FetchArray()) {
            ?>
			<tr>
				<td><?=$data_orders['id']; ?></td>
				<td><a class="link" href="?menu=auth&sel=users&edit=<?=$data_orders['uid']; ?>"><?=$data_orders['uid']; ?></a></td>
				<td><?=$data_orders['pid']; ?> </td>
				<td><?=$data_orders['count']; ?> </td>
				<td><?=$data_orders["fio"]; ?></td>
				<td><?=$data_orders["address"]; ?></td>
				<td><?=$data_orders["email"]; ?> <?=$data_orders["phone"]; ?></td>
                <td>
                    <form action="/gogi130780gogi/?menu=auth&sel=orders" method="post">
                        <input type="hidden" name="oid" value="<?=$data_orders['id']; ?>">
                        <input type="text" name="nakl" value="" placeholder="номер накладной, примечание">
                        <input type="text" name="delivery" value="" placeholder="стоимость доставки">
                        <input type="submit" value="Отправили" class="btn">
                    </form>
                    <!--<a class="link" href="?menu=auth&sel=orders&confirm=<?=$data_orders['id']; ?>">В обработку</a>-->
                </td>
  			</tr>
            <?php
		}
    } else echo '<div class="message_error">Нет заказов!</div>';
	?>
</table>

<?php
$db->Query("SELECT COUNT(*) FROM `".$pref."_orders` WHERE `delivery` = '0' AND `stat` > '0'");
$all_pages = $db->FetchRow();
if ($all_pages > 50) {
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	echo '<div style="text-align: center">'.$nav->Navigation(10, $page, ceil($all_pages / 50), '/gogi130780gogi/?menu=auth&sel=orders&page='), '</div>';
}
?>
