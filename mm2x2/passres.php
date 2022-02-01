<?php
include "include/header.php";
include "siteconfig/confff.php";
if($_POST) {
$a=$_POST[Email];
if ($a=="") {
$rere = '<center>Поле "Ваш Email" обязательно для заполнения.</center>';
}
else {
$sql = "Select * from allussers where Email='".$a."'";
$result = mysql_query($sql);
$total = mysql_num_rows($result);
if ($total < 1) {
$rere = '<center>Такого Email нет в базе.</center>';
}
else
{
$rs  =  mysql_fetch_row($result);
$to = $rs[7];
$message1=$message5;
$message1=str_replace("{name}","$rs[1]",$message1);
$message1=str_replace("{email}","$rs[7]",$message1);
$message1=str_replace("{username}","$rs[8]",$message1);
$message1=str_replace("{password}","$rs[9]",$message1);
$message1=str_replace("{sitename}","$sitename",$message1);
$message1=str_replace("{siteurl}","$siteurl",$message1);

$subject1=str_replace("{name}","$rs[1]",$subject5);
$subject1=str_replace("{email}","$rs[7]",$subject1);
$subject1=str_replace("{username}","$rs[8]",$subject1);
$subject1=str_replace("{password}","$rs[9]",$subject1);
$subject1=str_replace("{sitename}","$sitename",$subject1);
$subject1=str_replace("{siteurl}","$siteurl",$subject1);
$message=stripslashes($message1);
$subject=stripslashes($subject1);
$from=$webmasteremail;
$header = "From: $sitename<$from>\n";
if($eformat5==1) 
$header .="Content-type: text/plain; charset=utf-8\n";
else
$header .="Content-type: text/html; charset=utf-8\n";
$header .= "Reply-To: <$from>\n";
$header .= "X-Sender: <$from>\n";
$header .= "X-Mailer: PHP4\n";
$header .= "X-Priority: 3\n";
$header .= "Return-Path: <$from>\n";
mail($to,$subject,$message,$header);
$rere = '<center>Логин и пароль отправлены на указанный Email.</center>';
}
}
}
?>
	<div class="wrapper">	
		<div class="centerblock">
				<div class="title">
					<h1>Восстановление пароля</h1>
				</div>
<?
echo ''.$rere.'';
?>
			<form action="passres.php" method="post">
			<table align="center">
			<tr><td align="right">Ваш Email</td><td width="10"></td><td align="left"><div class="mail"></div><input class="inputs" maxlength="30" name="Email"></td></tr>
			<tr><td align="center" colspan="3"><button class="button" type="submit">Отправить</button></td></tr>
			</table>				
			</form>
		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
include "include/footer.php";
?>