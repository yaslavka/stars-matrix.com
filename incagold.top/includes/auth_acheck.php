<?php

$auth_check = false;
if (isset($_SESSION['uid']) && isset($_COOKIE['user_hash'])) {
    $base->Query("SELECT `id`, `user_hash`, `ban`, `code_confirm` FROM `".$pr."_users` WHERE `id` = '".intval($_SESSION['uid'])."'");
    $data_login = $base->FetchArray();
	if ($data_login['user_hash'] === $_COOKIE['user_hash'] && $data_login['ban'] == 0 && $data_login['code_confirm'] == 1) {
        $uid = intval($_SESSION['uid']);
        $auth_check = true;
    } else {
        setcookie('user_hash', '');
        unset($_SESSION);
        session_destroy();
        $auth_check = false;
        Header("Location: /");
	}
} else {
    unset($_SESSION);
}
?>