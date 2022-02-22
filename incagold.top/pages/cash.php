<h1><font color="ffffff"><span class="fa fa-money"></span> Кошелек</h1>
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
    <li id="deposit"><a href="/cash/deposit"> / Пополнить </a></li>
    <li id="withdrawal"><a href="/cash/withdrawal"> / Вывести </a></li>
    <li id="transactions"><a href="/cash/transactions"> / Транзакции </a></li>
</ul>

<?php
if (isset($_GET["submenu"])) {
    switch ($_GET["submenu"]) {
        case 'deposit': include 'pages/cash_deposit.php'; break;
        case 'withdrawal': include 'pages/cash_withdrawal.php'; break;
        case 'send': include 'pages/cash_send.php'; break;
        case 'transactions': include 'pages/cash_transactions.php'; break;
    }
} else {
    include 'pages/cash_deposit.php';
}
?>
</font>