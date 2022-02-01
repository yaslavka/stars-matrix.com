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
					<h1>Часто задаваемые вопросы</h1>
				</div>
<p>
<span class="question">С какого возраста можно принимать участие в проекте?</span><br>
На момент регистрации вам должно быть не менее 18 полных лет.
</p>
<div class="hr"></div>
<p>
<span class="question">Можно ли зарегистрироваться с одного компьютера нескольким пользователям или одному пользователю открыть несколько аккаунтов?</span><br>
Можно.
</p>
<div class="hr"></div>
<p>
<span class="question">Каким способом можно оплатить вступительный взнос?</span><br>
Это можно сделать через платежную систему <? if (!empty($qiwi)) { echo 'QIWI (только Россия) или'; } ?> Perfect Money.
</p>
<div class="hr"></div>
<p>
<span class="question">Нужно ли мне будет производить еще какие-нибудь оплаты, кроме вступительного взноса?</span><br>
Нет. Нужно только один раз оплатить вступительный взнос.
</p>
<div class="hr"></div>
<p>
<span class="question">Можно ли оплатить вступительный взнос на разных аккаунтах с одного кошелька <? if (!empty($qiwi)) { echo 'QIWI или'; } ?> Perfect Money?</span><br>
Можно.
</p>
<div class="hr"></div>
<p>
<span class="question">Можно ли выводить денежные средства с разных аккаунтов на один кошелек <? if (!empty($qiwi)) { echo 'QIWI или'; } ?> Perfect Money?</span><br>
Можно.
</p>
<div class="hr"></div>
<p>
<span class="question">Как вывести денежные средства из аккаунта?</span><br>
Нужно заказать выплату, указав номер своего кошелька <? if (!empty($qiwi)) { echo 'QIWI или'; } ?> Perfect Money.
</p>
<div class="hr"></div>
<p>
<span class="question">Какой минимальный размер выплаты?</span><br>
Минимальная сумма заказа равняется <span>$</span><? echo ''.$minwit.'' ?>.
</p>
<div class="hr"></div>
<p>
<span class="question">Взимается ли комиссия при выплатах?</span><br>
Да. Комиссия составляет <? if (!empty($qiwi)) { echo ''.$merchantname1.'% от сумы заказа при выплате на QIWI и'; } echo ' '.$merchantname2.'% от сумы заказа'; if (!empty($qiwi)) { echo ' при выплате на Perfect Money'; } ?>.
</p>
<div class="hr"></div>
<p>
<span class="question">Как долго обрабатывается заказ выплаты?</span><br>
Денежные средства поступят на ваш кошелек в течение 24 часов после заказа.
</p>
<div class="hr"></div>
<p>
<span class="question">Могу ли я зарабатывать в проекте, если я не оплатил вступительный взнос?</span><br>
<? if ($freerefbonus==0) { echo 'Нет.';} elseif ($freerefbonus==1) { echo 'Да. Вы можете получать спонсорские бонусы, приглашая новых участников в проект.';} ?>
</p>
<div class="hr"></div>
<p>
<span class="question">Что такое CTR баннера?</span><br>
Это процентное соотношение количества кликов по баннеру к числу его показов. Например, если ваш баннер был показан 100 раз и при этом по нему кликнули 12 раз, то CTR баннера составит 12%.
</p>
 		</div>
		<? include "include/rightblock.php"; ?>
	</div>
<?
include "include/footer.php";
?>