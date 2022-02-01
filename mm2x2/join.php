<?php
session_start();
foreach($_GET as $k=>$v)
$id .=$k;
if($id !="") {
if($_SESSION["refid_session"]=="") {
$_SESSION["refid_session"]=$id ;
}
}
include "include/header.php";
include "siteconfig/confff.php";
if(isset($_POST['join'])) {	
if($_POST['username'] == '') {
$usernameError = '<center>Поле "Логин" обязательно для заполнения.</center>';
}
if($_POST['password'] == '') {
$passwordError = '<center>Поле "Пароль" обязательно для заполнения.</center>';
}
if($_POST['cpassword'] == '') {
$cpasswordError = '<center>Поле "Повторите пароль" обязательно для заполнения.</center>';
} elseif($_POST[password]!=$_POST[cpassword]) {
$cpasswordError = '<center>Пароли не совпадают.</center>';
}
if($_POST['email'] == '') {
$emailError = '<center>Поле "Email" обязательно для заполнения.</center>';
}
if($_POST['terms'] == '') {
$dosterghError = '<center>Необходимо согласиться с условиями.</center>';
}
if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
} else {
$capError='<center>Проверочный код введен неверно.</center>';
}
$check=0;
$sql = "select * from allussers where Email='".$_POST[email]."'";
$result = mysql_query($sql);
$total = mysql_num_rows($result);
$rs  =  mysql_fetch_row($result);
$sql1 = "select * from allussers where Username='".$_POST[username]."'";
$result1 = mysql_query($sql1);
$total1 = mysql_num_rows($result1);
$rs1  =  mysql_fetch_row($result1);
if ($total > 0) {
$check=1;
}
if($_POST[username]=="admin") {
$check=5;
}
if ($total1 > 0) {
$check=3;
}
if ($check==1) {
$emailError = '<center>Этот Email занят.</center>';
}
elseif ($check==3) {
$usernameError = '<center>Этот логин занят.</center>';
}
elseif ($check==5) {
$usernameError = '<center>Этот логин занят.</center>';
}
if(!isset($emailError) && !isset($usernameError) && !isset($passwordError) && !isset($cpasswordError) && !isset($dosterghError) && !isset($capError)) {
$a[7]=$_POST[email];
$a[7]=str_replace("'","",$a[7]);
$a[7]=str_replace("\"","",$a[7]);
$a[8]=$_POST[username];
$a[8]=str_replace(" ","",$a[8]);
$a[8]=str_replace("'","",$a[8]);
$a[8]=str_replace(".","",$a[8]);
$a[8]=str_replace("\"","",$a[8]);
$a[8]=str_replace("\\","",$a[8]);
$a[8]=strtolower($a[8]);
$username=$a[8];
$a[9]=$_POST[password];
$a[9]=str_replace("'","",$a[9]);
$a[9]=str_replace("\"","",$a[9]);
$a[12]=$_SERVER['REMOTE_ADDR'];
$a[13]=date("j M, Y");
$a[14]=$_POST[cpassword];
$a[14]=str_replace("'","",$a[14]);
$a[14]=str_replace("\"","",$a[14]);
$ref_by=$_SESSION["refid_session"];
$rs=mysql_query("select * from allussers where Username='$ref_by' and active=1");
if(mysql_num_rows($rs)<1) {
$ref_by="";
}
if($confirmreq==1) $aactive=0;
else $aactive=1;
$sql_i="insert into allussers(Email,Username,Password,active,ref_by,IP,Date,status,Total,Unpaid,Paid,RDate,subscribed,banners,bannersused,textads,textadsused) values
('$a[7]',
'$a[8]',
'$a[9]',
$aactive,
'$ref_by',
'$a[12]',
now(),
1,
0,
0,
0,
now(),1,0,0,0,0)";
$rs=mysql_query($sql_i);
$b=mysql_insert_id();
if($confirmreq==1) {
} else {
echo('<div class="wrapper">	
		<div class="centerblock">
				<div class="title">
					<h1>Вы успешно зарегистрировались</h1>
				</div>');
if($freemember==0) {
}
else {
echo('<p><center>Приветствуем вас в проекте '.$sitename.'!<br>Данные для доступа в аккаунт отправлены на вашу электронную почту.<br><br><img src="images/biglogo.png"></center></p>');
}                    						
echo('</div>');
		include "include/rightblock.php";
	echo('</div>');
$to=$_POST[email];
$message1=$message2;
$message1=str_replace("{name}","$a[1]",$message1);
$message1=str_replace("{email}","$_POST[email]",$message1);
$message1=str_replace("{username}","$_POST[username]",$message1);
$message1=str_replace("{password}","$_POST[password]",$message1);
$message1=str_replace("{sitename}","$sitename",$message1);
$message1=str_replace("{siteurl}","$siteurl",$message1);
$subject1=str_replace("{name}","$a[1]",$subject2);
$subject1=str_replace("{email}","$_POST[email]",$subject1);
$subject1=str_replace("{username}","$_POST[username]",$subject1);
$subject1=str_replace("{password}","$_POST[password]",$subject1);
$subject1=str_replace("{sitename}","$sitename",$subject1);
$subject1=str_replace("{siteurl}","$siteurl",$subject1);
$message=stripslashes($message1);
$subject=stripslashes($subject1);
$from=$webmasteremail;
$header = "From: $sitename<$from>\n";
if($eformat2==1) {
$header .="Content-type: text/plain; charset=utf-8\n";
}
else {
$header .="Content-type: text/html; charset=utf-8\n";
$header .= "Reply-To: <$from>\n";
$header .= "X-Sender: <$from>\n";
$header .= "X-Mailer: PHP4\n";
$header .= "X-Priority: 3\n";
$header .= "Return-Path: <$from>\n";
}
mail($to,$subject,$message,$header);
}
include "include/footer.php";
exit;
}
}
?>
	<div class="wrapper">	
		<div class="centerblock">
				<div class="title">
					<h1>Регистрация</h1>
				</div>
<? if (!isset($_SESSION["username_session"])) {
if(isset($usernameError)) echo ''.$usernameError.'';
if(isset($emailError)) echo ''.$emailError.'';
if(isset($passwordError)) echo ''.$passwordError.'';
if(isset($cpasswordError)) echo ''.$cpasswordError.'';
if(isset($dosterghError)) echo ''.$dosterghError.'';
if(isset($capError)) echo ''.$capError.''; 
?>
<form action="join.php" method="post">	
<table align="center">
<tr><td align="right">Логин</td><td width="10"></td><td align="left"><input class="inputs" maxlength="12" name="username" value="<? echo $_POST[username]; ?>"></td></tr>
<tr><td align="right">Email</td><td width="10"></td><td align="left"><input class="inputs" maxlength="50" name="email" value="<? echo $_POST[email]; ?>"></td></tr>
<tr><td align="right">Пароль</td><td width="10"></td><td align="left"><input class="inputs" maxlength="30" name="password" type="password" value="<? echo $_POST[password]; ?>"></td></tr>
<tr><td align="right">Повторите пароль</td><td width="10"></td><td align="left"><input class="inputs" maxlength="30" name="cpassword" type="password" value="<? echo $_POST[cpassword]; ?>"></td></tr>
<tr><td align="right">Проверочный код</td><td width="10"></td><td align="left"><input class="inputs" maxlength="5" id="security_code" name="security_code" type="text"></td></tr>
<tr><td align="center" colspan="3"><img src="captcha.php"></td></tr>
<tr><td align="center" colspan="3"><input type="checkbox" name="terms"> я согласен с <a href="terms.php" target="_blank">условиями</a></td></tr>
<tr><td align="center" colspan="3"><input class="button" type="submit" name="join" value="Создать аккаунт"></td></tr>
</table>
</form>
<?
} else { echo '<p><center>Необходимо выйти из аккаунта!<br><br><img src="images/biglogo.png"></center></p>'; }
?>
		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
include "include/footer.php";
?>