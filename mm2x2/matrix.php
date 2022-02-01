<?php
session_start();
set_time_limit(0);
include "include/header.php";
include "siteconfig/confff.php";
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
<div class="title"><h1>Матрицы</h1></div>
<?php
include "siteconfig/confff.php";
$totalpos=0;
$rsm1=mysql_query("select * from ussersmatrix1 where Username='$username'");
$totalpos=$totalpos+mysql_num_rows($rsm1);
if ($totalpos<1) {
echo "<p><center>Вы не оплатили вход!<br><br><img src='images/biglogo.png'></center></p>";
}
else {
$pp=$_GET[pp];
$stepm=5;
$currentpages=$pp;
$queryultm=("select ID,Name,fee,levels from ussersmatrices order by Date desc");
if(!$arrp=mysql_query($queryultm))
{
print mysql_error();
exit;
}
$rowm=mysql_num_rows($arrp);
$totallinkss=$rowm;
if(!isset($currentpages))
{
$currentpages=1;
}
$startm=($currentpages-1)*$stepm;
$querym="select ID,Name,fee,levels from ussersmatrices order by Date desc";
$queryultm=$querym . " LIMIT $startm,$stepm";
if(!$rsmm=mysql_query($queryultm))
{
print mysql_error();
exit;
}
while($arrmm=mysql_fetch_array($rsmm)) {
$rsmm1=mysql_query("select * from ussersmatrix$arrmm[0] where Username='$username'");
while($rs=mysql_fetch_row($rsmm1)) {
$idm1=$rs[0];
$ref1=mysql_query("select * from ussersmatrix$arrmm[0] where ref_by='$idm1' order by ID asc limit 1");
$name1=mysql_fetch_array($ref1);
$refname1=$name1[1];
$ids=$name1[0];
$ref2=mysql_query("select * from ussersmatrix$arrmm[0] where ref_by='$idm1' and ID>'$ids' order by ID asc limit 1");
$name2=mysql_fetch_array($ref2);
$refname2=$name2[1];
$lrsm1=mysql_query("select * from ussersmatrix$arrmm[0] where Username='$refname1' and ref_by='$rs[0]' order by ID asc limit 1");
$lrs=mysql_fetch_row($lrsm1);
$idm2=$lrs[0];
$ref3=mysql_query("select * from ussersmatrix$arrmm[0] where ref_by='$idm2' and ref_by>0 order by ID asc limit 1");
$name3=mysql_fetch_array($ref3);
$refname3=$name3[1];
$lids=$name3[0];
$ref4=mysql_query("select * from ussersmatrix$arrmm[0] where ref_by='$idm2' and ref_by>0 and ID>'$lids' order by ID asc limit 1");
$name4=mysql_fetch_array($ref4);
$refname4=$name4[1];
$llrsm1=mysql_query("select * from ussersmatrix$arrmm[0] where Username='$refname2' and ref_by='$rs[0]' and ID>'$idm2' order by ID asc limit 1");
$llrs=mysql_fetch_row($llrsm1);
$idm3=$llrs[0];
$ref5=mysql_query("select * from ussersmatrix$arrmm[0] where ref_by='$idm3' and ref_by>0 order by ID asc limit 1");
$name5=mysql_fetch_array($ref5);
$refname5=$name5[1];
$llids=$name5[0];
$ref6=mysql_query("select * from ussersmatrix$arrmm[0] where ref_by='$idm3' and ref_by>0 and ID>'$llids' order by ID asc limit 1");
$name6=mysql_fetch_array($ref6);
$refname6=$name6[1];
echo "<table width='100%'>";
echo "<tr><td colspan='4' align='center'><h2>$arrmm[1]</h2></td></tr>";
echo "<tr><td colspan='4' align='center'><div class='mup'>ID $rs[0]</div></td></tr>";
echo "<tr><td colspan='2' align='center'><div class='mup'>$refname1</div></td><td colspan='4' align='center'><div class='mup'>$refname2</div></td></tr>";
echo "<tr><td align='center'><div class='mup'>$refname3</div></td><td align='center'><div class='mup'>$refname4</div></td><td align='center'><div class='mup'>$refname5</div></td><td align='center'><div class='mup'>$refname6</div></td></tr>";
echo "</table>";
}
}
if($totallinkss>$stepm)
{
$pagecountm=ceil($totallinkss/$stepm);
print "Страницы&nbsp;&nbsp;";
for($im=1;$im<=$pagecountm;$im++)
{
if($pageno!=$im) {
echo("<a href='matrix.php?pp=".$im."'>".$im."</a>&nbsp;&nbsp;");
}
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