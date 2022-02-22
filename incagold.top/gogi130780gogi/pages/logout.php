<?php

if ($admin_auth == true) {
    unset($_SESSION);
    setcookie("admin_hash", "");
    $admin_auth = false;
    header("Location: /gogi130780gogi");
}
?>