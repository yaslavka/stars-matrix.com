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
					<h1>Новости</h1>
				</div> 
<?
$p=$_GET[p];
$step=10;
$currentpage=$p;
$queryult=("Select * from sitenews order by ID DESC");
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
$query="Select * from sitenews order by ID DESC";
$queryult=$query . " LIMIT $start,$step";
if(!$rs=mysql_query($queryult))
{
print mysql_error();
exit;
}
if(mysql_num_rows($rs)>0) {
while($arr=mysql_fetch_array($rs))  {
?>			
<div class="news">
<small><i><? echo $arr[3]; ?></i></small><br>
<font class="headnews"><? echo $arr[1]; ?></font><br>
<? echo $arr[2];
echo "</div>";
}
}
elseif(mysql_num_rows($rs)<=0) { ?>    	
<p>Нет новостей!</p>        
<? }
if($totallinks>$step)
{
$pagecount=ceil($totallinks/$step);
print "Страницы&nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno!=$i) {
echo("<a href='news.php?p=".$i."'>".$i."</a>&nbsp;");
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