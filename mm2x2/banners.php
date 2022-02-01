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
$id=$_SESSION["username_session"];
$rs = mysql_query("select * from allussers where Username='$id'");
$arr=mysql_fetch_array($rs);
$check=1;
$email=$arr[7];
$name=$arr[1];
$ref=$arr[11];
$username=$_SESSION[username_session];
$status=$arr[14];
$total=$arr[15];
$paid=$arr[17];
$unpaid=$arr[16];
?>
	<div class="wrapper">	
		<div class="centerblock">
<?
include "include/accountmenu.php";
?>
<div class="title"><h1>Баннеры</h1></div>
<? $rs=mysql_query("select * from banners order by ID");
if(mysql_num_rows($rs)>0) {
while($arr=mysql_fetch_array($rs)) { ?>
<p><center>
<img src="<?php echo $arr[1];?>" border="1"><br>
<textarea>
<a href="<?php echo $siteurl; ?>/?<? echo $username; ?>" target="_blank"><img src="<?php echo $arr[1];?>" alt="<?php echo $sitename; ?>" title="<?php echo $sitename; ?>" border="0"></a>
</textarea>
</center></p>
<? } } ?>
 		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
} include "include/footer.php";
?>