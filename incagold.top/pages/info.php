<h1><span class="fa fa-tasks"></span> Информация</h1>
<hr class="line_title_green">
<?php
/*
$uid = intval($_SESSION['uid']);
$base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$uid."'");
$user_data = $base->FetchArray();
*/
?>
<script>
    $(document).ready(function() {
        var url = window.location.pathname;
        var url_tab = url.split('/');
        $("#" + url_tab[2]).attr('class','active');
    });
</script>

<ul id="myTab" class="nav nav-tabs">
    <li id="messages"><a href="/info/messages"> / Сообщения </a></li>
    <li id="learn"><a href="/info/learn"> / Обучение </a></li>
    <li id="feedback"><a href="/info/feedback"> / Отзывы </a></li>
<li id="marketing"><a href="/info/marketing"> / Маркетинг </a></li>
    <li id="faq"><a href="/info/faq"> / FAQ </a></li>
    <li id="support"><a href="/info/support"> / Тех поддержка </a></li>
    <li id="rules"><a href="/info/rules"> / Правила системы </a></li>
    <li id="terms"><a href="/info/terms"> / Пользовательское соглашение </a></li>
</ul>

<?php
if (isset($_GET["submenu"])) {
    switch ($_GET["submenu"]) {
        case 'messages': include 'pages/info_messages.php'; break;
        case 'learn': include 'pages/info_learn.php'; break;
        case 'feedback': include 'pages/info_feedback.php'; break;
        case 'marketing': include 'pages/info_marketing.php'; break;
        case 'marketings': include 'pages/info_marketings.php'; break;
        case 'marketingb': include 'pages/info_marketingb.php'; break;
        case 'marketingp': include 'pages/info_marketingp.php'; break;
        case 'faq': include 'pages/info_faq.php'; break;
        case 'support': include 'pages/info_support.php'; break;
        case 'rules': include 'pages/info_rules.php'; break;
        case 'terms': include 'pages/info_terms.php'; break;
    }
} else {
    include 'pages/info_learn.php';
}
?>
