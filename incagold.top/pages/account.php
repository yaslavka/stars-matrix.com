<?php
# Блокировка сессии
if ($auth_check == false) {
	Header("Location: /");
	return;
}


if (isset($_GET["sel"])) {
    $smenu = $func->getUrl($_GET["sel"]);
    switch ($smenu) {
        case "profile":         include("pages/profile.php");       break; # Профиль пользователя
        case "partners":        include("pages/partners.php");      break; # Партнеры
        case "orders":          include("pages/orders.php");        break; # Заказы
        case "myorders":        include("pages/myorders.php");      break; # Мои Заказы
        case "cash":            include("pages/cash.php");          break; # Деньги
        case "info":            include("pages/info.php");          break; # Информация

        case "successpay":      include("pages/successpay.php");    break; # Успешная оплата
        case "errorpay":        include("pages/errorpay.php");      break; # Ошибка при оплате

        case "logout":          include("pages/logout.php");        break; # Выход
        case "404":             include("pages/404.php");           break; # Страница ошибки
        default:                include("pages/404.php");           break; # Страница ошибки
    }
} else {
    include("pages/index_acc.php");
}


?> 