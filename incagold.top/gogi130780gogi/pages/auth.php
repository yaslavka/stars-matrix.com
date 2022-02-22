<?php

$_OPTIMIZATION["title"] = "Админка";

# Блокировка сессии
if ($admin_auth == false) {
	Header("Location: /gogi130780gogi");
	return;
}

if (isset($_GET["sel"])) {
	$smenu = $_GET["sel"];
	switch ($smenu) {
        case "404": include("pages/404.php"); break;
        case "users": include("pages/users.php"); break;
        case "users_auth": include("pages/users_auth.php"); break;
        case "stata": include("pages/stata.php"); break;
        case "feedback": include("pages/feedback.php"); break;
        case "orders": include("pages/orders.php"); break;
        case "orders_arch": include("pages/orders_arch.php"); break;
        case "withdrawal": include("pages/withdrawal.php"); break;
        case "settings": include("pages/settings.php"); break;
		case "logout": include("pages/logout.php"); break;
		default: include("pages/404.php"); break;
	}
} else {
    include("pages/users.php");
}
?> 