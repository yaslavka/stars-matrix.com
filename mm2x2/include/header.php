<?php
ob_start();
include "siteconfig/confff.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
	<title><?php echo $sitename; ?></title>	 
	<meta charset=utf-8 content="">
	<meta name=robots content="index, follow">		
	<link href="/css/style.css" type="text/css" rel="stylesheet" media="screen">

</head>
<body>
<div class="bodyimg">
	<div class="upfull">
		<div class="upblock">
		<div class="email"><? echo ''.$webmasteremail.''; ?></div>
<? if (empty($skype)) {
echo '';} 
else {
echo '<div class="skype"><a href="https://t.me/millionx2">Телеграмм Чат</a></div>';}
?>
			<div class="logreg">
				<div class="reg">
					<a href="/join.php">Нет аккаунта? &rarr; Регистрация</a>
				</div>
				<div class="log">
					<a href="/account.php">Войти</a>
				</div>
			</div>
		</div>
	</div>		
	<div class="menufull">
	    <div class="menu">
			<div class="menulogo">
				<img src="/images/menulogo.png">
			</div>
			<ul>
				<li><a href="/">Главная</a></li>
				<li><a href="/product.php">Продукт</a></li>
				<li><a href="/news.php">Новости</a></li>
				<li><a href="/allreviews.php">Отзывы</a></li>
				<li><a href="/faq.php">Вопросы</a></li>
			</ul>	
		</div>
	</div>

