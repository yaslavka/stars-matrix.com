<?php

 
if (isset($_GET["uid"])) {
    $uid = strval($_GET["uid"]);
    $db->Query("SELECT `id`, `login`, `password`, `ban` FROM `".$pref."_users` WHERE `id` = '".$db->Real($uid)."'");
    if ($db->NumRows() == 1) {
        $login_data = $db->FetchArray();
        $hash = md5($login_data['id'].$login_data['login'].$login_data['password'].time());
        $db->Query("UPDATE `".$pref."_users` SET `user_hash` = '".$hash."' WHERE `id` = '".intval($login_data['id'])."' LIMIT 1");
        $_SESSION['uid'] = $login_data['id'];
        setcookie("user_hash", $hash, time() + 86400, "/");
        Header("Location: /");
        return;
    } else { echo "error"; }

}

?>
