<?php

# Старт сессии
session_start();

# Старт буфера
ob_start();

$_OPTIMIZATION = array();
$_OPTIMIZATION["title"] = "Админочка";

# Автоподгрузка классов
function __autoload($name) {
    include("../class/class.".$name.".php");
}

# Создаем экземпляр класса
$conf = new config;
$func = new functions;
$nav = new navigator;
$db = new database($conf->Host, $conf->User, $conf->Pass, $conf->Base);
$db2 = new database($conf->Host, $conf->User, $conf->Pass, $conf->Base);

# Префикс таблиц
$pref = $conf->Pr;

# Проверка авторизации
include("inc/auth_acheck.php");

# Шапка
include("inc/header.php");

if (isset($_GET["menu"])) {
    $menu = $_GET["menu"];
    switch ($menu) {
        case "404": include("pages/404.php"); break;
        case "auth": include("pages/auth.php"); break;
        default: include("pages/404.php"); break;
    }
} else {
    include("pages/login.php");
}

# Низ
include("inc/footer.php");

# Заносим контент в переменную
$content = ob_get_contents();

# Очищаем буфер
ob_end_clean();

# Заменяем данные
$content = str_replace("{!TITLE!}", $_OPTIMIZATION["title"], $content);

# Выводим контент
echo $content;
?>