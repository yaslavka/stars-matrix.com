<?php
#####################################################
##                 Магазин скриптов                ##
##                 Store-Scripts.ru                ##
#####################################################
##                                                 ##
##     Пишу движки, модули для готовых скриптов,   ##
##     скрипты любой сложности!                    ##
##     Все цены указаны на сайте.                  ##
##                                                 ##
##     E-mail: store.scripts.ru@gmail.com          ##
##     Skype: store.scripts.ru@gmail.com           ##
##                                                 ##
#####################################################

$_OPTIMIZATION["title"] = "Настройки";

if (isset($_POST["admin_auth"])) {
	$admin_login = $func->IsLogin($_POST["admin_login"]);
    $admin_pass = $func->isPass($_POST["admin_pass"]);
    if ($admin_login !== false) {
        if ($admin_pass !== false) {
            $admin_pass_md5 = $func->md5Pass($admin_pass);
            $db->Query("UPDATE `".$pref."_admin_auth` SET `username` = '".$admin_login."', `password` = '".$admin_pass_md5."' WHERE `id` = '1'");
            echo '<div class="message_success">Данные для входа успешно изменены!</div>';
        } else echo '<div class="message_error">Пароль имеет неверный формат!</div>';
    } else echo '<div class="message_error">Логин имеет неверный формат!</div>';
}
?>

<fieldset>
    <legend><b>Данные для входа в панель Администратора</b></legend>
    <form action="" method="POST">
        <div style="width: 250px; display: inline-block">
            <label class="labels">Логин:</label>
        </div>
        <div style="width: 200px; display: inline-block">
            <input name="admin_login" type="text" value="" class="tab_input" style="width: 200px" maxlength="30">
        </div>
        
        <div style="width: 250px; display: inline-block">
            <label class="labels">Пароль:</label>
        </div>
        <div style="width: 200px; display: inline-block">
            <input name="admin_pass" type="text" value="" class="tab_input" style="width: 200px" maxlength="30">
        </div>
        <div style="width: 250px; display: inline-block">
            <label class="labels"></label>
        </div>
        <div style="width: 200px; display: inline-block; text-align: right; padding-top: 15px">
            <input name="admin_auth" class="btn" type="submit" value="Изменить">
        </div>
    </form>
</fieldset>
<br><br>


<?php /*

<?php
if (isset($_POST["proc"])) {
	$procent = intval($_POST["per_user"]);
    if ($procent !== false) {
        $db->Query("UPDATE `".$pref."_settings` SET `per_user` = '".$procent."' WHERE `id` = '1'");
        echo '<div class="message_success">Данные успешно изменены!</div>';
    } else echo '<div class="message_error">Введите процент</div>';
}

# Настройки сайта
$db->Query("SELECT * FROM `".$pref."_settings` WHERE `id` = '1'");
$data_set = $db->FetchArray();
?>

<fieldset>
    <legend><b>Процент вознаграждения исполнителю задания</b></legend>
    <form action="" method="POST">
        <div style="width: 250px; display: inline-block">
            <label class="labels">Процент</label>
        </div>
        <div style="width: 200px; display: inline-block">
            <input name="per_user" type="text" value="<?=$data_set['per_user'];?>" class="tab_input" style="width: 200px" maxlength="30">
        </div>
        
        <div style="width: 250px; display: inline-block">
            <label class="labels"></label>
        </div>
        <div style="width: 200px; display: inline-block; text-align: right; padding-top: 15px">
            <input name="proc" class="btn" type="submit" value="Изменить">
        </div>
    </form>
</fieldset>
<br><br>

<?php
if (isset($_POST["fk"])) {
	$fk_id = intval($_POST["fk_id"]);
    $fk_key_one = $db->Real($_POST["fk_key_one"]);
    $fk_key_two = $db->Real($_POST["fk_key_two"]);
    if (!empty($fk_id)) {
        if (!empty($fk_key_one)) {
            if (!empty($fk_key_two)) {
                $db->Query("UPDATE `".$pref."_settings` SET `fk_id` = '".$fk_id."', `fk_key_one` = '".$fk_key_one."', `fk_key_two` = '".$fk_key_two."' WHERE `id` = '1'");
                echo '<div class="message_success">Данные для платежного сервиса FREE KASSA установлены!</div>';
                # Настройки сайта
                $db->Query("SELECT * FROM `".$pref."_settings` WHERE `id` = '1'");
                $data_set = $db->FetchArray();
            } else echo '<div class="message_error">Веедите секретное слово №2!</div>';
        } else echo '<div class="message_error">Веедите секретное слово №1!</div>';
    } else echo '<div class="message_error">Веедите ID магазина!</div>';
}
?>

<fieldset>
    <legend><b>Настройки FREE KASSA</b></legend>
    <form action="" method="POST">
        <div style="width: 250px; display: inline-block">
            <label class="labels">ID магазина:</label>
        </div>
        <div style="width: 200px; display: inline-block">
            <input name="fk_id" type="text" value="<?=$data_set['fk_id'];?>" class="tab_input" style="width: 200px" maxlength="30">
        </div>
        
        <div style="width: 250px; display: inline-block">
            <label class="labels">Секретное слово 1:</label>
        </div>
        <div style="width: 200px; display: inline-block">
            <input name="fk_key_one" type="text" value="<?=$data_set['fk_key_one'];?>" class="tab_input" style="width: 200px" maxlength="30">
        </div>
        
        <div style="width: 250px; display: inline-block">
            <label class="labels">Секретное слово 2:</label>
        </div>
        <div style="width: 200px; display: inline-block">
            <input name="fk_key_two" type="text" value="<?=$data_set['fk_key_two'];?>" class="tab_input" style="width: 200px" maxlength="30">
        </div>
        
        <div style="width: 250px; display: inline-block">
            <label class="labels"></label>
        </div>
        <div style="width: 200px; display: inline-block; text-align: right; padding-top: 15px">
            <input name="fk" class="btn" type="submit" value="Сохранить">
        </div>
    </form>
</fieldset>
<br><br>


 */

?>