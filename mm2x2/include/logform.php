	<div class="wrapper">	
		<div class="centerblock">
				<div class="title">
					<h1>Вход в аккаунт</h1>
				</div>
<?
session_start();
$a="";
$b="";
if (isset($_POST['login'])) {
$a=trim($_POST["id"]);
$b=trim($_POST["password"]);
$a=str_replace("'","",$a);
$b=str_replace("'","",$b);
$a=str_replace("\"","",$a);
$b=str_replace("\"","",$b);
$check=0;
$username=$_POST["id"];
$rs = mysql_query("select * from allussers where Username='$username' and Password='$b' and active=1");
if (mysql_num_rows($rs)>0) { 
$vkfsmr=mysql_fetch_array($rs);
$check=1;
$_SESSION["username_session"]=$vkfsmr[8];
$_SESSION["password_session"]=$vkfsmr[9];
header("Location: account.php");
}
elseif ($check==0)
{
$rs = mysql_query("select * from allussers where Username='$a' and Password='$b' and active=0");
$rs1 = mysql_query("select * from allussers where Username='$a' and Password='$b' and active=1 and status=1");
if($_POST['id'] == '') {
$error = '<center>Введите логин!</center>';
}
elseif($_POST['password'] == '') {
$error = '<center>Введите пароль!</center>';
}
elseif($check==0) {
$error = '<center>Неверный логин и/или пароль!</center>';
}
}
}
echo ''.$error.'';
?>
			   <form action="" method="post">
			   <table align="center">
				 <tr><td align="right">Логин</td><td width="10"></td><td align="left"><input class="inputs" maxlength="12" name="id" type="text"></td></tr>
				 <tr><td align="right">Пароль</td><td width="10"></td><td align="left"><input class="inputs" maxlength="30" type="password" name="password"></td></tr>
				 <tr><td align="center" colspan="3"><input class="button" name="login" type="submit" value="Войти"></td></tr>
				 <tr><td align="center" colspan="3"><a href="passres.php">Забыли пароль?</a></td></tr>
			   </table>
			   </form>
		</div>
		<? include "include/rightblock.php"; ?>
	</div> 
 
 
