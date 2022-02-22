<?php

$_OPTIMIZATION["title"] = "Авторизация";
?>

<?php
if ($admin_auth == true) {
	Header("Location: /gogi130780gogi/?menu=auth&sel=users");
	return;
}
?>

<div class="login_div">
    <div class="head">Вход</div>
    <div class="body">
        <?php

        if (isset($_POST["admin_auth"])) {
            $adm_login = $func->IsLogin($_POST["adm_login"]);
            $adm_pass = $func->isPass($_POST["adm_pass"]);
            echo $adm_login." ".$adm_pass;
            $browser = $_SERVER['HTTP_USER_AGENT'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $hash = md5($func->generatePas(10));
            if ($adm_login !== false) {
                $db->Query("SELECT `username`, `password` FROM `".$pref."_admin_auth` WHERE `username` = '".$db->Real($adm_login)."'");
                if ($db->NumRows() == 1) {
                    $login_data = $db->FetchArray();
                    $adm_pass_md5 = $func->md5Pass($adm_pass);
                    if ($login_data["password"] == $adm_pass_md5) {

                        $db->Query("UPDATE `".$pref."_admin_auth` SET `admin_hash` = '".$hash."', `ip` = '".$ip."', `date` = '".time()."' WHERE `username` = '".$db->Real($adm_login)."'");
                        //$db->Query("INSERT INTO `".$pref."_admin_history` (`username`, ip, date, comment, type) VALUES ('".$adm_login."', '".$ip."', '".time()."', '".$browser."', 'vhod')");

                        setcookie("admin_login", $login_data["username"], time() + 60*60*24);
                        setcookie("admin_hash", $hash, time() + 60*60*24);
                        Header("Location: /gogi130780gogi/?menu=auth&sel=users");
                    } else echo '<div class="message_error">Пароль введен неверно!</div>';
                } else echo '<div class="message_error">Логин введен неверно!</div>';
			} else echo '<div class="message_error">Логин имеет неверный формат!</div>';
        }
		?>

        
        <form action="" method="post">
            <label>Логин</label>
            <input name="adm_login" type="text" value="" class="login_input" maxlength="30">
            <label>Пароль</label>
            <input name="adm_pass" type="password" value="" class="login_input" maxlength="30">
            <br><br>
            <div style="text-align: center"><input name="admin_auth" class="btn" type="submit" value="ВОЙТИ"></div>
        </form>
    </div>
</div>