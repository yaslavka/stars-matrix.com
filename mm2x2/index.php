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
?>
	<div class="wrapper">	
		<div class="centerblock">
			<p>Вы находитесь на официальном сайте проекта «<?php echo $sitename; ?>». Мы предлагаем вам увеличить свои финансовые возможности и кардинально изменить свою жизнь к лучшему путем рекламы вашего бизнеса и создания источника дохода в нашем проекте.</p>
				<div class="title">
					<h1>Маркетинг</h1>
				</div>
			<p><span>Самая короткая живая очередь x2</span> - семиместная матрица, для заполнения которой нужно 6 партнеров: Не важно кто их пригласил любой вновь прибывший партнер автоматически становится в пустое место в порядке живой очереди 2 партнера на 1-ом уровне и 4 партнера на 2-ом уровне.</p>
			<p><span>Партнер</span> - пользователь, который оплатил вступительный взнос (стал участником) и попал в вашу матрицу.</p>
			<p>
<?
include "siteconfig/confff.php";
$rs=mysql_query("select * from ussersmatrices order by ID");
$map=0;
while($arr=mysql_fetch_array($rs))  {
$map++;
echo "<h3>$map-я матрица &laquo;$arr[1]&raquo;</h3>";
if($arr[3]==1) {
echo "<center>Тип матрицы: $arr[5]x$arr[4] <span>индивидуальная</span> <span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Индивидуальная матрица</span> - заполняется партнерами, которых вы лично пригласили в проект (личными рефералами) + кого пригласили ваши приглашенные + переливом от вышестоящих участников.</span></span></center>";
}
else {
echo "<center>Тип матрицы: $arr[5]x$arr[4] <span>коллективная</span> <span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Коллективная матрица</span> (без приглашений) - заполняется партнерами, которых вы получаете автоматически в порядке очереди. Очередь строится по порядку входа в эту матрицу.</span></span></center>";
}
echo "<table width='100%'>";
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Вход</span> - стоимость входа в эту матрицу.</span></span> Вход</td><td align='right'><span>$</span>$arr[2]</td></tr>";
if($arr[49]>0) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Комиссия проекта</span> - взимается за вход в эту матрицу.</span></span> Комиссия проекта</td><td align='right'><span>$</span>$arr[49]</td></tr>";
} else { }
if ($freerefbonus==0) {
$spob="<br><br>Спонсорский бонус могут получать только участники.";
}
elseif ($freerefbonus==1) {
$spob="<br><br>Спонсорский бонус могут получать все зарегистрированные пользователи, в том числе не оплатившие вступительный взнос.";
}
if($arr[84]>0) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Спонсорский бонус</span> - начисляется вам, когда ваш личный реферал входит в эту матрицу.<br><br>За ваш вход в эту матрицу бонус получит пользователь, по чьей реферальной ссылке вы зарегистрировались в проекте.".$spob."</span></span> Спонсорский бонус</td><td align='right'><span>$</span>$arr[84]</td></tr>";
} else { }
$inussersmatrix=($arr[2]-$arr[84]-$arr[49]);
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>В матрицу</span> - размер денежных средств, которые поступают в матрицу.</span></span> В матрицу</td><td align='right'><span>$</span>$inussersmatrix</td></tr>";
if($arr[50]>0) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Баннерные показы за вход</span> - количество баннерных показов, которое начисляется за вход в матрицу.</span></span> Баннерные показы за вход</td><td align='right'>$arr[50]</td></tr>";
} else { }
echo "</table>";
echo "<table width='100%'>";
echo "<tr><td colspan='4' align='center'><div class='mup'>ВЫ</div></td></tr>";
echo "<tr><td colspan='2' align='center'><div class='mup'>Партнер 1</div></td><td colspan='4' align='center'><div class='mup'>Партнер 2</div></td></tr>";
echo "<tr><td align='center'><div class='mup'>Партнер 3</div></td><td align='center'><div class='mup'>Партнер 4</div></td><td align='center'><div class='mup'>Партнер 5</div></td><td align='center'><div class='mup'>Партнер 6</div></td></tr>";
echo "</table>";
echo "<table width='100%'>";
if($arr[52]>0) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Баннерные показы за заполнение</span> - количество баннерных показов, которое начисляется за заполнение матрицы.</span></span> Баннерные показы за заполнение</td><td align='right'>$arr[52]</td></tr>";
} else { }
if($arr[53]==1) {
$sumres=($arr[2]*$arr[54]);
if($arr[54]==1) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Реинвест</span> - автоматический повторный вход в эту же матрицу после ее заполнения.</span></span> $arr[54] реинвест</td><td align='right'><span>$</span>$sumres</td></tr>";
} else {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Реинвест</span> - автоматический повторный вход в эту же матрицу после ее заполнения.</span></span> $arr[54] реинвеста(ов)</td><td align='right'><span>$</span>$sumres</td></tr>";
}
} else {
$sumres=0;
}
if($arr[55]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[57]");
$arrm=mysql_fetch_array($rsm);
if($arr[56]==1) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[56] переход в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>$arrm[2]</td></tr>";
}
else {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[56] перехода(ов) в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>".($arrm[2]*$arr[56])."</td></tr>";
}
} else { }
if($arr[58]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[60]");
$arrm=mysql_fetch_array($rsm);
if($arr[59]==1) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[59] переход в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>$arrm[2]</td></tr>";
} else {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[59] перехода(ов) в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>".($arrm[2]*$arr[59])."</td></tr>";
}
} else { }
if($arr[61]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[63]");
$arrm=mysql_fetch_array($rsm);
if($arr[62]==1) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[62] переход в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>$arrm[2]</td></tr>";
} else {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[62] перехода(ов) в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>".($arrm[2]*$arr[62])."</td></tr>";
}
} else { }
if($arr[64]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[66]");
$arrm=mysql_fetch_array($rsm);
if($arr[65]==1) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[65] переход в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>$arrm[2]</td></tr>";
} else {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[65] перехода(ов) в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>".($arrm[2]*$arr[65])."</td></tr>";
}
} else { }
if($arr[67]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[69]");
$arrm=mysql_fetch_array($rsm);
if($arr[68]==1) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[68] переход в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>$arrm[2]</td></tr>";
} else {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Переход </span> - автоматический вход в другую матрицу после заполнения этой матрицы.</span></span> $arr[68] перехода(ов) в &laquo;$arrm[1]&raquo;</td><td align='right'><span>$</span>".($arrm[2]*$arr[68])."</td></tr>";
}
} else { }
if ($nonussersmatrixmatch==0) {
$matb="<br><br>Матчинг бонус в этой матрице могут получать только участники, совершившие вход в эту матрицу.";
}
elseif ($nonussersmatrixmatch==1) {
$matb="<br><br>Матчинг бонус могут получать все зарегистрированные пользователи, в том числе не оплатившие вступительный взнос.";
}
if($arr[8]>0) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>Матчинг бонус</span> - начисляется вам, когда у вашего личного реферала заполняется эта матрица.<br><br>Когда у вас заполнится эта матрица, то бонус получит пользователь, по чьей реферальной ссылке вы зарегистрировались.".$matb."</span></span> Матчинг бонус</td><td align='right'><span>$</span>$arr[8]</td></tr>";
} else { }
if($arr[7]>0) {
echo "<tr><td align='left'><span class=tooltipques_wrap><span class=ques><small>?</small></span><span class=tooltipques><span>На вывод</span> - размер денежных средств, которые начисляются при заполнении этой матрицы на ваш внутренний счет в проекте. Эти средства вы можете вывести на свой кошелек.</span></span> На вывод</td><td align='right'><span>$</span>$arr[7]</td></tr>";
} else { }
echo "</table>";
}
?>
			</p>
			</div>
			<? include "include/rightblock.php"; ?>
		</div>
<?
include "include/footer.php";
?>