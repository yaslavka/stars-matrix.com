<?php
session_start();
include "include/header.php";
include "siteconfig/confff.php";
if (!isset($_SESSION["username_session"])) {
include "include/logform.php";
}
else {
include "siteconfig/confff.php";
if($_POST) {
$a[1]=$_SESSION[username_session];
$a[2]=addslashes($_POST["data"]);
$id=$_SESSION["username_session"];
$rs = mysql_query("select * from allussers where Username='$id'");
$arr=mysql_fetch_array($rs);
$check=1;
$email=$arr[7];
$name=$arr[1];
$ref=$arr[11];
$status=$arr[14];
if(($a[1]=="")||($a[2]=="")) {
$wirew = '<center>Поле "Ваш отзыв" обязательно для заполнения.</center>';
}
else {
include "siteconfig/confff.php";
$sql_i="insert into reviews values ('$a[0]','$a[1]','$a[2]',0,now())";
$rs=mysql_query($sql_i);
$wirew = '<center>Отзыв отправлен.</center>';
}
}
?>
	<div class="wrapper">	
		<div class="centerblock">
<?
include "include/accountmenu.php";
?>  
<div class="title"><h1>Оставить отзыв</h1></div>
<?
include "siteconfig/confff.php";
$id=$_SESSION["username_session"];
$rs = mysql_query("select * from allussers where Username='$id'");
$arr=mysql_fetch_array($rs);
$status=$arr[14];
if($status!=2) {
echo '<p><center>Вы не оплатили вход!<br><br><img src="images/biglogo.png"></center></p>';
} else {
?>
<p><center>
<?php echo ''.$wirew.''; ?>		 
<form action="writereview.php" method="post">
Ваш отзыв
<div class="tooltip_wrap">
<textarea maxlength="500" name="data"></textarea>
<div class="tooltip">
Напишите свое впечатление о проекте. Не более 500 символов.
</div>
</div>
<button class="button" type="submit">Отправить</button>
</form>
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