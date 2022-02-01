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
					<h1>Условия использования</h1>
				</div>
<p>Посещая сайт или используя на нем изложенную информацию, вы соглашаетесь соблюдать данные условия. Условия находятся в свободном доступе для всех пользователей сайта. Данный сайт является официальным источником информации о проекте &laquo;<?php echo $sitename; ?>&raquo;. Содержащаяйся в нем информация представляет собой актуальный сервис проекта. Предназначение сайта - информировать посетителей об услугах &laquo;<?php echo $sitename; ?>&raquo; и возможностях их получения.</p>
<p>Администрация не несет ответственности, если сайт недоступен для пользователей по независимым причинам от администрации. Администрация имеет право изменить или удалить информацию без предварительного уведомления. Администрация не гарантирует беспрерывную функциональность сайта. Администрация поддерживает сайт и его функциональность в соответствии с правовыми актами регулирующими потоки информации.</p>
<p>Администрация не несет ответственности за любые расходы, потери или убытки (прямые, косвенные, случайные, упущенная выгода и т. д.), которые образовались третьим лицам в связи с посещением сайта или использованием соответствующей информации. Денежные средства, потраченные на оплату вступительного взноса, возврату не подлежат.</p>
<p>Все лица, в любом виде использующие информацию сайта, несут прямую ответственность за свои действия, а также обязаны соблюдать все правила и ограничения пользования информацией, изложенные на данном сайте.</p>
		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
include "include/footer.php";
?>