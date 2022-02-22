
<?php


$_OPTIMIZATION["title"] = "Архив заказов";
?>

<link rel="stylesheet" type="text/css" href="../includes/calendar/tcal.css" />
<script type="text/javascript" src="../includes/calendar/tcal.js"></script>

Фильтр:
<br>
Отобразить заказы за определенный период
<form action="/gogi130780gogi/?menu=auth&sel=orders_arch" method="post">
    <input type="text" name="data1" class="tcal" value="" placeholder="с даты" autocomplete="off">
    <input type="text" name="data2" class="tcal" value="" placeholder="по дату" autocomplete="off">
    <input type="submit" value="Применить" class="btn">
</form>

<?php
if (isset($_POST["data1"]) && $_POST["data1"] <> "") { $date1 = strtotime($_POST["data1"]); } else { $date1 = 0; }
if (isset($_POST["data2"]) && $_POST["data2"] <> "") { $date2 = strtotime($_POST["data2"]); } else { $date2 = time(); }
if ($date1 > $date2 ) { $date1 = $date2; }
if ($date1 > 0) { echo "с ".date("Y.m.d", $date1); }
echo " по ".date("Y.m.d", $date2);
?>




<?php
$onpage = 1000;


$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) - 1) : 0;
$lim = $num_p * $onpage;
$db->Query("SELECT * FROM `".$pref."_orders` WHERE UNIX_TIMESTAMP(`datapay`) >= ".$date1." AND UNIX_TIMESTAMP(`datapay`) <= ".$date2." AND `delivery` > '0' AND `stat` > '0' ORDER BY `id` DESC LIMIT ".$lim.", ".$onpage);
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
            <td>Накладная,<br>Примечание</td>
            <td>Доставка</td>
        </tr>
    </thead>
    <?php
    if ($db->NumRows() > 0) {
        $sum_delivery = 0;
        while($data_orders = $db->FetchArray()) {
            ?>
			<tr>
				<td><?=$data_orders['id']; ?></td>
				<td><a class="link" href="?menu=auth&sel=users&edit=<?=$data_orders['uid']; ?>"><?=$data_orders['uid']; ?></a></td>
				<td><?=$data_orders['pid']; ?>  </td>
				<td><?=$data_orders['count']; ?> </td>
				<td><?=$data_orders["fio"]; ?></td>
				<td><?=$data_orders["address"]; ?></td>
				<td><?=$data_orders["email"]; ?> <?=$data_orders["phone"]; ?></td>
                <td><?=$data_orders["delivery_descr"]; ?></td>
                <td><?=$data_orders["delivery_price"]; $sum_delivery += $data_orders["delivery_price"]; ?></td>
  			</tr>
            <?php
		}
		echo "<tr><td colspan='8' style='text-align: right'>Итого за доставку: </td><td>".$sum_delivery." руб.</td></tr>";
    } else echo '<div class="message_error">Нет заказов!</div>';
	?>
</table>

<?php
$db->Query("SELECT COUNT(*) FROM `".$pref."_orders` WHERE `delivery` > '0' AND `stat` > '0'");
$all_pages = $db->FetchRow();
if ($all_pages > $onpage) {
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	echo '<div style="text-align: center">'.$nav->Navigation(10, $page, ceil($all_pages / $onpage), '/gogi130780gogi/?menu=auth&sel=orders_arch&page='), '</div>';
}
?>
