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
					<h1>Продукт</h1>
				</div>
<p>Продуктом проекта является баннерная реклама. За участие в проекте вам начисляются баннерные показы (см. <a href="/">маркетинг</a>). Эти показы вы можете потратить на размещение баннеров формата 125x125 (jpg, gif или png) в ротаторе блока &laquo;Реклама&raquo; нашего сайта. Можно размещать квадратные баннеры большего формата, например, 200x200. Такие баннеры будут автоматически уменьшены до 125x125.</p>
<p>Вы можете одновременно разместить как один, так и несколько баннеров, назначив каждому из них определенное количество показов. Если вы удалите баннер, у которого еще остались неиспользованные показы, то эти показы вернуться вам на счет и вы сможете их использовать для размещения другого баннера.</p>
<p>В своем аккаунте вы можете наблюдать статистику показов, кликов и CTR (эффективность) ваших баннеров.</p>
<p>Аудитория нашего сайта - это люди, которые ищут способы заработка в интернете и за его пределами. Рекламируйте свой бизнес, обучающие материалы по заработку, инструменты для бизнеса, финансовые проекты и т.д.</p>
		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
include "include/footer.php";
?>