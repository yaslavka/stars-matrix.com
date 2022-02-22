<?php

if (isset($_GET["login"]) && isset($_GET["code"])) {

    $base->Query("SELECT `login`, `code_confirm` FROM `".$pr."_users` WHERE `code_confirm` = '".$base->Real($_GET["code"])."' LIMIT 1");
    if ($base->NumRows() != 0) {
        $user_data = $base->FetchArray();
        if ($user_data["login"] == $_GET["login"]) {
            $base->Query("UPDATE `".$pr."_users` SET `code_confirm` = '1' WHERE `code_confirm` = '".$base->Real($_GET["code"])."' ");
            header("Location: /auth");
        }
    }

}

?>