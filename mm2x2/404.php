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
			<div class="title"><h1>Страница не найдена</h1></div> 
			<div class="choch">404</div>
    	</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
include "include/footer.php";
?>