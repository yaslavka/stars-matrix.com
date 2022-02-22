<?php

if (isset($_COOKIE['user_hash'])) {
    setcookie('user_hash', '');
    unset($_SESSION);
    session_destroy();
    Header("Location: /");
}
?>