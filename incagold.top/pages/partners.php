<h1><font color="ffffff"><span class="fa fa-users"></span> Партнеры</h1>
<hr class="line_title_green">
<?php
$uid = intval($_SESSION['uid']);
$base->Query("SELECT * FROM `".$pr."_users` WHERE `id` = '".$uid."'");
$user_data = $base->FetchArray();
?>
<script>
    $(document).ready(function() {
        var url = window.location.pathname;
        var url_tab = url.split('/');
        $("#" + url_tab[2]).attr('class','active');
    });
</script>

<ul id="myTab" class="nav nav-tabs">
    <li id="my"><a href="/partners/my"> / Мои рефералы </a></li>
    <li id="tools"><a href="/partners/tools"> / Рекламные материалы </a></li>
</ul>

<?php
if (isset($_GET["submenu"])) {
    switch ($_GET["submenu"]) {
        case 'my': include 'pages/partners_my.php'; break;
        case 'tools': include 'pages/partners_tools.php'; break;
    }
} else {
    include 'pages/partners_my.php';
}
?>
