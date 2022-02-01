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
?>
	<div class="wrapper">	
		<div class="centerblock">
				<div class="title">
					<h1>Отзывы наших участников</h1>
				</div>
<?
$p=$_GET[p];
$step=10;
$currentpage=$p;
$queryult=("Select * from reviews where status=1 order by ID DESC");
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
$query="Select * from reviews where status=1 order by ID DESC";
$queryult=$query . " LIMIT $start,$step";
if(!$rs1=mysql_query($queryult))
{
print mysql_error();
exit;
}
if(mysql_num_rows($rs1)>0) {
while($arr=mysql_fetch_array($rs1)) {
echo "<div class='reviews'>";
echo "<div class='reviewstext'>".str_replace("\n","<br>",stripslashes($arr[2]))."</div><i>- <span><b>".$arr[1]."</b></span> (".$arr[4].")</i></div>";
} }
elseif(mysql_num_rows($rs1)<=0) {
echo "<p>Отзывов нет!</p>";
}
if($totallinks>$step)
{
$pagecount=ceil($totallinks/$step);
print "Страницы&nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno!=$i) {
echo("<a href='allreviews.php?p=".$i."'>".$i."</a>&nbsp;");
}
}
}
?>
		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
include "include/footer.php";
?>