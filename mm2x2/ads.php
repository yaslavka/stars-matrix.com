<?php
session_start();
include "include/header.php"; 
if (!isset($_SESSION["username_session"])) {
include "include/logform.php";
}
else {
middle();
} 
function middle()
{
include "siteconfig/confff.php";
$id=$_SESSION["username_session"];
$rs = mysql_query("select * from allussers where Username='$id'");
$arr=mysql_fetch_array($rs);
$status=$arr[14];
$mmsauk=$arr[7];
$totban=$arr[20];
$banused=$arr[21];
$tottext=$arr[22];
$textused=$arr[23];
?>
	<div class="wrapper">	
		<div class="centerblock">
<?
include "include/accountmenu.php";
?>
<div class="title"><h1>Размещение баннера</h1></div>
<?
include "siteconfig/confff.php";
if($status!=2) {
echo '<p><center>Вы не оплатили вход!<br><br><img src="images/biglogo.png"></center></p>';
} else {
$unused=$totban-$banused;
if(!$_POST) {
echo '<p><center>Доступно <span>'.$unused.'</span> показов</center></p>';
?>
<p><center><form action="ads.php" method="post">
URL баннера
<div class="tooltip_wrap">
<input class="inputs" maxlength="100" type="text" name="burl">
<div class="tooltip">
Укажите ссылку на картинку в формате jpg, gif или png размером 125x125 пикселей, например,<br>http://site.ru/banner.gif.
</div>
</div>
URL сайта
<div class="tooltip_wrap">
<input class="inputs" maxlength="100" type="text" name="wurl">
<div class="tooltip">
Укажите ссылку на сайт, на который перейдет пользователь после клика по баннеру, например,<br>http://site.ru.
</div>
</div>
Показов
<div class="tooltip_wrap">
<input class="inputs" type="text" maxlength="50" name="credits" value="<?php echo $unused ?>">
<div class="tooltip">
Укажите количество показов, которое вы хотите потратить на данный баннер.
</div>
</div>
<input class="button" type="submit" name="b" value="Предосмотр">	
</form></center></p>
<?
include "siteconfig/confff.php";
$rsb=mysql_query("select * from ussersbanners where Username='$_SESSION[username_session]' and approved<2");
if(mysql_num_rows($rsb)>0) {
while($arrb=mysql_fetch_array($rsb)) {
echo '<hr>';
echo "<center><a href=$arrb[3] target=_blank><img src=$arrb[2] width=125 height=125 border=0></a><br>";
echo '<p>Назначено показов: '.$arrb[4].'<br>';
echo 'Использовано показов: '.($arrb[4]-$arrb[5]).'<br>';
echo 'Кликов: '.$arrb[6].'<br>';
if (($arrb[4]-$arrb[5])>0) {
$ctr=($arrb[6]*100/($arrb[4]-$arrb[5]));
} else {
$ctr=0;
}
echo 'CTR: '.number_format($ctr,2).'%</p>';
if($arrb[7]==0) {
echo '<center>На модерации!</center>';
}
else {
echo "<form action='' method=post><input type=hidden name=id value=$arrb[0]><input type=submit class='button' name=b value=Удалить></form></center>";
}
}
}
}

else {
if($_POST[b]=="Отправить") {
if($_POST[credits]>$unused) {
echo '<center>Нет доступных показов.</center>';
}
elseif($_POST[credits]<1) {
echo '<center>Нет доступных показов.</center>';
}
elseif(($_POST[burl]=="")||($_POST[burl]=="http://")) {
echo '<center>Некорректный URL баннера.</center>';
}
elseif(($_POST[wurl]=="")||($_POST[wurl]=="http://")) {
echo '<center>Некорректный URL сайта.</center>';
}
else {
$burl=str_replace("\"","",$_POST[burl]);
$burl=str_replace("'","",$burl);
$wurl=str_replace("\"","",$_POST[wurl]);
$wurl=str_replace("'","",$wurl);
$sql_i="insert into ussersbanners(Username,BannerURL,WebsiteURL,assigned,remaining,hits,approved,Date) values('$_SESSION[username_session]','$burl','$wurl',$_POST[credits],$_POST[credits],0,0,now())";
include "siteconfig/confff.php";
$rsi=mysql_query($sql_i);
mysql_query("update allussers set bannersused=bannersused+$_POST[credits] where Username='$_SESSION[username_session]'");
echo '<center>Баннер отправлен на модерацию.</center>';
}

}
elseif($_POST[b]=="Предосмотр") {
if($_POST[credits]>$unused) {
echo '<center>Нет доступных показов.</center>';
}
elseif($_POST[credits]<1) {
echo '<center>Нет доступных показов.</center>';
}
elseif(($_POST[burl]=="")||($_POST[burl]=="http://")) {
echo '<center>Некорректный URL баннера.</center>';
}
elseif(($_POST[wurl]=="")||($_POST[wurl]=="http://")) {
echo '<center>Некорректный URL сайта.</center>';
}
else { 
$burl=str_replace("\"","",$_POST[burl]);
$burl=str_replace("'","",$burl);
$burl=str_replace("<a href=","",$burl);
$burl=str_replace("</a>","",$burl);
$burl=str_replace("<img src=","",$burl);
$wurl=str_replace("\"","",$_POST[wurl]);
$wurl=str_replace("'","",$wurl);
$wurl=str_replace("<a href=","",$wurl);
$wurl=str_replace("</a>","",$wurl);
$wurl=str_replace("<img src=","",$wurl);

echo "<center><form action='' method=post><input type=hidden name=burl value=$burl><input type=hidden name=wurl value=$wurl><input type=hidden name=credits value=$_POST[credits]>";
echo "<a href=$wurl><img src=$burl border=0 width=125 height=125></a><br>";
echo 'Если баннер отображается правильно, то нажмите кнопку "Отправить".<br>';
echo "<input type=submit class='button' name=b value=Отправить></form></center>";
}
}
elseif($_POST[b]=="Удалить") {
include "siteconfig/confff.php";
$rs=mysql_query("update ussersbanners set approved=2 where ID=$_POST[id] and Username='$_SESSION[username_session]'");
$rs=mysql_query("select * from ussersbanners where ID=$_POST[id] and Username='$_SESSION[username_session]'");
if(mysql_num_rows($rs)>0) {
$arr=mysql_fetch_array($rs);
$rem=$arr[5];
mysql_query("update allussers set bannersused=bannersused-$rem where Username='$_SESSION[username_session]'");
}

echo '<center>Баннер удален.</center>';
}
}
}
?>
		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
} include "include/footer.php";
?>