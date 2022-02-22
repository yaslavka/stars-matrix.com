<h1><font color="ffffff"><span class="fa fa-th-list"></span> Платформы</h1>
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
    <li id="rub"><a href="/orders/rub"> / Рубли</a></li>

</ul>

<?php
if (isset($_GET["submenu"])) {
    switch ($_GET["submenu"]) {
        case 'rub': include 'pages/orders_rub.php'; break;

    }
} else {
    include 'pages/orders_rub.php';
}
?>
