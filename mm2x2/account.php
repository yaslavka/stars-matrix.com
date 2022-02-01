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
if (empty($ref)) {
$refs="нет спонсора";
}
else {
$rs1=mysql_query("select * from allussers where active=1 and Username='$ref'");
$arr1=mysql_fetch_array($rs1);
$refs="<a href=mailto:$arr1[7]>$ref</a>";
}
$ref=$arr[11];
$username=$_SESSION[username_session];
$status=$arr[14];	
if($status==1) {
$statust="<span>пассивный</span>";
}
else {
$statust="активный";
}
$total=$arr[15];
$paid=$arr[17];
$unpaid=$arr[16];
$city=$arr['City'];
$country=$arr['Country'];
$unused=$totban-$banused;
$unuse=$tottext-$textused;
$rs2=mysql_query("select Username from allussers where active=1 and ref_by='$username'");
?>
	<div class="wrapper">	
		<div class="centerblock">
<?
include "include/accountmenu.php";
?>
<div class="title"><h1>Статистика</h1></div>
<table width="100%">
<tr><td align="left">Статус</td><td align="right"><? echo $statust;?></td></tr>
<tr><td align="left">Баланс</td><td align="right"><span>$</span><? echo $unpaid;?></td></tr>
<tr><td align="left">Общий доход</td><td align="right"><span>$</span><? echo $total;?></td></tr>
<tr><td align="left">Выплачено</td><td align="right"><span>$</span><? echo $paid;?></td></tr>
<tr><td align="left">Спонсор</td><td align="right"><? echo $refs;?></td></tr>
<tr><td align="left">Личных рефералов</td><td align="right"><? echo mysql_num_rows($rs2);?></td></tr>
<tr><td colspan="2" align="left">Реферальная ссылка <a href="<?php echo $siteurl; ?>/?<? echo $id; ?>" target="_blank"><?php echo $siteurl; ?>/?<? echo $id; ?></a></td></tr>
</table>
<div class="title"><h1>Личные рефералы</h1></div>
<table width="100%">
<?
$p=$_GET[p];
$step=20;
$currentpage=$p;
$queryult=("Select * from allussers where active=1 and ref_by='$_SESSION[username_session]' order by ID DESC");
if(!$arr=mysql_query($queryult))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($arr);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
$start=($currentpage-1)*$step;
$query="Select * from allussers where active=1 and ref_by='$_SESSION[username_session]' order by ID DESC";
$queryult=$query . " LIMIT $start,$step";
if(!$rs1=mysql_query($queryult))
{
print mysql_error();
exit;
}
if(mysql_num_rows($rs1)>0) {
echo '<tr><td align="center"><b>Логин</b></td><td align="center"><b>Email</b></td><td align="center"><b>Статус</b></td></tr>';
while($arr=mysql_fetch_array($rs1)) {
if($arr[14]==1) $statusr="<span>пассивный</span>";
else { $statusr="активный";
}
echo '<tr><td align="center">'.$arr[8].'</td><td align="center">'.$arr[7].'</td><td align=center><div class="font">'.$statusr.'</font></td></tr>';
}
}
else {
echo '<tr><td colspan="3" align="center">нет рефералов</td></tr>';
}
if($totallinks>$step)
{
$pagecount=ceil($totallinks/$step);
print "<tr><td colspan='3'>Страницы&nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno!=$i) {
echo("<a href='account.php?p=".$i."'>".$i."</a>&nbsp;");
}
}
print "</td></tr>";
}
?>
</table>
 		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
} include "include/footer.php";
?>