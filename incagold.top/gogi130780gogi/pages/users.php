<?php

$_OPTIMIZATION["title"] = "Пользователи";

# Редактирование пользователя
if (isset($_GET["edit"])) {
    $uid = intval($_GET["edit"]);

    /*
    if (isset($_POST["balance_get"])) {
        $sum = intval($_POST["sum_get"]);
        $type = ($_POST["balance_get"] == 1) ? "-" : "+";
        $string = ($type == "-") ? "Вы сняли у пользователя ".$sum." рублей!" : "Вы добавили пользователю ".$sum." баллов!";
        $db->Query("UPDATE `".$pref."_users` SET `balance` = `balance` ".$type." '".$sum."' WHERE `id` = '".$uid."'");
        echo '<div class="message_success">'.$string.'</div>';
    } /**/
    
    if (isset($_POST["banned"])) {
        $ban = intval($_POST["banned"]);
        $db->Query("UPDATE `".$pref."_users` SET `ban` = '".$ban."' WHERE `id` = '".$uid."'");
        echo '<div class="message_success">Пользователь '.($ban > 0 ? 'заблокиован' : 'разблокирован').'!</div>';
    }
    
    $db->Query("SELECT * FROM `".$pref."_users` WHERE `id` = '".$uid."' LIMIT 1");
    $data_us = $db->FetchArray();
    ?>
    
    <table style="width: 60%; margin: 0 auto; color: #4A5C62; margin-top: 15px">
        <tr>
            <td><b>БАН:</b></td>
            <td style="text-align: center"><?=($data_us["ban"] > 0) ? '<span style="color: red; font-weight: bold">ДА</span>' : '<span style="color: green; font-weight: bold">НЕТ</span>'; ?></td>
        </tr>
        <tr>
			<td><b>ID:</b></td>
			<td style="width: 200px; text-align: center"><?=$data_us["id"]; ?></td>
		</tr>
		<tr>
			<td><b>Логин:</b></td>
			<td style="text-align: center"><?=$data_us["login"]; ?></td>
		</tr>
        <tr>
			<td><b>E-mail:</b></td>
			<td style="text-align: center"><?=$data_us["email"]; ?></td>
		</tr>
        <tr>
            <td><b>Активный пакет:</b></td>
            <td style="text-align: center"><?=$data_us["actpackid"]; ?></td>
        </tr>
		<tr>
			<td><b>Баланс:</b></td>
			<td style="text-align: center"><?=$data_us["bonuses"]; ?> руб.</td>
		</tr>
		<tr>
			<td><b>Всего заработал:</b></td>
			<td style="text-align: center"><?=$data_us["profit"]; ?> руб.</td>
		</tr>
        <tr>
            <td><b>Телефон:</b></td>
            <td style="text-align: center"><?=$data_us["phone"]; ?></td>
        </tr>
		<tr>
			<td><b>ID спонсора:</b></td>
			<td style="text-align: center"><?=$data_us["referer"]; ?> </td>
		</tr>
		<tr>
			<td><b>Имя:</b></td>
			<td style="text-align: center"><?=$data_us["firstname"]; ?> </td>
		</tr>
		<tr>
			<td><b>Фамилия:</b></td>
			<td style="text-align: center"><?=$data_us["lastname"]; ?> </td>
		</tr>
		<tr>
			<td><b>Отчество:</b></td>
			<td style="text-align: center"><?=$data_us["otchestvo"]; ?></td>
		</tr>
		<tr>
			<td><b>Страна:</b></td>
			<td style="text-align: center"><?=$data_us["country"]; ?></td>
		</tr>
		<tr>
			<td><b>Область / Регион:</b></td>
			<td style="text-align: center"><?=$data_us["region"]; ?></td>
		</tr>
		<tr>
			<td><b>Почтовый индекс:</b></td>
			<td style="text-align: center"><?=$data_us["postcode"]; ?></td>
		</tr>
		<tr>
			<td><b>Город:</b></td>
			<td style="text-align: center"><?=$data_us["city"]; ?></td>
		</tr>
		<tr>
			<td><b>Улица:</b></td>
			<td style="text-align: center"><?=$data_us["street"]; ?></td>
		</tr>
		<tr>
			<td><b>Дом:</b></td>
			<td style="text-align: center"><?=$data_us["home"]; ?></td>
		</tr>
		<tr>
			<td><b>Квартира:</b></td>
			<td style="text-align: center"><?=$data_us["kvartira"]; ?></td>
		</tr>
		<tr>
			<td><b>Дата регистрации:</b></td>
			<td style="text-align: center"><?=$data_us["datareg"]; ?></td>
		</tr>
        <tr>
            <td colspan="2" style="text-align: center; padding-top: 20px">
                <form action="" method="post">
                    <input type="hidden" name="banned" value="<?=($data_us["ban"] > 0) ? 0 : 1 ;?>">
                    <input type="submit" class="btn" value="<?=($data_us["ban"] > 0) ? 'Разблокировать' : 'Заблокировать'; ?>">
                </form>
            </td>
		</tr>
    </table>
    <br><br>

    <!--
    <form action="" method="post">
        <table style="width: 70%; margin: 0 auto">
            <tr>
                <td style="text-align: center">
                    <select name="balance_get" class="login_input" style="width: 200px">
                        <option value="2">Добавить на баланс</option>
                        <option value="1">Снять с баланса</option>
                    </select>
                </td>
                <td style="text-align: center"><input type="text" name="sum_get" value="100" class="login_input" style="width: 100px"></td>
                <td style="text-align: center; padding-bottom: 12px"><input type="submit" value="Выполнить" class="btn"></td>
            </tr>
        </table>
	</form>
    -->

	<div class="clear"></div>	
	<?php
	return;
}

?>

<form action="/gogi130780gogi/?menu=auth&sel=users" method="post">
    Найти  <input type="text" name="lore" class="form-control" placeholder="Логин или Email">
    <button type="submit" class="btn btn-success" style="padding: 5px;">Поиск</button>
</form>

<?php
if (isset($_POST["lore"])) {
    $sql_search = " AND (`login` LIKE '%".$db->Real($_POST["lore"])."%' OR `email` LIKE '%".$db->Real($_POST["lore"])."%') ";
} else { $sql_search = ""; }

$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) - 1) : 0;
$lim = $num_p * 50;
$db->Query("SELECT * FROM `".$pref."_users` WHERE `id` > '0' ".$sql_search." ORDER BY `id` ASC LIMIT ".$lim.", 50");
?>

<table class="table_info" style="width: 100%">
    <thead>
        <tr>
            <td>№</td>
            <td>Пользователь</td>
            <td>Баланс</td>
            <td>E-mail</td>
            <td>Вход</td>
        </tr>
    </thead>
    <?php
    if ($db->NumRows() > 0) {
        while($data_users = $db->FetchArray()) {
            ?>
			<tr>
				<td><?=$data_users['id']; ?></td>
				<td>
                    <?php
                    $db2->Query("SELECT `id` FROM `".$pref."_matrix` WHERE `uid` = '".$data_users['id']."' LIMIT 1");
                    $clrus = ($db2->NumRows() == 0) ? "color: #999;" : "color: green; font-weight: bold;";
                    ?>
                    <a class="link" href="?menu=auth&sel=users&edit=<?=$data_users['id']; ?>" style="font-weight: normal;">
                        <?=($data_users["ban"] > 0) ? '<span style="color: red; font-weight: bold">' : '<span style="'.$clrus.'">'; ?>

                            <?=$data_users['login']; ?>

                        </span>
                    </a>
                </td>
				<td><?=$data_users['money_rur']; ?> руб. <br>$<?=$data_users['money_usd']; ?><br><?=$data_users['money_coin']; ?>HDC</td>
				<td><?=$data_users["email"]; ?></td>
                <td><a href="/gogi130780gogi/?menu=auth&sel=users_auth&uid=<?=$data_users['id']; ?>" target="_blank">Войти</a></td>
  			</tr>
            <?php
		}
    } else echo '<div class="message_error">Нет пользователей!</div>';
	?>
</table>

<?php
$db->Query("SELECT COUNT(*) FROM `".$pref."_users`");
$all_pages = $db->FetchRow();
if ($all_pages > 50) {
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	echo '<div style="text-align: center">'.$nav->Navigation(10, $page, ceil($all_pages / 50), '/gogi130780gogi/?menu=auth&sel=users&page='), '</div>';
}
?>
