<h1><font color="ffffff"><span class="fa fa-user-o"></span> Профиль</font></h1>
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
    <li id="contacts"><a href="/profile/contacts"> / Контактные данные </a></li>
    <li id="pass"><a href="/profile/pass"> / Смена пароля </a></li>
</ul>
<?php
if (isset($_GET["submenu"])) {
    switch ($_GET["submenu"]) {
        case 'contacts': include 'pages/profile_contacts.php'; break;
        case 'pass': include 'pages/profile_pass.php'; break;
    }
} else {
    include 'pages/profile_contacts.php';
}
?>