<?php
ini_set('display_errors','Off');
error_reporting(E_ALL | E_STRICT);

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
session_start();
ob_start();


# Автозагрузка классов
function __autoload($name) {
    include('class/class.'.$name.'.php');
}

$conf = new config;
$func = new functions;
$mail = new mail;
$base = new database($conf->Host, $conf->User, $conf->Pass, $conf->Base);
$base2 = new database($conf->Host, $conf->User, $conf->Pass, $conf->Base);
$pr = $conf->Pr;

if (isset($_GET["r"])) {
	$referer_login = $_GET["r"];        $referer_login=addslashes($referer_login);
	setcookie("ref", $referer_login, time() + 2592000);
    $base->Query("INSERT INTO `".$pr."_linkstat` (`login`, `ip`) VALUES ('".$base->Real($referer_login)."', '".$_SERVER["REMOTE_ADDR"]."')");
} else {
    if (isset($_COOKIE['ref'])) { $referer_login = $_COOKIE['ref']; } else { $referer_login = ''; }
}

$_OPTIMIZATION = array();
$_OPTIMIZATION["title"] = $_SERVER['HTTP_HOST']." - Идеальный алгоритм заработка, не имеющий аналогов!";
$_OPTIMIZATION["description"] = "Впервые! Полностью автоматизированная система растущего заработка без приглашений!";
$_OPTIMIZATION["keywords"] = "заработок в интернет, инвестиции, без вложений, хайп, лучший заработок 2019, где заработать, начни зарабатывать, заработай легко, 1 9 90, бизнес с нуля, бизнес предложения, прибыль, как зарабатывать деньги, матрицы, заработок в ютюбе, лёгкий заработок, где заработать без вложений, заработок в мобильном приложении, сайт платит, заплатить, начни зарабатывать, честный заработок, заработок на буксах, халява";


# Проверка авторизации
include("includes/auth_acheck.php");



if (isset($_GET["menu"])) {
    include("includes/header.php");
    $menu = $func->getUrl($_GET["menu"]);
    switch ($menu) {
        case "account":         include("pages/account.php");       break;    # Аккаунт
        case "registration":    include("pages/reg.php");           break;    # Регистрация
        case "confirm":         include("pages/confirm.php");       break;    # Подтверждение аккаунта
        case "auth":            include("pages/auth.php");          break;    # Авторизация
        case "recovery":        include("pages/recovery.php");      break;    # Восстановление пароля
        case "marketing":       include("pages/info_marketing.php");break;    # Маркетинг
        case "marketings":       include("pages/info_marketings.php");break;    # Маркетинг
        case "marketingb":       include("pages/info_marketingb.php");break;    # Маркетинг
        case "marketingp":       include("pages/info_marketingp.php");break;    # Маркетинг
        case "support":         include("pages/info_support.php");  break;    # Контакты
        case "faq":             include("pages/info_faq.php");      break;    # Вопросы
        case "rules":           include("pages/info_rules.php");    break;    # Правила
        case "news":            include("pages/news.php");          break;    # Новости
        case "development":     include("pages/development.php");   break;    # На стадии разработки
        case "404":             include("pages/404.php");           break;    # Страница ошибки
        default:                include("pages/404.php");           break;    # Страница ошибки
    }
    include("includes/footer.php");
} else {
    if (!isset($_SESSION["uid"])) {
        include("lp/index.php");
    } else {
        include("includes/header.php");
        include("pages/index_acc.php");
        include("includes/footer.php");
    }
}





# Заносим контент в переменную
$content = ob_get_contents();

# Очищаем буфер
ob_end_clean();

# Заменяем данные
$content = str_replace("{!TITLE!}", $_OPTIMIZATION["title"], $content);
$content = str_replace('{!DESCRIPTION!}', $_OPTIMIZATION["description"], $content);
$content = str_replace('{!KEYWORDS!}', $_OPTIMIZATION["keywords"], $content);

# Выводим контент
echo $content;
?>