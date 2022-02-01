<?php
session_start();
include "include/header.php";
include "siteconfig/confff.php";
if (!isset($_SESSION["username_session"])) {
include "include/logform.php";
}
else
{
include "siteconfig/confff.php";
$rs=mysql_query("select * from allussers where Username='$_SESSION[username_session]'");
$arr=mysql_fetch_array($rs);
$status=$arr[14];
$rs=mysql_query("select * from allussers where Username='$_SESSION[username_session]'");
$arr=mysql_fetch_array($rs);
$unpaid=$arr[16];
if(isset($_POST['payperfect'])) {
$amount=$_POST[amount];
$pmode=$_POST[pmode];
$pid=$_POST[pid];
$pmode1=$pmode.":".$pid;
if($amount<=0) {
$widr = '<center>На балансе нет средств.</center>';
}
elseif(!is_numeric($amount)) {
$widr = '<center>Ошибка.</center>';
}
elseif($amount>$unpaid) {
$widr = '<center>Ошибка.</center>';
}
elseif($amount<$minwit) {
$widr = '<center>Минимум $'.$minwit.'.</center>';
}
elseif($pid=="") {
$widr = '<center>Не указан номер кошелька.</center>';
}
elseif($pid==U) {
$widr = '<center>Некорректный номера кошелька.</center>';
}
elseif(!eregi("^[U]+[0-9]{7,8}$", $pid)) {
$widr = '<center>Некорректный номера кошелька.</center>';
}
else {
$widr = '<center>Заказ создан.</center>';
$sql_i="insert into transaactions(Username,PaymentMode,Amount,approved,Date) values('$_SESSION[username_session]','$pmode1','$amount',0,now())";
$rs=mysql_query($sql_i);
$rs=mysql_query("update allussers set Unpaid=Unpaid-$amount where Username='$_SESSION[username_session]'");
}
}
elseif(isset($_POST['payqiwi'])) {
$amount=$_POST[amount];
$pmode=$_POST[pmode];
$pid=$_POST[pid];
$pmode1=$pmode.":".$pid;
if($amount<=0) {
$widr = '<center>На балансе нет средств.</center>';
}
elseif(!is_numeric($amount)) {
$widr = '<center>Ошибка.</center>';
}
elseif($amount>$unpaid) {
$widr = '<center>Ошибка.</center>';
}
elseif($amount<$minwit) {
$widr = '<center>Минимум $'.$minwit.'.</center>';
}
elseif($pid=="") {
$widr = '<center>Не указан номер кошелька.</center>';
}
elseif(!eregi("^[0-9]{11,11}$", $pid)) {
$widr = '<center>Некорректный номера кошелька.</center>';
}
else {
$widr = '<center>Заказ создан.</center>';
$sql_i="insert into transaactions(Username,PaymentMode,Amount,approved,Date) values('$_SESSION[username_session]','$pmode1','$amount',0,now())";
$rs=mysql_query($sql_i);
$rs=mysql_query("update allussers set Unpaid=Unpaid-$amount where Username='$_SESSION[username_session]'");
}
}
?>
	<div class="wrapper">	
		<div class="centerblock">
<?
include "include/accountmenu.php";
?>
<div class="title"><h1>Выплаты</h1></div>
<?php
if($status!=2) {
echo '<p><center>Вы не оплатили вход!<br><br><img src="images/biglogo.png"></center></p>';
} else {
echo ''.$widr.''; ?>
<p><center>На балансе <span>$</span><? echo $unpaid;?> <? if (!empty($qiwi)) { echo '('.($unpaid*$dolkurs).' рублей)'; } ?></center></p>
<p><center>
<form action="payouts.php" method="post">
<input type="hidden" readonly value="<? echo $unpaid; ?>" maxlength="10" type="text" name="amount">
<input type="hidden" readonly value="PerfectMoney" maxlength="15" type="text" name="pmode">
Кошелек Perfect Money
<div class="tooltip_wrap">
<input class="inputs" maxlength="8" type="text" name="pid">
<div class='tooltip'>
Укажите номер своего кошелька Perfect Money, например, U1234567.
</div>
</div>
<input class="button" name="payperfect" type="submit" value="Выплатить">
</form>
<? if (!empty($qiwi)) { ?> 
<br>или<br><br> 
<form action="payouts.php" method="post">
<input type="hidden" readonly value="<? echo $unpaid; ?>" maxlength="10" type="text" name="amount">
<input type="hidden" readonly value="QIWI" maxlength="15" type="text" name="pmode">
Кошелек QIWI
<div class="tooltip_wrap">
<input class="inputs" maxlength="11" type="text" name="pid">
<div class="tooltip">
Укажите номер своего кошелька QIWI, например, 79057772233.
</div>
</div>
<input class="button" name="payqiwi" type="submit" value="Выплатить">
</form>
<? }
include "siteconfig/confff.php";
$sql="Select * from transaactions where Username='$_SESSION[username_session]' order by ID";
$esdgjd=mysql_query($sql);
if(mysql_num_rows($esdgjd)>0) {
$rc=0;
echo("<br><table width='100%'>");
while($rs=mysql_fetch_row($esdgjd))
{
$rc=$rc+1;
if($rs[4]==1) {
$status="Выплачено!";
}
else {
$status='<span>Ожидается!</span>';
}
echo("<tr><td align=center>".$rs[5]."</td><td align=center>".$rs[2]."</td><td align=center><span>$</span>".$rs[3]."</td><td align=center>".$status."</td></tr>");      
}
echo("</table>");
}
?>
</center></p>
<?
}
?>
 		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
} include "include/footer.php";
?>