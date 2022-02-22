<?php

$admin_auth = false;

if (isset($_COOKIE['admin_login']) && isset($_COOKIE['admin_hash'])) {
    $db->Query("SELECT `admin_hash`, `rights` FROM `".$pref."_admin_auth` WHERE `username` = '".$db->Real($_COOKIE["admin_login"])."'");
    $data_auth = $db->FetchArray();
	if ($data_auth['admin_hash'] === $_COOKIE['admin_hash']) {
        $admin_auth = true;
    } else {
        setcookie('admin_login', '');
        setcookie('admin_hash', '');
        $admin_auth = false;
        Header("Location: /gogi130780gogi");
	}
}

?>