<?php
session_start();
include "include/header.php";
include "siteconfig/confff.php";
if (!isset($_SESSION["username_session"])) {
include "include/logform.php";
}
else {
include "siteconfig/confff.php";
$id=$_SESSION["username_session"];
$rs = mysql_query("select * from allussers where Username='$id'");
$arr=mysql_fetch_array($rs);
$email=$arr[7];
if($_POST) {
if($_POST['pwd'] == '') {
$chpass = '<center>Поле "Старый пароль" обязательно для заполнения.</center>';
}
elseif($_POST['npwd'] == '') {
$chpass = '<center>Поле "Новый пароль" обязательно для заполнения.</center>';
}
elseif($_POST['cpwd'] == '') {
$chpass = '<center>Поле "Повторите новый пароль" обязательно для заполнения.</center>';
}
elseif($_SESSION[password_session]!=$_POST["pwd"]) {
$chpass = '<center>Неверный действующий пароль.</center>';
}
elseif($_POST['npwd']!=$_POST['cpwd']) {
$chpass = '<center>Новые пароли не совпадают.</center>';
}
elseif($_POST['pwd']!='' && ($_POST['npwd']==$_POST['cpwd'])) {
$chpass = '<center>Новый пароль сохранен.</center>';
}

$username=$_SESSION["username_session"];
$rs = mysql_query("select * from allussers where Username='$username'");
$arr=mysql_fetch_array($rs);						
$password=$arr['Password'];
if($_SESSION[password_session]==$_POST["pwd"])
{		
$db_field[10]=$_POST["npwd"];
$db_field[11]=$_POST["cpwd"];
if($db_field[10]!="") {
if($db_field[10]==$db_field[11]) {
$query="update allussers set Password='$db_field[10]' where Username='$_SESSION[username_session]'";		
$rs = mysql_query($query);
$_SESSION["password_session"]=$db_field[10];
}       
}
}		
}		
?>
	<div class="wrapper">	
		<div class="centerblock">
<?
include "include/accountmenu.php";
?>
<div class="title"><h1>Профиль</h1></div>
<table align="center">
<tr><td align="right">Логин:</td><td width="10"></td><td align="left"><span><? echo $id;?></span></td></tr>
<tr><td align="right">Email:</td><td width="10"></td><td align="left"><span><? echo $email;?></span></td></tr>
</table>
<div class="title"><h1>Смена пароля</h1></div>
<p><center>
<?php echo ''.$chpass.''; ?>
<form action="profile.php" method="post">
Старый пароль
<div class="tooltip_wrap">							
<input class="inputs" maxlength="30" type="password" name="pwd">
<div class='tooltip'>
Введите свой пароль. 
</div>
</div>
Новый пароль
<div class="tooltip_wrap">							
<input class="inputs" maxlength="30" type="password" name="npwd">
<div class='tooltip'>
Введите новый пароль. 
</div>
</div>
Повторите новый пароль
<div class="tooltip_wrap">							
<input class="inputs" maxlength="30" type="password" name="cpwd">
<div class='tooltip'>
Введите новый пароль еще раз. 
</div>
</div>
<button class="button" type="submit">Сменить пароль</button>							
</form>
</center></p>
 		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
} include "include/footer.php";
?>