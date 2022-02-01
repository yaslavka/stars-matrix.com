<?ob_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Админ-панель</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700&subset=cyrillic' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="wrapper">
<?php
session_start();
include "../siteconfig/confff.php";
if (!isset($_SESSION["adminarea"]))
{
if ($_POST) {
$a=$_POST["admlog"];
$b=$_POST["admpass"];
} else {
$a="";
}
if ($a==""||$b=="")
{
echo("<div class=logforms><h2>Админ-панель</h2><form action=admin.php method=post>");
echo("Логин<br><input class='logform' type='text' name='admlog'><br>");
echo("Пароль<br><input class='logform' type='password' name='admpass'><br>");
echo("<input class='button' type='submit' value='Войти'></form></div>");
}
else
{
if (($a==$adminuser)&&($b==$adminpass))
{
$Curl=function_exists('curl_version') ? 'Enabled' : 'Disabled' ;
$err=0;
$error="";
$n=trim($_POST[n]);
$n=str_replace("\"","",$n);
$n=str_replace("'","",$n);
$e=trim($_POST[e]);
$e=str_replace("\"","",$e);
$e=str_replace("'","",$e);
$p=trim($_POST[p]);
$p=str_replace("\"","",$p);
$p=str_replace("'","",$p);
$i=trim($_POST[i]);
$i=str_replace("\"","",$i);
$i=str_replace("'","",$i);
$d=trim($_POST[d]);
$d=str_replace("\"","",$d);
$d=str_replace("'","",$d);
$f=trim($_POST[f]);
$f=str_replace("\"","",$f);
$f=str_replace("'","",$f);
$url=$_SERVER["HTTP_HOST"];
$url1=$_SERVER["HTTP_HOST"];
if($url==$url1) {
$_SESSION["adminarea"]=$adminpass;
process();    
}
elseif($url!=$url1) {
echo "<br><center><b><span>На этот домен нет лицензии!</span></b></center>";
}
else {
if($err==3) echo "<center><span>Проблема!</span> Свяжитесь с вашим хостинг-провайдером и попросите его включить модуль <b>allow_url_fopen</b> или модуль <b>Curl</b>!</center>";
elseif($err==4) echo "<center><span>Проблема!</span> Свяжитесь с вашим хостинг-провайдером и попросите проверить почему не работает <b>file_get_contents</b> или попросите включить модуль <b>Curl</b>!</center>";
else echo $homepage;
}
}
else
{
echo("<div class=logforms><span>Неверный логин или пароль!</span><h2>Админ-панель</h2><form action=admin.php method=post>");
echo("Логин<br><input class='logform' type='text' name='admlog'><br>");
echo("Пароль<br><input class='logform' type='password' name='admpass'><br>");
echo("<input class='button' type='submit' value='Войти'></form></div>");
}
}
}
else
{
process();
}
function process() {
include "../siteconfig/confff.php";
$rsm=mysql_query("select * from ussersmatrices order by ID");
$arrm=mysql_fetch_array($rsm);
echo("<table class=nonebord>");
echo("<tr><td><a href=admin.php?b=180>Руководство</a></td><td><a href=admin.php?b=100>Все пользователи</a></td><td><a href=admin.php?b=120>Подтверждение оплат</a></td><td><a href=admin.php?b=170>Баннеры на удтверждении</a></td><td><a href=admin.php?b=30>Отзывы на удтверждении</a></td></tr>");
echo("<tr><td><a href=admin.php?b=10>Настройки</a></td><td><a href=admin.php?b=70>Неактивные пользователи</a></td><td><a href=admin.php?b=150>Заказы выплат</a></td><td><a href=admin.php?b=160>Размещенные баннеры</a></td><td><a href=admin.php?b=20>Размещенные отзывы</a></td></tr>");
echo("<tr><td><a href=admin.php?b=110>Матрицы</a></td><td><a href=admin.php?b=80>Активные пользователи</a></td><td><a href=admin.php?b=140>Завершенные выплаты</a></td><td><a href=admin.php?b=40>Реферальные баннеры</a></td><td><a href=admin.php?b=50>Новости</a></td></tr>");
echo("<tr><td><a href=admin.php?b=190>Выйти</a></td><td><a href=admin.php?b=60>Поиск</a></td><td><a href=admin.php?b=90>ТОП спонсоров</a></td><td><a href=admin.php?b=130>Рассылка писем</a></td><td>&nbsp;</td></tr>");
echo("</table>");
$rsm=mysql_query("select * from ussersmatrices order by ID");
echo("<h3>Структуры матриц</h3>");
while($arrm=mysql_fetch_array($rsm)) {
echo("<div class=matrix><a href=admin.php?b=5&mid=$arrm[0]>$arrm[1]</a></div>");
}
echo("<div class=clear></div><h3>Статистика</h3>");
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
$last3days=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d")-100,date("Y")));
$sql = "select count(*) from allussers where active=1 and status=1";
$result = mysql_query($sql);
$rs  =  mysql_fetch_row($result);
$sql1 = "select count(*) from allussers where active=1 and status=2";
$result1 = mysql_query($sql1);
$rs1  =  mysql_fetch_row($result1);
$sqlpp1 = "select count(*) from allussers where active=0";
$resultpp1 = mysql_query($sqlpp1);
$rspp1  =  mysql_fetch_row($resultpp1);
$sql5 = "select sum(Amount) from transaactions where approved=0";
$result5 = mysql_query($sql5);
$rs5  =  mysql_fetch_row($result5);
$sql6 = "select sum(Amount) from transaactions where approved=1";
$result6 = mysql_query($sql6);
$rs6  =  mysql_fetch_row($result6);
$sqlc1 = "select count(*) from banners";
$resultc1 = mysql_query($sqlc1);
$rsc1  =  mysql_fetch_row($resultc1);
$sqlc2 = "select count(*) from sitenews";
$resultc2 = mysql_query($sqlc2);
$rsc2  =  mysql_fetch_row($resultc2);
$sqlb1 = "select * from ussersbanners where approved=1";
$resultb1 = mysql_query($sqlb1);
$rsb1  =  mysql_num_rows($resultb1);
$sqlb2 = "select * from ussersbanners where approved=0";
$resultb2 = mysql_query($sqlb2);
$rsb2  =  mysql_num_rows($resultb2);
$sqlb44 = "select count(*) from ussersothvar where approved=0";
$resultb44 = mysql_query($sqlb44);
$rsb44  =  mysql_fetch_array($resultb44);
$sqlb55 = "select count(*) from ussersothvar where approved=1";
$resultb55 = mysql_query($sqlb55);
$rsb55  =  mysql_fetch_array($resultb55);
$rstt=mysql_query("select * from reviews where status>0");
$rstt1=mysql_query("select * from reviews where status=0");
mysql_query("delete from btransactions where Date<'$last3days'");
$sqlpt = "select count(*) from btransactions";
$resultpt = mysql_query($sqlpt);
$rspt  =  mysql_fetch_row($resultpt);
$sqlbl2m = "select * from ussersmatrices";
$resultbl2m = mysql_query($sqlbl2m);
$rsbl2m  =  mysql_num_rows($resultbl2m);
echo("<table class=nonebord>");
echo("<tr><td>Всего пользователей&nbsp;<span>".($rs[0]+$rs1[0]+$rspp1[0])."</span></td><td>Выплачено&nbsp;<span>$</span>".(0+$rs6[0])."</td><td>Баннеров на удтверждении&nbsp;<span>".$rsb2."</span></td><td>Отзывов на удтверждении&nbsp;<span>".mysql_num_rows($rstt1)."</span></td></tr>");
echo("<tr><td>Неактивных пользователей&nbsp;<span>".$rs[0]."</span></td><td>Заказано на выплату&nbsp;<span>$</span>".(0+$rs5[0])."</td><td>Удтвержденных баннеров&nbsp;<span>".$rsb1."</span></td><td>Удтвержденных отзывов&nbsp;<span>".mysql_num_rows($rstt)."</span></td></tr>");
echo("<tr><td>Активных пользователей&nbsp;<span>".$rs1[0]."</span></td><td>Оплат на подтверждении&nbsp;<span>".$rspt[0]."</span></td><td>Реферальных баннеров&nbsp;<span>".$rsc1[0]."</span></td><td>Опубликовано новостей&nbsp;<span>".$rsc2[0]."</span></td></tr>");
echo("</table>");
echo("<div class=clear></div><h3>Активных позиций в матрицах</h3>");
$totalm=0;
$rsm=mysql_query("select * from ussersmatrices order by ID");
while($arrm=mysql_fetch_array($rsm)) {
$sql = "select count(*) from ussersmatrix$arrm[0]";
$result = mysql_query($sql);
$rs  =  mysql_fetch_row($result);
echo("<div class=matrix>$arrm[1]&nbsp;<span>".$rs[0]."</span></div>");
$totalm=$totalm+$rs[0];
}
echo("<div class=clear></div>");
$p=$_GET[p];
$b=$_GET[b];
if(!$b) $b=$_POST[b];
$id=$_POST[id];
$act=$_GET[act];
$edit=$_POST[edit];
if ($b=="10")
{
echo "<h4>Настройки</h4>";
if (!$_POST)
{
$sql = "select * from topsettings";
$result = mysql_query($sql);
$rs  =  mysql_fetch_array($result);
$sqlb = "select * from bantopsettings";
$resultb = mysql_query($sqlb);
$rsb  =  mysql_fetch_array($resultb);
$sqlt = "select * from textopsettings";
$resultt = mysql_query($sqlt);
$rst  =  mysql_fetch_array($resultt);
echo("<table class=nonebord><form action='admin.php?b=10' method=post><input type=hidden name=id value=".$id."><input type=hidden name=edit value=1>");
echo("<tr><td>Название проекта</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Введите название вашего проекта без кавычек и других знаков препинания. Например, <span>Money Matrix</span> или <span>Денежная матрица</span>.</div></div><input class=logform type=text name=asitename value='".$rs[0]."'></td></tr>");
echo("<tr><td>Адрес сайта</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Без <span>/</span> на конце, например, <span>http://www.sitename.com</span> или <span>http://sitename.com</span>.</div></div><input class=logform type=text name=asiteurl value='".$rs[1]."'></td></tr>");
echo("<tr><td>Email админа</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Он будет указан на странице контактов и на него будут приходить письма через форму обратной связи. Например, <span>project@gmail.com</span>.</div></div><input class=logform type=text name=aemail value='".$rs[2]."'></td></tr>");
echo("<tr><td>Телеграмм Чат проекта</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Указывать необязательно (оставьте пустым). Если укажите, то он появится на странице контактов. Например, <span>myskype</span>.</div></div><input class=logform type=text name=skype value='".$rs[8]."'></td></tr>");
echo("<tr><td>Логин админ-панели</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Введите желаемый логин для входа в админ-панель.</div></div><input class=logform type=text name=ausername value='".$rs[3]."'></td></tr>");
echo("<tr><td>Пароль админ-панели</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Введите желаемый пароль для входа в админ-панель. Используйте сложный пароль с цифрами и различными знаками, такими как <span>@</span>, <span>#</span>, <span>$</span>, <span>%</span>, <span>?</span>, <span>*</span> и др.</div></div><input class=logform type=text name=apassword value='".$rs[4]."'></td></tr>");
echo("<tr><td>Кошелек Perfect Money</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Укажите кошелек Perfect Money, на который вы будете принимать оплаты от пользователей, например, <span>U1234567</span>.</div></div><input class=logform type=text name=perfectmoney value='".$rs[7]."'></td></tr>");
echo("<tr><td>Комиссия на выплаты через Perfect Money</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Укажите размер комиссии, которая будет автоматически сниматься с суммы заказа при выплатах через Perfect Money. Например, <span>0.5</span>. Рекомендуется установить размер комиссии, которую снимает с вас Perfect Money за перевод средств.</div></div><input class=logform type=text name=mn2 value='".stripslashes($rs[50])."'>%</td></tr>");
echo("<tr><td>Идентификатор (логин) <a href='https://ishop.qiwi.ru/register.action' target='_blank'>QIWI ishop</a></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Указывать необязательно (оставьте пустым). Если вы хотите принимать оплаты через QIWI, то вам необходимо отправить заявку на подключение в QIWI ishop (в поле <b>Описание деятельности магазина</b> введите <span>Продажа рекламы на сайте</span>). После одобрения заявки введите свой идентификатор QIWI ishop в это поле. Например, <span>123456</span>.</div></div><input class=logform type=text name=qiwi value='".$rs[9]."'></td></tr>");
echo("<tr><td>Комиссия на выплаты через QIWI</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Если подключен QIWI ishop, то укажите размер комиссии, которая будет автоматически сниматься с суммы заказа при выплатах через QIWI. Например, <span>1</span>. Рекомендуется установить размер комиссии, которую снимает с вас QIWI ishop за перевод средств.</div></div><input class=logform type=text name=mn1 value='".stripslashes($rs[48])."'>%</td></tr>");
echo("<tr><td>Курс доллара к рублю</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Если подключен QIWI ishop, то укажите для автоматической конвертации долларов в рубли при оплатах и выплатах через QIWI. Например, <span>33</span>.</div></div>1 USD=<input class=logform type=text name=dolkurs value='".$rs[10]."'> RUB</td></tr>");
echo("<input type=hidden name=ipncode value='".$rs[64]."'>");	
echo("<input type=hidden name=emerchants value='".$rs[47]."'>");	  
echo("<input type=hidden name=mc1 value='".stripslashes($rs[49])."'>");
echo("<input type=hidden name=mc2 value='".stripslashes($rs[51])."'>");
echo("<input type=hidden name=mn3 value='".stripslashes($rs[52])."'>");
echo("<input type=hidden name=mc3 value='".stripslashes($rs[53])."'>");
echo("<input type=hidden name=mn4 value='".stripslashes($rs[54])."'>");
echo("<input type=hidden name=mc4 value='".stripslashes($rs[55])."'>");
echo("<input type=hidden name=mn5 value='".stripslashes($rs[56])."'>");
echo("<input type=hidden name=mc5 value='".stripslashes($rs[57])."'>");
echo("<tr><td>Не имеющие позиции будут получать матчинг бонус?</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Если <span>да</span>, то пользователи, которые не имеют ни одной позиции в конкретной матрице, тоже смогут получать в этой матрице матчинг бонус.</div></div><select class=logform name=nonussersmatrixmatch>");
if($rs[66]==0) {
echo "<option value=0 selected>Нет</option>
<option value=1>Да</option>";
}
elseif($rs[66]==1) {
echo "<option value=0>Нет</option>
<option value=1 selected>Да</option>";
}
echo("</select></td></tr>");
echo("<tr><td>Неактивные будут получать спонсорский бонус?</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Если <span>да</span>, то пользователи, которые не оплатили вступительный взнос, тоже смогут получать спонсорский бонус.</div></div><select class=logform name=freerefbonus>");
if($rs[67]==0) {
echo "<option value=0 selected>Нет</option>
<option value=1>Да</option>";
}
elseif($rs[67]==1) {
echo "<option value=0>Нет</option>
<option value=1 selected>Да</option>";
}
echo("</select></td></tr>");
echo("<tr><td>Минимальный заказ выплаты</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Укажите минимальную сумму, которая должна быть на балансе пользователя, чтобы он смог заказать выплату. Например, <span>5</span>.</div></div>$<input class=logform type=text name=minwit value='".$rs[13]."'></td></tr>");
echo("<tr><td colspan=2><h6>Системные письма</h6>
Вы можете использовать в письмах следующие теги:<br>
<span>{username}</span> логин пользователя<br>
<span>{password}</span> пароль пользователя<br>
<span>{email}</span> Email пользователя<br>
<span>{sitename}</span> название проекта ($sitename)<br>
<span>{siteurl}</span> адрес сайта проекта ($siteurl)</td></tr>");
echo("<tr><td colspan=2><h3>Приветственное письмо</h3></td></tr>");
echo("<tr><td>Тема</td><td><input class=logform type=text name=subject2 value=\"".stripslashes($subject2)."\"></td></tr>");
echo("<tr><td>Формат</td><td><select class=logform name=eformat2>");
if($eformat2==1) {
echo "<option value=1 selected>Текст</option>
<option value=2>HTML</option>";
}
else {
echo "<option value=1>Текст</option>
<option value=2 selected>HTML</option>";
}
echo("</td></tr><tr><td>Содержание</td><td><textarea name=message2>".stripslashes($message2)."</textarea></td></tr>");
echo("<tr><td colspan=2><h3>Восстановление пароля</h3></td></tr>");
echo("<tr><td>Тема</td><td><input class=logform type=text name=subject5 value=\"".stripslashes($subject5)."\"></td></tr>");
echo("<tr><td>Формат</td><td><select class=logform name=eformat5>");
if($eformat5==1) {
echo "<option value=1 selected>Текст</option>
<option value=2>HTML</option>";
}
else {
echo "<option value=1>Текст</option>
<option value=2 selected>HTML</option>";
}
echo("</td></tr><tr><td>Содержание</td><td><textarea name=message5>".stripslashes($message5)."</textarea></td></tr>");
echo("<tr><td colspan=2><hr>
Дополнительные теги:<br>
<span>{banner}</span> URL баннера<br>
<span>{websiteurl}</span> URL сайта (из баннера)<hr></td></tr>");
echo("<tr><td colspan=2><h3>Когда баннер одобрен</h3></td></tr>");
echo("<tr><td>Тема</td><td><input class=logform type=text name=subject6 value=\"".stripslashes($subject6)."\"></td></tr>");
echo("<tr><td>Формат</td><td><select class=logform name=eformat6>");
if($eformat6==1) {
echo "<option value=1 selected>Текст</option>
<option value=2>HTML</option>";
}
else {
echo "<option value=1>Текст</option>
<option value=2 selected>HTML</option>";
}
echo("</td></tr><tr><td>Содержание</td><td><textarea name=message6>".stripslashes($message6)."</textarea></td></tr>");
echo("<tr><td colspan=2><h3>Когда баннер удален</h3></td></tr>");
echo("<tr><td>Тема</td><td><input class=logform type=text name=subject7 value=\"".stripslashes($subject7)."\"></td></tr>");
echo("<tr><td>Формат</td><td><select class=logform name=eformat7>");
if($eformat7==1) {
echo "<option value=1 selected>Текст</option>
<option value=2>HTML</option>";
}
else {
echo "<option value=1>Текст</option>
<option value=2 selected>HTML</option>";
}
echo("</td></tr><tr><td>Содержание</td><td align=left><textarea name=message7>".stripslashes($message7)."</textarea></td></tr>");
echo("<tr><td colspan=2><hr><input class=button type=submit value='Сохранить настройки'></form></table>");
}
else
{
$sql_u="update topsettings set
sitename='$_POST[asitename]',
siteurl='$_POST[asiteurl]',
Email='$_POST[aemail]',
Username='$_POST[ausername]',
Password='$_POST[apassword]',
topbanner='$_POST[topban]',
bottombanner='$_POST[botban]',
dolkurs='$_POST[dolkurs]',
qiwi='$_POST[qiwi]',
perfectmoney='$_POST[perfectmoney]',
skype='$_POST[skype]',
eformat2='$_POST[eformat2]',
eformat5='$_POST[eformat5]',
eformat6='$_POST[eformat6]',
eformat7='$_POST[eformat7]',
nonussersmatrixmatch='$_POST[nonussersmatrixmatch]',
freerefbonus='$_POST[freerefbonus]',
Merchants='$_POST[emerchants]',
minwithdrawal='$_POST[minwit]'
";
$rs=mysql_query($sql_u);
$subject2=addslashes($_POST[subject2]);
mysql_query("update topsettings set Subject2='$subject2'");
$subject5=addslashes($_POST[subject5]);
mysql_query("update topsettings set Subject5='$subject5'");
$subject6=addslashes($_POST[subject6]);
mysql_query("update topsettings set Subject6='$subject6'");
$subject7=addslashes($_POST[subject7]);
mysql_query("update topsettings set Subject7='$subject7'");
$message2=addslashes($_POST[message2]);
mysql_query("update topsettings set Message2='$message2'");
$message5=addslashes($_POST[message5]);
mysql_query("update topsettings set Message5='$message5'");
$message6=addslashes($_POST[message6]);
mysql_query("update topsettings set Message6='$message6'");
$message7=addslashes($_POST[message7]);
mysql_query("update topsettings set Message7='$message7'");
$freebonus=addslashes($_POST[freebonus]);
mysql_query("update topsettings set freebonus='$freebonus'");
$mn1=addslashes($_POST[mn1]);
$mn2=addslashes($_POST[mn2]);
$mn3=addslashes($_POST[mn3]);
$mn4=addslashes($_POST[mn4]);
$mn5=addslashes($_POST[mn5]);
$mc1=addslashes($_POST[mc1]);
$mc2=addslashes($_POST[mc2]);
$mc3=addslashes($_POST[mc3]);
$mc4=addslashes($_POST[mc4]);
$mc5=addslashes($_POST[mc5]);
mysql_query("update topsettings set MerchantName1='$mn1'");
mysql_query("update topsettings set MerchantCode1='$mc1'");
mysql_query("update topsettings set MerchantName2='$mn2'");
mysql_query("update topsettings set MerchantCode2='$mc2'");
mysql_query("update topsettings set MerchantName3='$mn3'");
mysql_query("update topsettings set MerchantCode3='$mc3'");
mysql_query("update topsettings set MerchantName4='$mn4'");
mysql_query("update topsettings set MerchantCode4='$mc4'");
mysql_query("update topsettings set MerchantName5='$mn5'");
mysql_query("update topsettings set MerchantCode5='$mc5'");
$sql_u="update bantopsettings set 
showban=4";
$rs=mysql_query($sql_u);
$sql_u="update textopsettings set 
nads=0";
$rs=mysql_query($sql_u);
echo("<h2>Изменения сохранены!</h2>");
}
}
elseif($b=="20") {
$rs=mysql_query("select * from reviews where status=1");
if(mysql_num_rows($rs)>0) {
echo("<h4>Размещенные отзывы</h4><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center width=100><b>Логин</b></td><td width=450 align=center><b>Отзыв</b></td><td width=90 align=center><b>Дата</b></td><td align=center><b>Действия</b></td></tr>");
while($arr=mysql_fetch_array($rs)) {
echo("<tr><td align=center>".$arr[0]."</td><td align=center>".$arr[1]."</td><td align=center>".str_replace("\n","<br>",$arr[2])."</td><td align=center>".$arr[4]."</td>");
echo("<td align=center><form action=admin.php method=post><input type=hidden name=id value=".$arr[0]."><input class=button type=submit name=\"b\" value=\"Исправить отзыв\">&nbsp;<input class=button type=submit name=\"b\" value=\"Удалить отзыв\"></form></td></tr>");
}
echo("</table>");
}
else {
echo("<h4>Размещенные отзывы</h4><center>Нет отзывов!</center>");
}
}
elseif($b=="30") {
$rs=mysql_query("select * from reviews where status=0");
if(mysql_num_rows($rs)>0) {
echo("<h4>Отзывы на удтверждении</h4><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center width=100><b>Логин</b></td><td width=450 align=center><b>Отзыв</b></td><td width=90 align=center><b>Дата</b></td><td align=center><b>Действия</b></td></tr>");
while($arr=mysql_fetch_array($rs)) {
echo("<tr><td align=center>".$arr[0]."</td><td align=center>".$arr[1]."</td><td align=center>".str_replace("\n","<br>",$arr[2])."</td><td align=center>".$arr[4]."</td>");
echo("<td align=center><form action=admin.php method=post><input type=hidden name=id value=".$arr[0]."><input class=button type=submit name=\"b\" value=\"Разместить отзыв\">&nbsp;<input class=button type=submit name=\"b\" value=\"Исправить отзыв\">&nbsp;<input class=button type=submit name=\"b\" value=\"Удалить отзыв\"></form></td></tr>");
}
echo("</table>");
}
else {
echo("<h4>Отзывы на удтверждении</h4><center>Нет отзывов!</center>");
}
}
elseif($b=="Исправить отзыв") {
if($_POST["data"]!="") {
mysql_query("update reviews set data='$_POST[data]' where ID=$_POST[id]");
echo("<h2>Отзыв исправлен!</h2>");
}
$rs=mysql_query("select * from reviews where ID=".$_POST["id"]);
echo("<h4>Исправление отзыва</h4><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center width=100><b>Логин</b></td><td width=450 align=center><b>Отзыв</b></td><td width=90 align=center><b>Дата</b></td><td align=center><b>Действия</b></td></tr>");
while($arr=mysql_fetch_array($rs)) {
echo("<tr><form action=admin.php method=post><td align=center>".$arr[0]."</td><td align=center>".$arr[1]."</td><td align=center><textarea name=data>".$arr[2]."</textarea></td><td align=center>".$arr[4]."</td>");
echo("<td align=center><input type=hidden name=id value=".$arr[0]."><input class=button type=submit name=\"b\" value=\"Исправить отзыв\"></form></td></tr>");
}
echo("</table>");
}
elseif($b=="Удалить отзыв") {
mysql_query("delete from reviews where ID=".$_POST["id"]);
echo("<h2>Отзыв удален!</h2>");
}
elseif($b=="Разместить отзыв") {
mysql_query("Update reviews set status=1 where ID=".$_POST["id"]);
echo("<h2>Отзыв размещен!</h2>");
}
elseif($b=="190") {
$_SESSION["adminarea"]="";
session_unregister('adminarea');
session_destroy(); 
?>
<script>
location.href='admin.php';
</script>
<?
}
elseif ($b=="40") {
print "<h4>Реферальные баннеры</h4>
<center>Добавьте изображение jpg, gif или png в папку <span>banners</span>, вставьте ссылку на него в поле ниже и нажмите <span>Добавить реф. баннер</span>. Баннер будет добавлен в аккаунты пользователей. Максимальная ширина изображения 468 пикселей (баннер 468x60).<br><br>
Вы можете добавить уже существующие баннеры:<br><b>$siteurl/banners/468x60.gif</b><br><b>$siteurl/banners/200x200.gif</b><br><b>$siteurl/banners/240x400.gif</b><br><b>$siteurl/banners/125x125.gif</b><br><br>
<form action=admin.php method=post>
URL баннера<input class=logforml type=text name=burl size=45 value='$siteurl/banners/468x60.gif'><input class=button type=submit name=\"b\" value=\"Добавить реф. баннер\"></form></center>";
$rs=mysql_query("select * from banners order by ID");
print "<h3>Добавленные баннеры</h3>";
print "<table border=1 cellspacing=0><tr><td width=20 align=center><b>ID</b></td><td width=480 align=center><b>Баннер</b></td><td width=90 align=center><b>Дата</b></td><td align=center><b>Действия</b></td></tr>";
while($arr=mysql_fetch_array($rs))  {
print "<tr><td align=center>$arr[0]</td><td align=center><img src='$arr[1]'><br>$arr[1]</td><td align=center>$arr[2]</td><td align=center>";
print "<form action=admin.php method=post><input type=hidden name=id value=".$arr[0].">&nbsp;<input class=button type=submit name=\"b\" value=\"Удалить реф. баннер\"></form></td></tr>";
}
print "</table>";
}
elseif ($b=="Добавить реф. баннер") {
$rs=mysql_query("insert into banners(BannerURL,Date) values('$_POST[burl]',now())");
print "<h2>Реф. баннер добавлен!</h2>";
}
elseif ($b=="Удалить реф. баннер") {
$rs=mysql_query("delete from banners where ID=".$_POST["id"]);
print "<h2>Реф. баннер удален!</h2>";
}
elseif ($b=="50") {
print "<h4>Новости</h4>
<table>
<form action=admin.php method=post>
<tr><td>Заголовок</td><td><input class=logform type=text name=subject value=''></td><tr>
<tr><td>Содержание</td><td><textarea name=message></textarea></td><tr>
<tr><td colspan=2><hr><input class=button type=submit name=\"b\" value=\"Добавить новость\"></form></td><tr>
</table>";
$rs=mysql_query("select * from sitenews order by ID DESC");
print "<h3>Добавленные новости</h3>";
print "<table border=1 cellspacing=0><tr><td width=20 align=center><b>ID</b></td><td align=center width=480><b>Новость</b></td><td width=90 align=center><b>Дата</b></td><td align=center><b>Действия</b></td></tr>";
while($arr=mysql_fetch_array($rs))  {
print "<tr><td align=center>$arr[0]</td><td align=center><b>Заголовок</b><br>".stripslashes($arr[1])."
<br><b>Содержание</b><br>".stripslashes(str_replace("\n","<br>",$arr[2]))."</td><td align=center>$arr[3]</td>";
print "<td align=center><form action=admin.php method=post><input type=hidden name=id value=".$arr[0]."><input class=button type=submit name=\"b\" value=\"Удалить новость\"></form></td></tr>";
}
print "</table>";
}
elseif($b=="Добавить новость") {
if($_POST[subject]=="") {
echo "<h2>Не указан заголовок!</h2>";
}
elseif($_POST[message]=="") {
echo "<h2>Не указано содержание!</h2>";
}
else {
$subject=addslashes($_POST[subject]);
$message=addslashes($_POST[message]);
mysql_query("insert into sitenews(Subject,Message,Date) values('$subject','$message',now())");
print "<h2>Новость добавлена!</h2>";
}
}
elseif ($b=="Удалить новость") {
mysql_query("delete from sitenews where ID=".$_POST["id"]);
print "<h2>Новость удалена!</h2>";
}
elseif($b=="180") {
?>
<h4>Руководство</h4>
<p><b>1.</b> Отредактируйте раздел <a href="admin.php?b=10">Настройки</a>.</p><hr>
<p><b>2.</b> Отредактируйте раздел <a href="admin.php?b=110">Матрицы</a>. Там у вас уже будет 1 созданная матрица, ее <b>УДАЛЯТЬ НЕЛЬЗЯ</b>, но можно <b>редактировать</b> как вам угодно. Это будет ваша первая матрица в маркетинге, вход в которую будут оплачивать пользователи. </p><hr>
<p><b>3.</b> Отредактируйте раздел <a href="admin.php?b=40">Реферальные баннеры</a>.</p><hr>
<p><b>4.</b> Проект готов к работе. Опубликуйте первую <a href="admin.php?b=50">новость</a> об открытии проекта.</p><hr>
<p><b>5.</b> В разделах <b>Активные пользователи</b>, <b>Неактивные пользователи</b> и <b>Все пользователи</b> находятся списки пользователей соответственно оплативших вступительный взнос, не оплативших вступительный взнос и всех вместе. Вы можете просматривать полную информацию о каждом пользователе, удалять пользователей и редактировать их данные.</p><hr>
<p><b>6.</b> В разделе <b>Поиск</b> вы можете быстро найти нужного пользователя по его <b>логину</b> или <b>Email</b>.</p><hr>
<p><b>7.</b> Раздел <b>Подтверждение оплат</b>. Вам на Email, указанный в разделе <b>Настройки</b>, будут приходить оповещения об оплатах, в которых будет такая строчка: <b>ID_id_user_login</b>, где <b>id</b> - ID транзакции, <b>login</b> - логин пользователя. По этим данным находите в таблице нужную транзакцию и нажимаете кнопку <b>Подтвердить оплату</b>.</p>
<p><b>Примечание 1</b>. Чтобы на Email приходили оповещения об оплатах через QIWI, нужно отметить это в настройках аккаунта <a href='http://ishopnew.qiwi.ru/' target='_blank'>QIWI ishop</a>.</p>
<p><b>Примечание 2</b>. При оплате через Perfect Money пользователь может стереть примечание и тогда в оповещении не будут указаны ID и логин, но они все равно передадутся в ваш аккаунт Perfect Money. В этом случае вам нужно зайти в свой аккаунт Perfect Money и найти эту транзакцию в выписке кошелька по номеру транзакции (batch номеру) из оповещения. В примечании будут указаны ID и логин оплатившего пользователя.</p><hr>
<p><b>8.</b> Раздел <b>Заказы выплат</b>. Когда пользователи делают заказы выплаты, то в этом разделе появляются данные этих заказов. Сначала нажимаете на кнопку <b>Выплатить</b>, появится название платежной системы, номер кошелька пользователя и точная сумма заказа уже с учетом комиссии на выплаты.</p>
<p><b>Как выплатить на Perfect Money</b>. Войдите в свой аккаунт <a href='https://perfectmoney.is/' target='_blank'>Perfect Money</a> и переведите сумму заказа на указанный в заказе кошелек. В примечании укажите, например, <b>Выплата из проекта "Название проекта"</b>.</p>
<p><b>Как выплатить на QIWI</b>. Войдите в свой аккаунт <a href='http://ishopnew.qiwi.ru/' target='_blank'>QIWI ishop</a>. В левом меню выберите <b>Оплата услуг</b>. В поле поиска провайдеров введите <b>Visa QIWI Wallet</b>. Укажите сумму заказа и номер кошелька из заказа. В комментарии укажите, например, <b>Выплата из проекта "Название проекта"</b>. Нажмите <b>Перевести</b>.</p><hr>
<p><b>9.</b> В разделе <b>Завершенные выплаты</b> находится список всех сделанных вами выплат.</p><hr>
<p><b>10.</b> В разделе <b>ТОП спонсоров</b> находится список из 100 пользователей с наибольшим количеством личных рефералов.</p><hr>
<p><b>11.</b> Раздел <b>Баннеры на удтверждении</b>. Когда пользователи добавляют свои баннеры для показа на сайте, то в этом разделе появляются данные этих баннеров. Вы можете одобрять размещение, редактировать и удалять баннеры как по отдельности, так и все сразу.</p><hr>
<p><b>12.</b> В разделе <b>Размещенные баннеры</b> находится список и статистика всех одобренных к размещению баннеров. Вы можете редактировать и удалять эти баннеры как по отдельности, так и все сразу.</p><hr>
<p><b>13.</b> В разделе <b>Рассылка писем</b> вы можете рассылать письма всем неактивным, всем активным или вообще всем пользователям.</p><hr>
<p><b>14.</b> Раздел <b>Отзывы на удтверждении</b>. Когда пользователи добавляют свои отзывы о проекте, то в этом разделе появляются данные этих отзывов. Вы можете одобрять размещение, редактировать и удалять отзывы.</p><hr>
<p><b>15.</b> В разделе <b>Размещенные отзывы</b> находится список всех одобренных к размещению отзывов. Вы можете редактировать и удалять эти отзывы.</p>
<?
}
elseif ($b=="60")
{
echo "<h4>Поиск пользователей</h4>";
if (!$_POST)
{
echo("<center>Укажите <span>Логин</span> или <span>Email</span> пользователя.");
echo("<form action='admin.php?b=60' method=post><input class=logform type=text name=user>");
echo("<input class=button type=submit value='Найти'></form></center>");
}
else
{
$user=$_POST[user];
$sql="select * from allussers where Name like '%$user%' or Email like '%$user%' or Username like '%$user%'";
$res=mysql_query($sql);
if(mysql_num_rows($res)>0) {
$rowcount=0;
echo("<br><table border=1 cellspacing=0><tr><td align=center width=20><b>№</b></td><td align=center><b>Email</b></td><td width=90 align=center><b>Логин</b></td><td width=90 align=center><b>Статус</b></td><td align=center><b>Действия</b></td></tr>");
while($rs=mysql_fetch_row($res))
{   
if($rs[14]==1) {
$st="<span>Неактивный</span>";
}
else {
$st="Активный";
}
$rowcount=$rowcount+1;
$no = $rowcount;
echo("<tr><form action='admin.php' method=post><input type=hidden name=id value=".$rs[0]."><td align=center>".$no."</td><td align=center>".$rs[7]."</td><td align=center>".$rs[8]."</td><td align=center>".$st."</td>");
echo("<td align=center><input type=hidden name=atype value=".$number."><input class=button type=submit name='b' value='Информация'>&nbsp;");
echo("<input class=button type=submit name='b' value='Удалить аккаунт'></form></td></tr>");
}
echo("</table>");
}
else {
echo "<h2>Поиск не дал результатов!</h2>";
}
}
}
elseif (trim($b)==70)
{
echo "<h4>Неактивные пользователи</h4>";
$query="select * from allussers where active=1 and status=1 order by ID";
$step=50;
$currentpage = $p;
$sql="select * from allussers where active=1 and status=1";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from allussers where active=1 and status=1 order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
echo("<br><table border=1 cellspacing=0><tr><td width=20 align=center><b>№</b></td><td align=center><b>Email</b></td><td width=90 align=center><b>Логин</b></td><td width=90 align=center><b>Статус</b></td><td align=center><b>Действия</b></td></tr>");
while($rs=mysql_fetch_row($result))
{
$rowcount=$rowcount+1;
$no = (intval($currentpage* 50)-50 + $rowcount);  
if($rs[14]==1) {
$st="<span>Неактивный</span>";
}
else {
$st="Активный";
}
echo("<tr><form action='admin.php' method=post><input type=hidden name=id value=".$rs[0]."><td align=center>".$no."</td><td align=center>".$rs[7]."</td><td align=center>".$rs[8]."</td><td align=center>".$st."</td><td align=center>");
echo("<input type=hidden name=atype value=".$number.">");
echo("<input class=button type=submit name='b' value='Информация'>&nbsp;<input class=button type=submit name='b' value='Удалить аккаунт'></form></td></tr>");
}
echo("</table>");
}
elseif (trim($b)==80)
{
echo "<h4>Активные пользователи</h4>";
$query="select * from allussers where active=1 and status=2 order by ID";
$step=50;
$currentpage = $p;
$sql="select * from allussers where active=1 and status=2";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from allussers where active=1 and status=2 order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
echo("<br><table border=1 cellspacing=0><tr><td width=20 align=center><b>№</b></td><td align=center><b>Email</b></td><td width=90 align=center><b>Логин</b></td><td width=90 align=center><b>Статус</b></td><td align=center><b>Действия</b></td></tr>");
while($rs=mysql_fetch_row($result))
{
$rowcount=$rowcount+1;
$no = (intval($currentpage* 50)-50 + $rowcount);
if($rs[10]==0) {
$st="";
} else {
if($rs[14]==1) {
$st="<span>Неактивный</span>";
}
else {
$st="Активный";
}
}
echo("<tr><form action='admin.php' method=post><input type=hidden name=id value=".$rs[0]."><td align=center>".$no."</td><td align=center>".$rs[7]."</td><td align=center>".$rs[8]."</td><td align=center>".$st."</td><td align=center>");
echo("<input type=hidden name=atype value=".$number.">");
echo("<input class=button type=submit name='b' value='Информация'>&nbsp;<input class=button type=submit name='b' value='Удалить аккаунт'></form></td></tr>");
}
echo("</table>");
}
elseif($b==90) {
include "confff.php";
$rs=mysql_query("select * from allussers where active=1");
$i=0;
while($arr=mysql_fetch_array($rs)) {
if($arr[11]=="") {
}
else {
$a[$i]=$arr[8];
$bb[$i]=$arr[11];
$i++;
}
}
if($i>0) {
$e=my_array_unique($bb);
for($j=0;$j<count($e);$j++) {
$c[$j]=0;
}
for($j=0;$j<count($e);$j++) {
for($l=0;$l<count($bb);$l++) {
if($bb[$l]==$e[$j]) {
$c[$j]=$c[$j]+1;
}
}
}
$rs=mysql_query("drop table topsponsors");
$rs=mysql_query("create table topsponsors( ID text,ref int unsigned not null)");
for($j=0;$j<count($e);$j++) {
$rs=mysql_query("insert into topsponsors values('$e[$j]','$c[$j]')");
}
echo "<h4>ТОП 100 спонсоров</h4>";
$rs=mysql_query("select * from topsponsors order by ref desc limit 0,100");
echo "<table border=1 cellspacing=0>";
echo "<tr><td align=center><b>Логин</b></td><td align=center><b>Активных рефералов</b></td><td align=center><b>Нективных рефералов</b></td><td align=center><b>Всего рефералов</b></td></tr>";
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from allussers where Username='$arr[0]'");
$arr1=mysql_fetch_array($rs1);
$rs2=mysql_query("select * from allussers where status=2 and active=1 and ref_by='$arr[0]'");
$rs3=mysql_query("select * from allussers where status=1 and active=1 and ref_by='$arr[0]'");
echo "<tr><td align=center>$arr[0]</td><td align=center>".mysql_num_rows($rs2)."</td><td align=center>".mysql_num_rows($rs3)."</td><td align=center>$arr[1]</td><tr>";
}
echo "</table>";
}
else {
echo "<h4>ТОП 100 спонсоров</h4><center>Список пуст!</center>";
}
}
elseif (trim($b)==100)
{
$query="select * from allussers order by ID";
membersrecords($query,1, $b,$p);
}
elseif (trim($b)=="Информация")
{
echo("<h4>Информация о пользователе</h4>");
$id=$_POST[id];
$sql = "select * from allussers where id=".$_POST[id] ;
$result = mysql_query($sql);
$rs  =  mysql_fetch_row($result);
echo("<table class=nonebord><form action='admin.php' method=post><input type=hidden name=id value=".$id ."><input type=hidden name=atype value=".$atype.">");
echo("<tr><td><b>Email</b></td><td>".$rs[7]."</td></tr>");
echo("<tr><td><b>Логин</b></td><td>".$rs[8]."</td></tr>");
echo("<tr><td><b>Пароль</b></td><td>".$rs[9]."</td></tr>");
echo("<tr><td><b>Спонсор</b></td><td>".$rs[11]."</td></tr>");
$rs1=mysql_query("select * from allussers where active=1 and ref_by='$rs[8]'");
$dref=mysql_num_rows($rs1);
echo("<tr><td><b>Личных рефералов</b></td><td>".$dref."</td></tr>");
echo("<tr><td><b>Общий доход</b></td><td>$".$rs[15]."</td></tr>");
echo("<tr><td><b>На балансе</b></td><td>$".$rs[16]."</td></tr>");
echo("<tr><td><b>Выплачено</b></td><td>$".$rs[17]."</td></tr>");
echo("<tr><td><b>Начислено баннерных показов</b></td><td>".$rs[20]."</td></tr>");
echo("<tr><td><b>Осталось баннерных показов</b></td><td>".($rs[20]-$rs[21])."</td></tr>");
echo("<tr><td><b>Использовано баннерных показов</b></td><td>".$rs[21]."</td></tr>");
echo("<tr><td><b>IP-адрес</b></td><td>".$rs[12]."</td></tr>");
if($rs[14]==1) {
echo("<tr><td><b>Статус</b></td><td><span>Неактивный</span></td></tr>");
}
else {
echo("<tr><td><b>Статус</b></td><td>Активный</td></tr>");
}
echo("<tr><td><b>Дата регистрации</b></td><td>".$rs[13]."</td></tr>");
echo("<tr><td colspan=2><h6>Матрицы</h6></td></tr><tr><td colspan=2>");
$count=0;
$rsm=mysql_query("select * from ussersmatrices order by ID");
while($arrm=mysql_fetch_array($rsm)) {
$levels=$arrm[4];
$result=mysql_query("select * from ussersmatrix$arrm[0] where Username='$rs[8]' order by ID");
if(mysql_num_rows($result)>0) {
$rc=0;
echo("<b>$arrm[1]</b><br><table border=1 cellspacing=0><tr><td align=center width=20><b>№</b></td><td align=center><b>ID позиции</b></td><td align=center><b>ID вышестоящего</b></td>");
for($i=1;$i<=$levels;$i++)
echo "<td align=center><b>Уровень $i</b></td>";
echo("<td align=center><b>Доход</b></td><td align=center><b>Дата входа</b></td><td align=center><b>Заполнена?</b></td></tr>");
while($rss=mysql_fetch_row($result))
{
$rc++;
$count++;
if($rss[16]==$rss[18]) $cycled="<span>Нет</span>";
else $cycled="Да";
echo("<tr><td align=center>".$rc."</td><td align=center>".$rss[0]."</td><td align=center>".$rss[3]."</td>");
for($i=1;$i<=$levels;$i++)
echo "<td align=center>".$rss[3+$i]."</td>";
echo("<td align=center><span>$</span>".$rss[15]."</td><td align=center>".$rss[16]."</td><td align=center>".$cycled."</td></tr>");
}
echo("</table>");
}
}
if($count==0) {
echo "<center>Нет матриц!</center>";
}
echo "</td></tr>";
echo("<tr><td colspan=2><h6>Выплаты</h6></td></tr><tr><td colspan=2>");
$sql="select * from transaactions where Username='$rs[8]' order by ID";
$esdgjd=mysql_query($sql);
if(mysql_num_rows($esdgjd)>0) {
$rc=0;
echo("<table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center><b>Кошелек</b></td><td width=70 align=center><b>Сумма</b></td><td width=140 align=center><b>Дата</b></td><td width=90 align=center><b>Статус</b></td></tr>");
while($rss=mysql_fetch_row($esdgjd))
{
$rc=$rc+1;
if($rss[4]==1) {
$status="Выплачено!";
}
else {
$status="<span>Ожидается!</span>";
}
echo("<tr><td align=center>".$rc."</td><td align=center>".$rss[2]."</td><td align=center><span>$</span>".$rss[3]."</td><td align=center>".$rss[5]."</td><td align=center>".$status."</td></tr>");
}
echo("</table>");
}
else {
echo "<center>Выплат не было!</center>";
}
echo "</td></tr>";
echo("<tr><td colspan=2><h6>Личные рефералы</h6></td></tr><tr><td colspan=2>");
$result=mysql_query("select * from allussers where ref_by='$rs[8]' order by ID");
if(mysql_num_rows($result)>0) {
$rc=0;
echo "<table border=1 cellspacing=0><tr>
<td align=center width=100><b>Логин</b></td>
<td align=center><b>Email</b></td>
<td align=center width=150><b>Статус</b></td>
<td align=center width=200><b>Дата регистрации</b></td>
</tr>";
while($rss=mysql_fetch_row($result))
{
if($rss[14]==1) $status="<span>Неактивный</span>";
else {
$totalpos=0;
$rsm=mysql_query("select * from ussersmatrices order by ID");
while($arrm=mysql_fetch_array($rsm)) {
$rsm1=mysql_query("select * from ussersmatrix$arrm[0] where Username='$rss[8]'");
$totalpos=$totalpos+mysql_num_rows($rsm1);
}
$status="Активный";
}
echo "<tr>
<td align=center>$rss[8]</td>
<td align=center>$rss[7]</td>
<td align=center>$status</td>
<td align=center>$rss[13]</td>
</tr>";
}
echo("</table>");
}
else {
echo "<center>Нет рефералов!</center>";
}
echo "</td></tr>";
echo("<tr><td colspan=2><hr></td></tr>");
echo("<tr><td colspan=2>");
echo("<input class=button type=submit name='b' value='Редактировать'>&nbsp;");
echo("<input class=button type=submit name='b' value='Удалить аккаунт'></form></td></tr></table>");
}
else if ($b=="Редактировать")
{
echo("<h4>Редактирование пользователя</h4>");
$id=$_POST[id];
if ($_POST[edit]!=1)
{
$sql = "select * from allussers where id=".$_POST[id] ;
$result = mysql_query($sql);
$rs  =  mysql_fetch_row($result);
echo("<table class=nonebord><form action='admin.php' method=post><input type=hidden name=id value=".$id."><input type=hidden name=edit value=1>");
echo("<input type=hidden name=name value='".$rs[1]."'>");
echo("<tr><td><b>Логин</b></td><td>".$rs[8]."</td></tr>");
echo("<tr><td><b>Email</b></td><td><input class=logform type=text name=email value='".$rs[7]."'></td></tr>");
echo("<tr><td><b>Пароль</b></td><td><input class=logform type=text name=password value='".$rs[9]."'></td></tr>");
echo("<tr><td><b>Начислено баннерных показов</b></td><td><input class=logform type=text name=bc value='".$rs[20]."'></td></tr>");
echo("<tr><td><b>Использовано баннерных показов</b></td><td><input class=logform type=text name=ubc value='".$rs[21]."'></td></tr>");
echo("<input type=hidden name=tc value='".$rs[22]."'>");
echo("<input type=hidden name=utc value='".$rs[23]."'>");
echo("<tr><td colspan=2><input class=button type=submit name='b' value='Редактировать'></form></td></tr></table>");
}
else
{
$sql_u="update allussers set Name='".$_POST[name]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
if($showaddress==1) {
$sql_u="update allussers set Address='".$_POST[address]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
} if($showcity==1) {
$sql_u="update allussers set City='".$_POST[city]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
} if($showstate==1) {
$sql_u="update allussers set State='".$_POST[state]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
} if($showzip==1) {
$sql_u="update allussers set Zip='".$_POST[zip]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
} if($showcountry==1) {
$sql_u="update allussers set Country='".$_POST[country]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
}
$sql_u="update allussers set Email='".$_POST[email]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
$sql_u="update allussers set Password='".$_POST[password]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
$sql_u="update allussers set banners='".$_POST[bc]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
$sql_u="update allussers set bannersused='".$_POST[ubc]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
$sql_u="update allussers set textads='".$_POST[tc]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
$sql_u="update allussers set textadsused='".$_POST[utc]."' where ID=".$_POST[id];
$rs=mysql_query($sql_u);
echo("<h2>Изменения сохранены!</h2>");
$sql = "select * from allussers where id=".$_POST[id] ;
$result = mysql_query($sql);
$rs  =  mysql_fetch_row($result);
echo("<table>");
echo("<tr><td><b>Логин</b></td><td>".$rs[8]."</td></tr>");
echo("<tr><td><b>Email</b></td><td>".$rs[7]."</td></tr>");
echo("<tr><td><b>Пароль</b></td><td>".$rs[9]."</td></tr>");
echo("<tr><td><b>Начислено баннерных показов</b></td><td>".$rs[20]."</td></tr>");
echo("<tr><td><b>Осталось баннерных показов</b></td><td>".($rs[20]-$rs[21])."</td></tr>");
echo("<tr><td><b>Использовано баннерных показов</b></td><td>".$rs[21]."</td></tr>");
}
}
elseif(trim($b)=="Удалить аккаунт")
{
$id=$_POST[id];
$rs=mysql_query("select * from allussers where ID=$id");
$arr=mysql_fetch_array($rs);
echo "<br><center><b>Вы уверены, что хотите удалить пользователя <span>$arr[8]</span>?<br></b>
<form action='' method=post>
<input type=hidden name=id value=$id>
<input class=button type=submit name=b value='Подтвердить удаление аккаунта'></form>
</center>";
}
elseif(trim($b)=="Подтвердить удаление аккаунта")
{
$id=$_POST[id];
$rs=mysql_query("select * from allussers where ID=$id");
$arr=mysql_fetch_array($rs);
$sql_d="Delete from transaactions where Username='" .  $arr[8] ."'" ;
$rs_d=mysql_query($sql_d);
$sql_d="Delete from ussersothvar where Username='" .  $arr[8] ."'" ;
$rs_d=mysql_query($sql_d);
$sql_d="Delete from ussersbanners where Username='" .  $arr[8] ."'" ;
$rs_d=mysql_query($sql_d);
$sql_d="Delete from btransactions where Username='" .  $arr[8] ."'" ;
$rs_d=mysql_query($sql_d);
$sql_d="Delete from allussers where ID=" .  $id ;
$rs_d=mysql_query($sql_d);
$rsm=mysql_query("select * from ussersmatrices order by ID");
while($arrm=mysql_fetch_array($rsm)) {
mysql_query("update ussersmatrix$arrm[0] set Username='admin' where Username='$arr[8]'");
}
$sql_d="update allussers set ref_by='' where ref_by='" .  $arr[8] ."'" ;
$rs_d=mysql_query($sql_d);
echo("<h2>Аккаунт удален!</h2>");
}
elseif(trim($b)=="Удалить транзакцию")
{
$sql_d="Delete from btransactions where ID=" .  $_POST[id] ;
$rs_d=mysql_query($sql_d);
echo("<h2>Транзакция удалена!</h2>");
}
elseif (trim($b)=="Подтвердить оплату")
{
$sql_rc = "select * from btransactions where ID=".$_POST[id] ;
$result = mysql_query($sql_rc);
if(mysql_num_rows($result)>0) {
$arr1  =  mysql_fetch_array($result);
$mid=$arr1[3];
$pmode=$arr1[2];
$rs=mysql_query("select * from allussers where Username='$arr1[1]'");
$arr=mysql_fetch_array($rs);
$user=$arr[8];
$ref_by=$arr[11];
$tablee="ussersmatrix$mid";
$rsm=mysql_query("select * from ussersmatrices where ID=$mid");
$arrm=mysql_fetch_array($rsm);
$mname=$arrm[1];
$fee=$arrm[2];
$btlevstype=$arrm[3];
$levels=$arrm[4];
$forcedussersmatrix=$arrm[5];
$refbonus=$arrm[84];
$refbonuspaid=$arrm[83];
$payouttype=$arrm[6];
$btlevsbonus=$arrm[7];
$matchingbonus=$arrm[8];
$level1=$arrm[9];
$level2=$arrm[10];
$level3=$arrm[11];
$level4=$arrm[12];
$level5=$arrm[13];
$level6=$arrm[14];
$level7=$arrm[15];
$level8=$arrm[16];
$level9=$arrm[17];
$level10=$arrm[18];
$level1m=$arrm[19];
$level2m=$arrm[20];
$level3m=$arrm[21];
$level4m=$arrm[22];
$level5m=$arrm[23];
$level6m=$arrm[24];
$level7m=$arrm[25];
$level8m=$arrm[26];
$level9m=$arrm[27];
$level10m=$arrm[28];
$level1c=$arrm[29];
$level2c=$arrm[30];
$level3c=$arrm[31];
$level4c=$arrm[32];
$level5c=$arrm[33];
$level6c=$arrm[34];
$level7c=$arrm[35];
$level8c=$arrm[36];
$level9c=$arrm[37];
$level10c=$arrm[38];
$level1cm=$arrm[39];
$level2cm=$arrm[40];
$level3cm=$arrm[41];
$level4cm=$arrm[42];
$level5cm=$arrm[43];
$level6cm=$arrm[44];
$level7cm=$arrm[45];
$level8cm=$arrm[46];
$level9cm=$arrm[47];
$level10cm=$arrm[48];
$textcreditsentry=$arrm[49];
$bannercreditsentry=$arrm[50];
$textcreditscycle=$arrm[51];
$bannercreditscycle=$arrm[52];
$reentry=$arrm[53];
$reentrynum=$arrm[54];
$entry1=$arrm[55];
$entry1num=$arrm[56];
$btlevsid1=$arrm[57];
$entry2=$arrm[58];
$entry2num=$arrm[59];
$btlevsid2=$arrm[60];
$entry3=$arrm[61];
$entry3num=$arrm[62];
$btlevsid3=$arrm[63];
$entry4=$arrm[64];
$entry4num=$arrm[65];
$btlevsid4=$arrm[66];
$entry5=$arrm[67];
$entry5num=$arrm[68];
$btlevsid5=$arrm[69];
$welcomemail=$arrm[70];
$subject1=stripslashes($arrm[71]);
$message1=stripslashes($arrm[72]);
$eformat1=$arrm[73];
$cyclemail=$arrm[74];
$subject2=stripslashes($arrm[75]);
$message2=stripslashes($arrm[76]);
$eformat2=$arrm[77];
$cyclemailsponsor=$arrm[78];
$subject3=stripslashes($arrm[79]);
$message3=stripslashes($arrm[80]);
$eformat3=$arrm[81];
$upline=0;
$rsp=mysql_query("select ID from $tablee where Username='$ref_by' order by ID limit 0,1");
if(mysql_num_rows($rsp)>0) {
$arrp=mysql_fetch_array($rsp);
$upline=$arrp[0];
}
$urid=0;
$rsm=mysql_query("select * from ussersmatrices order by ID desc");
while($arrm=mysql_fetch_array($rsm)) {
$rsp=mysql_query("select MainID from ussersmatrix$arrm[0] where Username='$user'");
if(mysql_num_rows($rsp)>0) {
$arrp=mysql_fetch_array($rsp);
$urid=$arrp[0];
}
}
mysql_query("insert into $tablee(Username,Sponsor,ref_by,Level1,Level2,Level3,Level4,Level5,Level6,Level7,Level8,Level9,Level10,Leader,Total,Date,MainID,CDate) values('$user','$ref_by',$upline,0,0,0,0,0,0,0,0,0,0,$upline,0,now(),$urid,now())");
$b=mysql_insert_id();
if($b>0) {
if($urid==0) mysql_query("update $tablee set MainID=$b where ID=$b");
$acountid=$b;
$a[11]=$upline;
mysql_query("update allussers set banners=banners+$bannercreditsentry,textads=textads+$textcreditsentry,status=2 where Username='$user'");
if($refbonuspaid>0&&$refbonus>0) {
$rsb=mysql_query("select * from allussers where Username='$ref_by'");
if(mysql_num_rows($rsb)>0) {
$arrb=mysql_fetch_array($rsb);
if(($arrb[14]==2)||($arrb[14]==1&&$freerefbonus==1)) {
mysql_query("update allussers set Total=Total+$refbonus,Unpaid=Unpaid+$refbonus where Username='$ref_by'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$ref_by',$upline,$mid,'$refbonus','Referral Bonus',now())");
}
}
}
if($btlevstype==1) {
if ($upline==0)
{
$rs=mysql_query("select * from $tablee where Level1<$forcedussersmatrix and ID <>'$acountid' order by ID limit 0,1");
if (mysql_num_rows($rs)>0)
{
$arr=mysql_fetch_array($rs);
assignreferrals($acountid,$arr[0],0,1,$mid);
}
}
else {
$rs=mysql_query("select * from $tablee where ID=".$upline);
if(mysql_num_rows($rs)>0) {
$arr=mysql_fetch_array($rs);
if($arr[4]>($forcedussersmatrix-1)) {
assignreferrals($acountid,newupline($acountid,$upline,$mid),0,1,$mid);
}
else {
assignreferrals($acountid,$upline,1,1,$mid);
}
}
else {
$rs=mysql_query("select * from $tablee where Level1<$forcedussersmatrix and ID <>'$acountid' order by ID limit 0,1");
if (mysql_num_rows($rs)>0)
{
$arr=mysql_fetch_array($rs);
assignreferrals($acountid,$arr[0],0,1,$mid);
}
}
}
}
else {
$rs=mysql_query("select * from $tablee where Level1<$forcedussersmatrix and ID <>'$acountid' order by ID limit 0,1");
if (mysql_num_rows($rs)>0)
{
$arr=mysql_fetch_array($rs);
assignreferrals($acountid,$arr[0],0,1,$mid);
}
}
}
else {
echo "<h2>Ошибка!</h2>";
}
$sqld = "delete from btransactions where ID=".$_POST[id] ;
$resultd = mysql_query($sqld);
echo("<h2>Оплата подтверждена!</h2>");
}
else
{
echo("<h2>Эта транзакция уже подтверждена!</h2>");
}
}
elseif ($b=="110") {
print "<h4>Матрицы 2x2</h4>
<h6>Добавление матрицы</h6>
<form action=admin.php method=post>
<table class=nonebord>
<tr><td><b>Название матрицы</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Например, <span>Start</span> или <span>Старт</span>.</div></div><input class=logform type=text name=name></td></tr>
<tr><td><b>Стоимость входа</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Укажите стоимость входа в эту матрицу. Например, <span>30</span>.</div></div>$<input class=logform type=text name=fee></td></tr>
<tr><td><b>Комиссия проекта</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Вы можете назначить комиссию проекта за вход в эту матрицу. Эта комиссия идет к вам в карман. Например, <span>5</span>. Если нисколько, то <span>0</span>.</div></div>$<input class=logform type=text name=textcreditsentry></td></tr>
<tr><td><b>Тип матрицы</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip><span>Индивидуальная</span> - заполняется партнерами, которых участник лично пригласил в проект (личными рефералами) + кого пригласили его приглашенные + переливом от вышестоящих спонсоров.<br><br><span>Коллективная</span> (без приглашений) - общая структура заполняется равномерно сверху вниз и слева направо. Получается, что матрицы участников заполняются по очереди, которая строится по порядку входа в эту матрицу. Личные рефералы не идут за спонсором в матрицу, поэтому стимул приглашать рефералов - это спонсорский и матчинг бонус.</div></div><select class=logform name=ussersmatrixtype><option value=1>Индивидуальная</option><option value=2>Коллективная</option></select></td></tr>
<input type=hidden name=levels value=2>
<input type=hidden name=forcedussersmatrix value=2>
<tr>
<td><b>Спонсорский бонус</b></td>
<td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Сколько получит участник, когда его личный реферал войдет в эту матрицу. Например, <span>5</span>. Если нисколько, то <span>0</span>.</div></div>$<input class=logform type=text name=refbonus></td>
</tr>
<input type=hidden name=refbonuspaid value=2>
<input type=hidden name=payouttype value=1>
<tr><td><b>Начисляется за заполнение матрицы</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Сколько получит участнику на свой внутренний счет, когда эта матрица у него заполнится. Например, <span>120</span>. Если нисколько, то <span>0</span>.</div></div>$<input class=logform type=text name=ussersmatrixbonus></td></tr>
<tr><td><b>Матчинг бонус</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Сколько получит участник, когда его личный реферал заполнит эту матрицу. Например, <span>20</span>. Если нисколько, то <span>0</span>.</div></div>$<input class=logform type=text name=matchingbonus></td></tr>
<input type=hidden name=level1 value=0>
<input type=hidden name=level1m value=0>
<input type=hidden name=level2 value=0>
<input type=hidden name=level2m value=0>
<input type=hidden name=level3 value=0>
<input type=hidden name=level3m value=0>
<input type=hidden name=level4 value=0>
<input type=hidden name=level4m value=0>
<input type=hidden name=level5 value=0>
<input type=hidden name=level5m value=0>
<input type=hidden name=level6 value=0>
<input type=hidden name=level6m value=0>
<input type=hidden name=level7 value=0>
<input type=hidden name=level7m value=0>
<input type=hidden name=level8 value=0>
<input type=hidden name=level8m value=0>
<input type=hidden name=level9 value=0>
<input type=hidden name=level9m value=0>
<input type=hidden name=level10 value=0>
<input type=hidden name=level10m value=0>
<input type=hidden name=level1c value=0>
<input type=hidden name=level1cm value=0>
<input type=hidden name=level2c value=0>
<input type=hidden name=level2cm value=0>
<input type=hidden name=level3c value=0>
<input type=hidden name=level3cm value=0>
<input type=hidden name=level4c value=0>
<input type=hidden name=level4cm value=0>
<input type=hidden name=level5c value=0>
<input type=hidden name=level5cm value=0>
<input type=hidden name=level6c value=0>
<input type=hidden name=level6cm value=0>
<input type=hidden name=level7c value=0>
<input type=hidden name=level7cm value=0>
<input type=hidden name=level8c value=0>
<input type=hidden name=level8cm value=0>
<input type=hidden name=level9c value=0>
<input type=hidden name=level9cm value=0>
<input type=hidden name=level10c value=0>
<input type=hidden name=level10cm value=0>
<tr><td><b>Баннерные показы за вход</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Сколько баннерных показов получит участник за вход в эту матрицу. Например, <span>500</span>. Если нисколько, то <span>0</span>.</div></div><input class=logform type=text name=bannercreditsentry></td></tr>
<input type=hidden name=textcreditscycle value=0>
<tr><td><b>Баннерные показы за заполнение</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Сколько баннерных показов получит участник, когда эта матрица у него заполнится. Например, <span>500</span>. Если нисколько, то <span>0</span>.</div></div><input class=logform type=text name=bannercreditscycle></td></tr>
<tr><td><b>Авто-реинвест в эту матрицу после заполнения</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Если <span>да</span>, то после заполнения этой матрицы, участник повторно войдет в эту же матрицу.</div></div><select class=logform name=reentry><option value=1>Да</option><option value=0>Нет</option></select></td></tr>
<tr><td><b>Если есть авто-реинвест, то cколько позиций активируется?</b></td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Сколько новых позиций автоматически активируется участнику на реинвесте. Например, <span>1</span>. Стоимость каждой новой позиции равняется стоимости входа в эту матрицу. Если нет, то <span>0</span>.</div></div><input class=logform type=text name=reentrynum></td></tr>
<tr><td colspan=2><h3>В какую(ие) матрицу(ы) перейдет пользователь после заполнения этой матрицы.</h3></td></tr>
<tr><td colspan=2>Если вы еще не создали матрицу, в которую должен перейти пользователь, то сможете добавить переход позже через функцию редактирования.</td></tr>";
$rs=mysql_query("select * from ussersmatrices order by ID");
$mlevels=mysql_num_rows($rs);
if($mlevels==0) print "<tr><td colspan=2><b>Вам нужно добавить больше матриц, чтобы установить переходы.</b></td></tr>";
if($mlevels>0) {
print "<tr><td width=465>&nbsp;</td><td><div class=tooltip_wrap><div class=ques>?</div><div class=tooltip>Стоимость каждой новой позиции равняется стоимости входа в матрицу, в которую переходит участник.</div></div></td></tr><tr><td colspan=2>
<table border=1 cellspacing=0>
<tr>
<td width=20 align=center><b>№</b></td>
<td width=250 align=center><b>Включить переход?</b></td>
<td align=center><b>Выберите матрицу</b></td>
<td width=250 align=center><b>Сколько позиций активируется?</b></td>
</tr>";
print "<tr>
<td align=center>1</td>
<td align=center><select class=logform name=entry1><option value=0>Нет</option><option value=1>Да</option></select></td>
<td align=center><select class=logform name=ussersmatrixid1>";
while($arr=mysql_fetch_array($rs)) {
print "<option value=$arr[0]>$arr[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry1num value=0></td>
</tr>";
if($mlevels>1) {
$rs=mysql_query("select * from ussersmatrices order by ID");
print "<tr>
<td align=center>2</td>
<td align=center><select class=logform name=entry2><option value=0>Нет</option><option value=1>Да</option></select></td>
<td align=center><select class=logform name=ussersmatrixid2>";
while($arr=mysql_fetch_array($rs)) {
print "<option value=$arr[0]>$arr[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry2num value=0></td>
</tr>";
if($mlevels>2) {
$rs=mysql_query("select * from ussersmatrices order by ID");
print "<tr>
<td align=center>3</td>
<td align=center><select class=logform name=entry3><option value=0>Нет</option><option value=1>Да</option></select></td>
<td align=center><select class=logform name=ussersmatrixid3>";
while($arr=mysql_fetch_array($rs)) {
print "<option value=$arr[0]>$arr[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry3num value=0></td>
</tr>";
if($mlevels>3) {
$rs=mysql_query("select * from ussersmatrices order by ID");
print "<tr>
<td align=center>4</td>
<td align=center><select class=logform name=entry4><option value=0>Нет</option><option value=1>Да</option></select></td>
<td align=center><select class=logform name=ussersmatrixid4>";
while($arr=mysql_fetch_array($rs)) {
print "<option value=$arr[0]>$arr[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry4num value=0></td>
</tr>";
if($mlevels>4) {
$rs=mysql_query("select * from ussersmatrices order by ID");
print "<tr>
<td align=center>5</td>
<td align=center><select class=logform name=entry5><option value=0>Нет</option><option value=1>Да</option></select></td>
<td align=center><select class=logform name=ussersmatrixid5>";
while($arr=mysql_fetch_array($rs)) {
print "<option value=$arr[0]>$arr[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry5num value=0></td>
</tr>";
}
else {
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
}
else {
print "<input type=hidden name=entry4 value=0><input type=hidden name=ussersmatrixid4 value=0><input type=hidden name=entry4num value=0>";
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
}
else {
print "<input type=hidden name=entry3 value=0><input type=hidden name=ussersmatrixid3 value=0><input type=hidden name=entry3num value=0>";
print "<input type=hidden name=entry4 value=0><input type=hidden name=ussersmatrixid4 value=0><input type=hidden name=entry4num value=0>";
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
}
else {
print "<input type=hidden name=entry2 value=0><input type=hidden name=ussersmatrixid2 value=0><input type=hidden name=entry2num value=0>";
print "<input type=hidden name=entry3 value=0><input type=hidden name=ussersmatrixid3 value=0><input type=hidden name=entry3num value=0>";
print "<input type=hidden name=entry4 value=0><input type=hidden name=ussersmatrixid4 value=0><input type=hidden name=entry4num value=0>";
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
print "</table>
</td></tr>";
}
else {
print "<input type=hidden name=entry1 value=0><input type=hidden name=ussersmatrixid1 value=0><input type=hidden name=entry1num value=0>";
print "<input type=hidden name=entry2 value=0><input type=hidden name=ussersmatrixid2 value=0><input type=hidden name=entry2num value=0>";
print "<input type=hidden name=entry3 value=0><input type=hidden name=ussersmatrixid3 value=0><input type=hidden name=entry3num value=0>";
print "<input type=hidden name=entry4 value=0><input type=hidden name=ussersmatrixid4 value=0><input type=hidden name=entry4num value=0>";
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
echo("<input type=hidden name=bonusdownloads value=''>");
echo("<input type=hidden name=welcomemail value=0>
<input type=hidden name=subject1 value=''>
<input type=hidden name=eformat1 value=1>
<input type=hidden name=message1 value=''>
<input type=hidden name=cyclemail value=0>
<input type=hidden name=subject2 value=''>
<input type=hidden name=eformat2 value=1>
<input type=hidden name=message2 value=''>
<input type=hidden name=cyclemailsponsor value=0>
<input type=hidden name=subject3 value=''>
<input type=hidden name=eformat3 value=1>
<input type=hidden name=message3 value=''>");
print "<tr><td colspan=2><input class=button type=submit name=\"b\" value=\"Сохранить матрицу\"></td></tr></table></form>";
$rs=mysql_query("select * from ussersmatrices order by ID");
print "<h6>Созданные матрицы</h6>";
print "<table border=1 cellspacing=0><tr>
<td align=center><b>Название</b></td>
<td align=center><b>Детали</b></td>
<td align=center><b>Начисления</b></td>
<td align=center><b>Баннерные показы</b></td>
<td align=center><b>Действия</b></td></tr>";
while($arr=mysql_fetch_array($rs))  {
if($arr[3]==1) $md="<hr>Тип матрицы: $arr[5]x$arr[4] <span>индивидуальная</span><hr>";
else $md="<hr>Тип матрицы: $arr[5]x$arr[4] <span>коллективная</span><hr>";
$md.="Вход: <span>$</span>$arr[2]<hr>";
$md.="Комиссия проекта: <span>$</span>$arr[49]<hr>";
if($arr[84]>0) {
$pt="Спонсорский бонус: <span>$</span>$arr[84]<hr>";
} else $pt="";
if($arr[8]>0) {
$mtb="Матчинг бонус <span>$</span>$arr[8]<hr>";
} else $mtb="";
if($arr[6]==1) $pt.="За заполнение: <span>$</span>$arr[7]<hr>";
elseif($arr[6]==2) $pt.="<table>
<tr>
<td>Уровень</td>
<td>Бонус</td>
</tr>
<tr>
<td>1</td>
<td>$$arr[9]</td>
</tr>
<tr>
<td>2</td>
<td>$$arr[10]</td>
</tr>
<tr>
<td>3</td>
<td>$$arr[11]</td>
</tr>
<tr>
<td>4</td>
<td>$$arr[12]</td>
</tr>
<tr>
<td>5</td>
<td>$$arr[13]</td>
</tr>
<tr>
<td>6</td>
<td>$$arr[14]</td>
</tr>
<tr>
<td>7</td>
<td>$$arr[15]</td>
</tr>
<tr>
<td>8</td>
<td>$$arr[16]</td>
</tr>
<tr>
<td>9</td>
<td>$$arr[17]</td>
</tr>
<tr>
<td>10</td>
<td>$$arr[18]</td>
</tr>
</table>";
elseif($arr[6]==3) $pt.="<table>
<tr>
<td>Уровень</td>
<td>Бонус</td>
</tr>
<tr>
<td>1</td>
<td>$$arr[29]</td>
</tr>
<tr>
<td>2</td>
<td>$$arr[30]</td>
</tr>
<tr>
<td>3</td>
<td>$$arr[31]</td>
</tr>
<tr>
<td>4</td>
<td>$$arr[32]</td>
</tr>
<tr>
<td>5</td>
<td>$$arr[33]</td>
</tr>
<tr>
<td>6</td>
<td>$$arr[34]</td>
</tr>
<tr>
<td>7</td>
<td>$$arr[35]</td>
</tr>
<tr>
<td>8</td>
<td>$$arr[36]</td>
</tr>
<tr>
<td>9</td>
<td>$$arr[37]</td>
</tr>
<tr>
<td>10</td>
<td>$$arr[38]</td>
</tr>
</table>";
$bc="За вход: <span>$arr[50]</span><hr>
За заполнение: <span>$arr[52]</span>";
if($arr[53]==1) {
if($arr[54]==1) $md.="Реинвестов: <span>$arr[54]</span> (<span>$</span>$arr[2])<hr>";
else $md.="Реинвестов: <span>$arr[54]</span> (<span>$</span>".($arr[2]*$arr[54]).")<hr>";
}
else $md.="Реинвестов: <span>0</span><hr>";
if($arr[55]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[57]");
$arrm=mysql_fetch_array($rsm);
if($arr[56]==1) $md.="<span>$arr[56]</span> переход в <span>$arrm[1]</span> (<span>$</span>$arrm[2])<hr>";
else $md.="<span>$arr[56]</span> перехода(ов) в <span>$arrm[1]</span> (<span>$</span>".($arrm[2]*$arr[56]).")<hr>";
}
if($arr[58]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[60]");
$arrm=mysql_fetch_array($rsm);
if($arr[59]==1) $md.="<span>$arr[59]</span> переход в <span>$arrm[1]</span> (<span>$</span>$arrm[2])<hr>";
else $md.="<span>$arr[59]</span> перехода(ов) в <span>$arrm[1]</span> (<span>$</span>".($arrm[2]*$arr[59]).")<hr>";
}
if($arr[61]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[63]");
$arrm=mysql_fetch_array($rsm);
if($arr[62]==1) $md.="<span>$arr[62]</span> переход в <span>$arrm[1]</span> (<span>$</span>$arrm[2])<hr>";
else $md.="<span>$arr[62]</span> перехода(ов) в <span>$arrm[1]</span> (<span>$</span>".($arrm[2]*$arr[62]).")<hr>";
}
if($arr[64]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[66]");
$arrm=mysql_fetch_array($rsm);
if($arr[65]==1) $md.="<span>$arr[65]</span> переход в <span>$arrm[1]</span> (<span>$</span>$arrm[2])<hr>";
else $md.="<span>$arr[65]</span> перехода(ов) в <span>$arrm[1]</span> (<span>$</span>".($arrm[2]*$arr[65]).")<hr>";
}
if($arr[67]==1) {
$rsm=mysql_query("select * from ussersmatrices where ID=$arr[69]");
$arrm=mysql_fetch_array($rsm);
if($arr[68]==1) $md.="<span>$arr[68]</span> переход в <span>$arrm[1]</span> (<span>$</span>$arrm[2])<hr>";
else $md.="<span>$arr[68]</span> перехода(ов) в <span>$arrm[1]</span> (<span>$</span>".($arrm[2]*$arr[68]).")<hr>";
}
print "<tr>
<td align=center>".$arr[1]."</td>
<td align=center>".$md."</td>
<td align=center>".$pt."".$mtb."</td>
<td align=center>".$bc."</td>";
print "<td align=center><form action=admin.php method=post><input type=hidden name=id value=".$arr[0]."><input class=button type=submit name=\"b\" value=\"Редактировать матрицу\">&nbsp;<input class=button type=submit name=\"b\" value=\"Удалить матрицу\"></form></td></tr>";
}
print "</table>";
}
elseif($b=="Сохранить матрицу") {
$rs=mysql_query("insert into ussersmatrices values(NULL,'$_POST[name]','$_POST[fee]','$_POST[ussersmatrixtype]','$_POST[levels]','$_POST[forcedussersmatrix]','$_POST[payouttype]','$_POST[ussersmatrixbonus]','$_POST[matchingbonus]','$_POST[level1]','$_POST[level2]','$_POST[level3]','$_POST[level4]','$_POST[level5]','$_POST[level6]','$_POST[level7]','$_POST[level8]','$_POST[level9]','$_POST[level10]','$_POST[level1m]','$_POST[level2m]','$_POST[level3m]','$_POST[level4m]','$_POST[level5m]','$_POST[level6m]','$_POST[level7m]','$_POST[level8m]','$_POST[level9m]','$_POST[level10m]','$_POST[level1c]','$_POST[level2c]','$_POST[level3c]','$_POST[level4c]','$_POST[level5c]','$_POST[level6c]','$_POST[level7c]','$_POST[level8c]','$_POST[level9c]','$_POST[level10c]','$_POST[level1cm]','$_POST[level2cm]','$_POST[level3cm]','$_POST[level4cm]','$_POST[level5cm]','$_POST[level6cm]','$_POST[level7cm]','$_POST[level8cm]','$_POST[level9cm]','$_POST[level10cm]','$_POST[textcreditsentry]','$_POST[bannercreditsentry]','$_POST[textcreditscycle]','$_POST[bannercreditscycle]','$_POST[reentry]','$_POST[reentrynum]','$_POST[entry1]','$_POST[entry1num]','$_POST[ussersmatrixid1]','$_POST[entry2]','$_POST[entry2num]','$_POST[ussersmatrixid2]','$_POST[entry3]','$_POST[entry3num]','$_POST[ussersmatrixid3]','$_POST[entry4]','$_POST[entry4num]','$_POST[ussersmatrixid4]','$_POST[entry5]','$_POST[entry5num]','$_POST[ussersmatrixid5]','$_POST[welcomemail]','','','$_POST[eformat1]','$_POST[cyclemail]','','','$_POST[eformat2]','$_POST[cyclemailsponsor]','','','$_POST[eformat3]','',$_POST[refbonuspaid],'$_POST[refbonus]',now())");
$b=mysql_insert_id();
$bonusdownloads=addslashes($_POST[bonusdownloads]);
mysql_query("update ussersmatrices set bonusdownloads='$bonusdownloads' where ID=$b");
$subject1=addslashes($_POST[subject1]);
mysql_query("update ussersmatrices set Subject1='$subject1' where ID=$b");
$message1=addslashes($_POST[message1]);
mysql_query("update ussersmatrices set Message1='$message1' where ID=$b");
$subject2=addslashes($_POST[subject2]);
mysql_query("update ussersmatrices set Subject2='$subject2' where ID=$b");
$message2=addslashes($_POST[message2]);
mysql_query("update ussersmatrices set Message2='$message2' where ID=$b");
$subject3=addslashes($_POST[subject3]);
mysql_query("update ussersmatrices set Subject3='$subject3' where ID=$b");
$message3=addslashes($_POST[message3]);
mysql_query("update ussersmatrices set Message3='$message3' where ID=$b");
print "<b>Матрица сохранена.</b>";
if($b>0) {
$sql="create table ussersmatrix$b
(
ID int unsigned not null auto_increment primary key,
Username varchar(75),
Sponsor varchar(75),
ref_by int unsigned not null,
Level1 int unsigned not null,
Level2 int unsigned not null,
Level3 int unsigned not null,
Level4 int unsigned not null,
Level5 int unsigned not null,
Level6 int unsigned not null,
Level7 int unsigned not null,
Level8 int unsigned not null,
Level9 int unsigned not null,
Level10 int unsigned not null,
Leader int unsigned not null,
Total float(8),
Date datetime,
MainID int unsigned not null,
CDate datetime
)";
if(mysql_query($sql))
{
print "Создана таблица: ussersmatrix$b<br>";
$bcount=0;
mysql_query("ALTER TABLE ussersmatrix$b AUTO_INCREMENT = $bcount");
}
else
{
echo mysql_error();
print  "<BR>" . $sql."<BR><BR>";
}
}
}
elseif($b=="Редактировать матрицу") {
$id=$_POST[id];
$id1=$_POST[id1];
if(!$id1) {
$rs=mysql_query("select * from ussersmatrices where ID=$id");
$arr=mysql_fetch_array($rs);
print "<h4>Редактирование матрицы</h4>
<form action='' method=post>
<table class=nonebord>
<tr><td><b>Название матрицы</b></td><td><input class=logform type=text name=name value=\"$arr[1]\"></td></tr>
<tr><td><b>Стоимость входа</b></td><td>$<input class=logform type=text name=fee value=\"$arr[2]\"></td></tr>
<tr><td><b>Комиссия проекта</b></td><td>$<input class=logform type=text name=textcreditsentry value=\"$arr[49]\"></td></tr>
<tr><td><b>Тип матрицы:</b></td><td><select class=logform name=ussersmatrixtype>";
if($arr[3]==1) print "<option value=1>Индивидуальная</option><option value=2>Коллективная</option>";
else print "<option value=1>Индивидуальная</option><option value=2 selected>Коллективная</option>";
print "</select></td></tr>
<input type=hidden name=levels value=\"$arr[4]\">
<input type=hidden name=forcedussersmatrix value=\"$arr[5]\">
<tr><td><b>Спонсорский бонус</b></td><td>$<input class=logform type=text name=refbonus value=\"$arr[84]\"></td></tr>
<input type=hidden name=refbonuspaid value=\"2\">
<input type=hidden name=payouttype value=\"1\">
<tr><td><b>Начисляется за заполнение матрицы</b></td><td>$<input class=logform type=text name=ussersmatrixbonus value=\"$arr[7]\"></td></tr>
<tr><td><b>Матчинг бонус</b></td><td>$<input class=logform type=text name=matchingbonus value=\"$arr[8]\"></td></tr>
<input type=hidden name=level1 value=\"$arr[9]\">
<input type=hidden name=level1m value=\"$arr[19]\">
<input type=hidden name=level2 value=\"$arr[10]\">
<input type=hidden name=level2m value=\"$arr[20]\">
<input type=hidden name=level3 value=\"$arr[11]\">
<input type=hidden name=level3m value=\"$arr[21]\">
<input type=hidden name=level4 value=\"$arr[12]\">
<input type=hidden name=level4m value=\"$arr[22]\">
<input type=hidden name=level5 value=\"$arr[13]\">
<input type=hidden name=level5m value=\"$arr[23]\">
<input type=hidden name=level6 value=\"$arr[14]\">
<input type=hidden name=level6m value=\"$arr[24]\">
<input type=hidden name=level7 value=\"$arr[15]\">
<input type=hidden name=level7m value=\"$arr[25]\">
<input type=hidden name=level8 value=\"$arr[16]\">
<input type=hidden name=level8m value=\"$arr[26]\">
<input type=hidden name=level9 value=\"$arr[17]\">
<input type=hidden name=level9m value=\"$arr[27]\">
<input type=hidden name=level10 value=\"$arr[18]\">
<input type=hidden name=level10m value=\"$arr[28]\">
<input type=hidden name=level1c value=\"$arr[29]\">
<input type=hidden name=level1cm value=\"$arr[39]\">
<input type=hidden name=level2c value=\"$arr[30]\">
<input type=hidden name=level2cm value=\"$arr[40]\">
<input type=hidden name=level3c value=\"$arr[31]\">
<input type=hidden name=level3cm value=\"$arr[41]\">
<input type=hidden name=level4c value=\"$arr[32]\">
<input type=hidden name=level4cm value=\"$arr[42]\">
<input type=hidden name=level5c value=\"$arr[33]\">
<input type=hidden name=level5cm value=\"$arr[43]\">
<input type=hidden name=level6c value=\"$arr[34]\">
<input type=hidden name=level6cm value=\"$arr[44]\">
<input type=hidden name=level7c value=\"$arr[35]\">
<input type=hidden name=level7cm value=\"$arr[45]\">
<input type=hidden name=level8c value=\"$arr[36]\">
<input type=hidden name=level8cm value=\"$arr[46]\">
<input type=hidden name=level9c value=\"$arr[37]\">
<input type=hidden name=level9cm value=\"$arr[47]\">
<input type=hidden name=level10c value=\"$arr[38]\">
<input type=hidden name=level10cm value=\"$arr[48]\">
<tr><td><b>Баннерные показы за вход</b></td><td><input class=logform type=text name=bannercreditsentry value=\"$arr[50]\"></td></tr>
<input type=hidden name=textcreditscycle value=\"$arr[51]\">
<tr><td><b>Баннерные показы за заполнение</b></td><td><input class=logform type=text name=bannercreditscycle value=\"$arr[52]\"></td></tr>
<tr><td><b>Авто-реинвест в эту матрицу после заполнения</b></td><td><select class=logform name=reentry>";
if($arr[53]==1) echo "<option value=1>Да</option><option value=0>Нет</option>";
else echo "<option value=1>Да</option><option value=0 selected>Нет</option>";
print "</select></td></tr>
<tr><td><b>Если есть авто-реинвест, то cколько позиций активируется?</b></td><td><input class=logform type=text name=reentrynum value=\"$arr[54]\"></td></tr>";
$rsm=mysql_query("select * from ussersmatrices where ID<>$arr[0] order by ID");
$mlevels=mysql_num_rows($rsm);
if($mlevels==0) print "<tr><td colspan=2><b>Вам нужно добавить больше матриц, чтобы установить переходы.</b></td></tr>";
if($mlevels>0) {
print "<tr><td colspan=2>
<table border=1 cellspacing=0>
<tr>
<td width=20 align=center><b>№</b></td>
<td width=250 align=center><b>Включть переход?</b></td>
<td align=center><b>Выберите матрицу</b></td>
<td width=250 align=center><b>Сколько позиций активируется?</b></td>
</tr>";
print "<tr>
<td align=center>1</td>
<td align=center><select class=logform name=entry1>";
if($arr[55]==0)
echo "<option value=0>Нет</option><option value=1>Да</option>";
else
echo "<option value=0>Нет</option><option value=1 selected>Да</option>";
print "</select></td>
<td align=center><select class=logform name=ussersmatrixid1>";
while($arrm=mysql_fetch_array($rsm)) {
if($arr[57]==$arrm[0]) 
print "<option value=$arrm[0] selected>$arrm[1]</option>";
else
print "<option value=$arrm[0]>$arrm[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry1num value=$arr[56]></td>
</tr>";
if($mlevels>1) {
$rsm=mysql_query("select * from ussersmatrices where ID<>$arr[0] order by ID");
print "<tr>
<td align=center>2</td>
<td align=center><select class=logform name=entry2>";
if($arr[58]==0)
echo "<option value=0>Нет</option><option value=1>Да</option>";
else
echo "<option value=0>Нет</option><option value=1 selected>Да</option>";
print "</select></td>
<td align=center><select class=logform name=ussersmatrixid2>";
while($arrm=mysql_fetch_array($rsm)) {
if($arr[60]==$arrm[0]) 
print "<option value=$arrm[0] selected>$arrm[1]</option>";
else
print "<option value=$arrm[0]>$arrm[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry2num value=$arr[59]></td>
</tr>";
if($mlevels>2) {
$rsm=mysql_query("select * from ussersmatrices where ID<>$arr[0] order by ID");
print "<tr>
<td align=center>3</td>
<td align=center><select class=logform name=entry3>";
if($arr[61]==0)
echo "<option value=0>Нет</option><option value=1>Да</option>";
else
echo "<option value=0>Нет</option><option value=1 selected>Да</option>";
print "</select></td>
<td align=center><select class=logform name=ussersmatrixid3>";
while($arrm=mysql_fetch_array($rsm)) {
if($arr[63]==$arrm[0]) 
print "<option value=$arrm[0] selected>$arrm[1]</option>";
else
print "<option value=$arrm[0]>$arrm[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry3num value=$arr[62]></td>
</tr>";
if($mlevels>3) {
$rsm=mysql_query("select * from ussersmatrices where ID<>$arr[0] order by ID");
print "<tr>
<td align=center>4</td>
<td align=center><select class=logform name=entry4>";
if($arr[64]==0)
echo "<option value=0>Нет</option><option value=1>Да</option>";
else
echo "<option value=0>Нет</option><option value=1 selected>Да</option>";
print "</select></td>
<td align=center><select class=logform name=ussersmatrixid4>";
while($arrm=mysql_fetch_array($rsm)) {
if($arr[66]==$arrm[0]) 
print "<option value=$arrm[0] selected>$arrm[1]</option>";
else
print "<option value=$arrm[0]>$arrm[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry4num value=$arr[65]></td>
</tr>";
if($mlevels>4) {
$rsm=mysql_query("select * from ussersmatrices where ID<>$arr[0] order by ID");
print "<tr>
<td align=center>5</td>
<td align=center><select class=logform name=entry5>";
if($arr[67]==0)
echo "<option value=0>Нет</option><option value=1>Да</option>";
else
echo "<option value=0>Нет</option><option value=1 selected>Да</option>";
print "</select></td>
<td align=center><select class=logform name=ussersmatrixid5>";
while($arrm=mysql_fetch_array($rsm)) {
if($arr[69]==$arrm[0]) 
print "<option value=$arrm[0] selected>$arrm[1]</option>";
else
print "<option value=$arrm[0]>$arrm[1]</option>";
}
print "</select></td>
<td align=center><input class=logform type=text name=entry5num value=$arr[68]></td>
</tr>";
}
else {
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
}
else {
print "<input type=hidden name=entry4 value=0><input type=hidden name=ussersmatrixid4 value=0><input type=hidden name=entry4num value=0>";
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
}
else {
print "<input type=hidden name=entry3 value=0><input type=hidden name=ussersmatrixid3 value=0><input type=hidden name=entry3num value=0>";
print "<input type=hidden name=entry4 value=0><input type=hidden name=ussersmatrixid4 value=0><input type=hidden name=entry4num value=0>";
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
}
else {
print "<input type=hidden name=entry2 value=0><input type=hidden name=ussersmatrixid2 value=0><input type=hidden name=entry2num value=0>";
print "<input type=hidden name=entry3 value=0><input type=hidden name=ussersmatrixid3 value=0><input type=hidden name=entry3num value=0>";
print "<input type=hidden name=entry4 value=0><input type=hidden name=ussersmatrixid4 value=0><input type=hidden name=entry4num value=0>";
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
print "</table>
</td></tr>";
}
else {
print "<input type=hidden name=entry1 value=0><input type=hidden name=ussersmatrixid1 value=0><input type=hidden name=entry1num value=0>";
print "<input type=hidden name=entry2 value=0><input type=hidden name=ussersmatrixid2 value=0><input type=hidden name=entry2num value=0>";
print "<input type=hidden name=entry3 value=0><input type=hidden name=ussersmatrixid3 value=0><input type=hidden name=entry3num value=0>";
print "<input type=hidden name=entry4 value=0><input type=hidden name=ussersmatrixid4 value=0><input type=hidden name=entry4num value=0>";
print "<input type=hidden name=entry5 value=0><input type=hidden name=ussersmatrixid5 value=0><input type=hidden name=entry5num value=0>";
}
echo("<input type=hidden name=bonusdownloads>".stripslashes($arr[82])."</input>");
echo("<input type=hidden name=welcomemail value=0>
<input type=hidden name=subject1 value=\"".stripslashes($arr[71])."\">
<input type=hidden name=eformat1 value=1>
<input type=hidden name=message1>".stripslashes($arr[72])."</input>");
echo("<input type=hidden name=cyclemail value=0>
<input type=hidden name=subject2 value=\"".stripslashes($arr[75])."\">
<input type=hidden name=eformat2 value=1>
<input type=hidden name=message2>".stripslashes($arr[76])."</input>
<input type=hidden name=cyclemailsponsor value=0>
<input type=hidden name=subject3 value=\"".stripslashes($arr[79])."\">
<input type=hidden name=eformat3 value=1>
<input type=hidden name=message3>".stripslashes($arr[80])."</input>");
print "<tr><td colspan=2><input type=hidden name=id value=$arr[0]><input type=hidden name=id1 value=1><input class=button type=submit name=\"b\" value=\"Редактировать матрицу\"></td></tr></table></form>";
}
else {
$b=$id;
$sql="update ussersmatrices set Name='$_POST[name]',fee='$_POST[fee]',ussersmatrixtype='$_POST[ussersmatrixtype]',levels='$_POST[levels]',forcedussersmatrix='$_POST[forcedussersmatrix]',payouttype='$_POST[payouttype]',ussersmatrixbonus='$_POST[ussersmatrixbonus]',matchingbonus='$_POST[matchingbonus]',Level1='$_POST[level1]',Level2='$_POST[level2]',Level3='$_POST[level3]',Level4='$_POST[level4]',Level5='$_POST[level5]',Level6='$_POST[level6]',Level7='$_POST[level7]',Level8='$_POST[level8]',Level9='$_POST[level9]',Level10='$_POST[level10]',Level1m='$_POST[level1m]',Level2m='$_POST[level2m]',Level3m='$_POST[level3m]',Level4m='$_POST[level4m]',Level5m='$_POST[level5m]',Level6m='$_POST[level6m]',Level7m='$_POST[level7m]',Level8m='$_POST[level8m]',Level9m='$_POST[level9m]',Level10m='$_POST[level10m]',Level1c='$_POST[level1c]',Level2c='$_POST[level2c]',Level3c='$_POST[level3c]',Level4c='$_POST[level4c]',Level5c='$_POST[level5c]',Level6c='$_POST[level6c]',Level7c='$_POST[level7c]',Level8c='$_POST[level8c]',Level9c='$_POST[level9c]',Level10c='$_POST[level10c]',Level1cm='$_POST[level1cm]',Level2cm='$_POST[level2cm]',Level3cm='$_POST[level3cm]',Level4cm='$_POST[level4cm]',Level5cm='$_POST[level5cm]',Level6cm='$_POST[level6cm]',Level7cm='$_POST[level7cm]',Level8cm='$_POST[level8cm]',Level9cm='$_POST[level9cm]',Level10cm='$_POST[level10cm]',textcreditsentry='$_POST[textcreditsentry]',bannercreditsentry='$_POST[bannercreditsentry]',textcreditscycle='$_POST[textcreditscycle]',bannercreditscycle='$_POST[bannercreditscycle]',reentry='$_POST[reentry]',reentrynum='$_POST[reentrynum]',entry1='$_POST[entry1]',entry1num='$_POST[entry1num]',ussersmatrixid1='$_POST[ussersmatrixid1]',entry2='$_POST[entry2]',entry2num='$_POST[entry2num]',ussersmatrixid2='$_POST[ussersmatrixid2]',entry3='$_POST[entry3]',entry3num='$_POST[entry3num]',ussersmatrixid3='$_POST[ussersmatrixid3]',entry4='$_POST[entry4]',entry4num='$_POST[entry4num]',ussersmatrixid4='$_POST[ussersmatrixid4]',entry5='$_POST[entry5]',entry5num='$_POST[entry5num]',ussersmatrixid5='$_POST[ussersmatrixid5]',welcomemail='$_POST[welcomemail]',eformat1='$_POST[eformat1]',cyclemail='$_POST[cyclemail]',eformat2='$_POST[eformat2]',cyclemailsponsor='$_POST[cyclemailsponsor]',eformat3='$_POST[eformat3]',refbonus='$_POST[refbonus]',refbonuspaid='$_POST[refbonuspaid]' where ID=$id";
mysql_query($sql);
$bonusdownloads=addslashes($_POST[bonusdownloads]);
mysql_query("update ussersmatrices set bonusdownloads='$bonusdownloads' where ID=$b");
$subject1=addslashes($_POST[subject1]);
mysql_query("update ussersmatrices set Subject1='$subject1' where ID=$b");
$message1=addslashes($_POST[message1]);
mysql_query("update ussersmatrices set Message1='$message1' where ID=$b");
$subject2=addslashes($_POST[subject2]);
mysql_query("update ussersmatrices set Subject2='$subject2' where ID=$b");
$message2=addslashes($_POST[message2]);
mysql_query("update ussersmatrices set Message2='$message2' where ID=$b");
$subject3=addslashes($_POST[subject3]);
mysql_query("update ussersmatrices set Subject3='$subject3' where ID=$b");
$message3=addslashes($_POST[message3]);
mysql_query("update ussersmatrices set Message3='$message3' where ID=$b");
print "<h2>Изменения сохранены!</h2>";
}
}
elseif($b=="Удалить матрицу") {
$rsm=mysql_query("select * from ussersmatrices where ID=$id");
$arrm=mysql_fetch_array($rsm);
echo "<form action='' method=post><input type=hidden name=id value=$_POST[id]><br><b>Вы уверены, что хотите удалить матрицу: $arrm[1]?<br>
<input type=submit name=b value='Подтвердить удаление матрицы'></form>";
}
elseif($b=="Подтвердить удаление матрицы") {
$id=$_POST[id];
$rs=mysql_query("delete from ussersmatrices where ID=".$id);
$rs=mysql_query("delete from btransactions where ussersmatrixid=".$id);
mysql_query("drop table ussersmatrix$id");
print "<h2>Матрица удалена</h2>";
}
elseif(trim($b)==5)
{
$mid=(int)$_GET[mid];
$tablee="ussersmatrix$mid";
$rsm=mysql_query("select * from ussersmatrices where ID=$mid");
$arrm=mysql_fetch_array($rsm);
$mname=$arrm[1];
$fee=$arrm[2];
$btlevstype=$arrm[3];
$levels=$arrm[4];
$forcedussersmatrix=$arrm[5];
echo "<h4>Структура матрицы $mname</h4>";
$step=50;
$currentpage = $p;
$sql="select * from $tablee order by ID";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?mid=$mid&b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from $tablee order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
echo("<br><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center><b>Логин</b></td><td align=center><b>Спонсор</b></td><td align=center><b>ID вышестоящего</b></td>");
for($i=1;$i<=$levels;$i++)
echo "<td align=center><b>Уровень $i</b></td>";
echo("<td align=center><b>Доход</b></td><td align=center><b>Дата входа</b></td><td align=center><b>Заполнена?</b></td><td align=center><b>Действия</b></td></tr>");
while($rss=mysql_fetch_row($result))
{
if($rss[16]==$rss[18]) $cycled="<span>Нет</span>";
else $cycled="Да";
echo("<tr><td align=center>".$rss[0]."</td><td align=center>".$rss[1]."</td><td align=center>".$rss[2]."</td><td align=center>".$rss[3]."</td>");
for($i=1;$i<=$levels;$i++)
echo "<td align=center>".$rss[3+$i]."</td>";
echo("<td align=center><span>$</span>".$rss[15]."</td><td align=center>".$rss[16]."</td><td align=center>".$cycled."</td><td align=center><form action=admin.php method=post><input type=hidden name=id value=$rss[0]><input type=hidden name=mid value=$mid><input class=button type=submit name='b' value='Удалить позицию'></form></td></tr>");
}
echo("</table>");
}
elseif($b=="Удалить позицию") {
echo "<center><br><b>Вы уверены, что хотите удалить позицию с ID <span>$id</span>?<br>Удаление приведет к смене владельца этой позиции на <span>admin</span>, чтобы избежать создания пустых позиций.</b><br><form action='' method=post><input type=hidden name=id value=$_POST[id]><input type=hidden name=mid value=$_POST[mid]>
<input class=button type=submit name=b value='Подтвердить удаление позиции'></form></center>";
}
elseif($b=="Подтвердить удаление позиции") {
$id=$_POST[id];
$mid=$_POST[mid];
mysql_query("update ussersmatrix$mid set Username='admin' where ID=$id");
echo "<h2>Позиция удалена!</h2>";
}
elseif(trim($b)==120)
{
echo "<h4>Подтверждение оплат</h4>";
$step=50;
$currentpage = $p;
$sql="select * from btransactions order by ID";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from btransactions order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
echo("<br><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center><b>Логин</b></td><td align=center><b>Матрица</b></td><td align=center><b>Дата</b></td><td align=center><b>Действия</b></td></tr>");
while($rs=mysql_fetch_row($result))
{
$rsm=mysql_query("select * from ussersmatrices where ID=$rs[3]");
$arrm=mysql_fetch_array($rsm);
echo("<tr><td align=center>".$rs[0]."</td><td align=center>".$rs[1]."</td><td align=center>$arrm[1] (<span>$</span>$arrm[2])</td><td align=center>".$rs[4]."</td><td align=center><form action=admin.php method=post><input type=hidden name=id value=$rs[0]><input class=button type=submit name='b' value='Подтвердить оплату'>&nbsp;<input class=button type=submit name='b' value='Удалить транзакцию'></form></tr>");
}
echo("</table>");
}
elseif (trim($b)==130)
{
$act=$_GET[act];
if (trim($act)!="send")
{
echo("<h4>Рассылка писем</h4>");
echo("<form action='admin.php?b=130&act=send' method=post>Вы можете использовать в письмах следующие теги:<br><span>{username}</span> логин пользователя<br><span>{password}</span> пароль пользователя<br><span>{email}</span> Email пользователя<br><span>{ip}</span> IP-адрес пользователя<br><span>{date}</span> дата регистрации пользователя<br><span>{sponsor}</span> логин спонсора пользователя<br>");
echo("<table class=nonebord>");
echo("<tr><td>Тема письма</td><td align=left><input class=logform type=text name=subject></td></tr>");
echo("<tr><td>Кому отправить</td><td align=left><select class=logform name='cat'><option Value='1'>Всем<option value=2>Неактивным<option value=3>Активным</select></td></tr>");
echo("<tr><td>Формат</td><td align=left><select class=logform name='format'><option Value='0'>Текст<option value=1 selected>HTML</select></td></tr>");
echo("<tr><td>Содержание</td><td align=left><textarea name=message></textarea></td></tr>");
echo("<tr><td colspan=2><hr><input class=button type=submit value='Отправить письмо'></td></tr>");
echo("</table></form>");
}
elseif(trim($act) == "send")
{
$subject=$_POST[subject];
$format=$_POST[format];
$message=$_POST[message];
$cat=$_POST[cat];
$moledq="";
$usercount=0;
if($cat==1) {
$sql_rc = "select count(*) from allussers where active=1 and subscribed=1";
$sql = "select Email,ref_by,Name,Username,Password,ID,IP,Date from allussers where active=1 and subscribed=1 order by ID" ;
}
elseif($cat==2) {
$sql_rc = "select count(*) from allussers where active=1 and status=1";
$sql = "select Email,ref_by,Name,Username,Password,ID,IP,Date from allussers where active=1 and subscribed=1 and status=1 order by ID" ;
}
elseif($cat==3) {
$sql_rc = "select count(*) from allussers where active=1 and status=2";
$sql = "select Email,ref_by,Name,Username,Password,ID,IP,Date from allussers where active=1 and subscribed=1 and status=2 order by ID" ;
}
$result_rc = mysql_query($sql_rc);
$rscount_rc  =  mysql_fetch_row($result_rc);
$totalm=$rscount_rc[0];
$result = mysql_query($sql);
while ($rs=mysql_fetch_row($result))
{
$d=explode(" ",$rs[2]);
$subject1=stripslashes($_POST[subject]);
$subject1=str_replace("{name}",$rs[2],$subject1);
$subject1=str_replace("{fname}",$d[0],$subject1);
$subject1=str_replace("{username}",$rs[3],$subject1);
$subject1=str_replace("{password}",$rs[4],$subject1);
$subject1=str_replace("{sponsor}",$rs[1],$subject1);
$subject1=str_replace("{email}",$rs[0],$subject1);
$subject1=str_replace("{ip}",$rs[6],$subject1);
$subject1=str_replace("{date}",$rs[7],$subject1);
$message1=stripslashes($_POST[message]);
$message1=str_replace("{name}",$rs[2],$message1);
$message1=str_replace("{fname}",$d[0],$message1);
$message1=str_replace("{username}",$rs[3],$message1);
$message1=str_replace("{password}",$rs[4],$message1);
$message1=str_replace("{sponsor}",$rs[1],$message1);
$message1=str_replace("{email}",$rs[0],$message1);
$message1=str_replace("{ip}",$rs[6],$message1);
$message1=str_replace("{date}",$rs[7],$message1);
if($format==1)
$message1.="";
else
$message1.="";
sendmail($webmasteremail,$rs[0],$subject1,$format,$message1);
$usercount=$usercount+1;
echo($usercount .". Письмо успешно отправлено на <span>".$rs[0]."</span><br>");
}
}
}
elseif(trim($b)==140)
{
echo "<h4>Завершенные выплаты</h4>";
$step=50;
$currentpage = $p;
$sql="select * from transaactions where approved=1 order by ID";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from transaactions where approved=1 order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
echo("<br><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center><b>Логин</b></td><td align=center><b>Кошелек</b></td><td width=90 align=center><b>Сумма</b></td><td width=180 align=center><b>Дата</b></td></tr>");
while($rs=mysql_fetch_row($result))
{
echo("<tr><td align=center>".$rs[0]."</td><td align=center>".$rs[1]."</td><td align=center>".$rs[2]."</td><td align=center><span>$</span>".$rs[3]."</td><td align=center>".$rs[5]."</td></tr>");
}
echo("</table>");
}
elseif(trim($b)==150)
{
echo "<h4>Заказы выплат</h4>";
$step=50;
$currentpage = $p;
$sql="select * from transaactions where approved=0 order by ID";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from transaactions where approved=0 order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
echo("<br><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center><b>Логин</b></td><td align=center><b>Кошелек</b></td><td width=90 align=center><b>Сумма</b></td><td width=180 align=center><b>Дата</b></td><td width=120 align=center><b>Действия</b></td></tr>");
while($rs=mysql_fetch_row($result))
{
echo("<tr><td align=center>".$rs[0]."</td><td align=center>".$rs[1]."</td><td align=center>".$rs[2]."</td><td align=center>$".$rs[3]."</td><td align=center>".$rs[5]."</td><td align=center><form action=admin.php method=post><input type=hidden name=id value=$rs[0]><input class=button type=submit name='b' value='Выплатить'></form></tr>");
}
echo("</table>");
}
elseif(trim($b)=="Выплатить")
{
include "confff.php";
$sql="select * from transaactions where ID = ".$_POST[id] ;
$result=mysql_query($sql);
$rs=mysql_fetch_row($result);
if($rs[4]==1)
{
echo("<h2>Эта выплата уже проведена!</h2>");
}
else
{
$pay=$rs[3];
$d=explode(":",$rs[2]);
if ($d[0]==QIWI) {
echo("<br><center>Переведите <b>".number_format(($pay*$dolkurs/100*(100-$merchantname1)),2)." рублей</b> на кошелек <b>$d[0] $d[1]</b> и затем нажмите кнопку <b><span>Оплачено</span></b>.<br>");
} elseif ($d[0]==PerfectMoney) {
echo("<br><center>Переведите <b><span>$</span>".number_format(($pay/100*(100-$merchantname2)),2)."</b> на кошелек <b>$d[0] $d[1]</b> и затем нажмите кнопку <b><span>Оплачено</span></b>.<br>");
}	  
$fee=$pay;
echo("<form action=admin.php method=post><input type=hidden name=id value=".$rs[0]."><input type=hidden name=pay value=".$pay."><input class=button type=submit name='b' value='Оплачено'></form></center>");
}
}
elseif($b=="Оплачено")
{
$sql="select * from transaactions where ID = ".$_POST[id] ;
$result=mysql_query($sql);
$rs=mysql_fetch_row($result);
if($rs[4]==1)
{
echo("<h2>Эта выплата уже проведена!</h2>");
}
else
{
$sql_u = "update transaactions set approved=1 where ID=".$_POST[id];
$result_u=mysql_query($sql_u);
$sql_u = "update allussers set Paid=Paid+".$rs[3]." where Username='$rs[1]'";
$result_u=mysql_query($sql_u);
echo("<h2>Выплата успешно завершена!</h2>");
}
}
elseif(trim($b)==160)
{
echo "<h4>Размещенные баннеры</h4>";
$step=50;
$currentpage = $p;
$sql="select * from ussersbanners where approved=1 order by ID";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from ussersbanners where approved=1 order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
if(mysql_num_rows($rs)>0) {
echo("<br><form action=admin.php method=post name=maj><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center><b>Логин</b></td><td width=200 align=center><b>Баннер</b></td><td align=center><b>Назначено показов</b></td><td align=center><b>Осталось показов</b></td><td align=center><b>Кликов</b></td><td align=center><b>Дата размещения</b></td><td align=center><b>Действия</b></td></tr>");
while($rs=mysql_fetch_row($result))
{
echo("<tr><td align=center>".$rs[0]."</td><td align=center>".$rs[1]."</td><td align=center><a href=$rs[3] target=_blank><img src=$rs[2] ></a></td><td align=center>$rs[4]</td><td align=center>$rs[5]</td><td align=center>$rs[6]</td><td align=center>$rs[8]</td><td align=center><input type=checkbox name=id".$rs[0]."></td></tr>");
}
echo "<tr><td colspan=8 align=center><input name=allbox type=checkbox value=1 onClick=\"CheckAll();\">Выбрать все/Снять выделение
<br>
<input class=button type=submit name='b' value='Редактировать баннер(ы)'> &nbsp; 
<input class=button type=submit name='b' value='Удалить баннер(ы)'>
</form></td></tr>";
echo("</table>");
?>
<script language="JavaScript">
function CheckAll()
{
for (var i=0;i<document.maj.elements.length;i++)
{
var e = document.maj.elements[i];
if (e.name != "allbox")
e.checked = document.maj.allbox.checked;
}
}
</script>
<?
} else {
echo "<center>Нет баннеров!</center>";
}
}
elseif(trim($b)==170)
{
echo "<h4>Баннеры на удтверждении</h4>";
$step=50;
$currentpage = $p;
$sql="select * from ussersbanners where approved=0 order by ID";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from ussersbanners where approved=0 order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
if(mysql_num_rows($rs)>0) {
echo("<br><form name=maj action=admin.php method=post><table border=1 cellspacing=0><tr><td align=center width=20><b>ID</b></td><td align=center><b>Логин</b></td><td width=200 align=center><b>Баннер</b></td><td align=center><b>Назначено показов</b></td><td align=center><b>Осталось показов</b></td><td align=center><b>Кликов</b></td><td align=center><b>Дата размещения</b></td><td align=center><b>Действия</b></td></tr>");
while($rs=mysql_fetch_row($result))
{
echo("<tr><td align=center>".$rs[0]."</td><td align=center>".$rs[1]."</td><td align=center><a href=$rs[3] target=_blank><img src=$rs[2] ></a></td><td align=center>$rs[4]</td><td align=center>$rs[5]</td><td align=center>$rs[6]</td><td align=center>$rs[8]</td><td align=center><input type=checkbox name=id".$rs[0]."></td></tr>");
}
echo "<tr><td colspan=8 align=center><input name=allbox type=checkbox value=1 onClick=\"CheckAll();\">Выбрать все/Снять выделение
<br>
<input class=button type=submit name='b' value='Разместить баннер(ы)'> &nbsp; 
<input class=button type=submit name='b' value='Редактировать баннер(ы)'> &nbsp; 
<input class=button type=submit name='b' value='Удалить баннер(ы)'>
</form></td></tr>";
echo("</table>");
?>
<script language="JavaScript">
function CheckAll()
{
for (var i=0;i<document.maj.elements.length;i++)
{
var e = document.maj.elements[i];
if (e.name != "allbox")
e.checked = document.maj.allbox.checked;
}
}
</script>
<?
} else {
echo "<center>Нет баннеров!</center>";
}
}
elseif(trim($b)=="Разместить баннер(ы)")
{
foreach($_POST as $k=>$v) {
$d=explode("id",$k);
if($d[1]!="") {
$rs=mysql_query("select * from ussersbanners where ID=$d[1]");
$arr=mysql_fetch_array($rs);
$id=$arr[0];
$sql_d="Update ussersbanners set approved=1 where ID=" .  $id ;
$rs_d=mysql_query($sql_d);
$sql_d="select * from ussersbanners where ID=" .  $id ;
$rs_d=mysql_query($sql_d);
$arr=mysql_fetch_array($rs_d);
$sql="select * from allussers where Username='$arr[1]'" ;
$rs=mysql_query($sql);
$arr1=mysql_fetch_array($rs);
$to=$arr1[7];
$message1=$message6;
$message1=str_replace("{name}","$arr1[1]",$message1);
$message1=str_replace("{email}","$arr1[7]",$message1);
$message1=str_replace("{username}","$arr1[8]",$message1);
$message1=str_replace("{password}","$arr1[9]",$message1);
$message1=str_replace("{banner}","$arr[2]",$message1);
$message1=str_replace("{websiteurl}","$arr[3]",$message1);
$message1=str_replace("{sitename}","$sitename",$message1);
$message1=str_replace("{siteurl}","$siteurl",$message1);
$subject1=str_replace("{name}","$arr1[1]",$subject6);
$subject1=str_replace("{email}","$arr1[7]",$subject1);
$subject1=str_replace("{username}","$arr1[8]",$subject1);
$subject1=str_replace("{password}","$arr1[9]",$subject1);
$subject1=str_replace("{sitename}","$sitename",$subject1);
$subject1=str_replace("{siteurl}","$siteurl",$subject1);
$message=stripslashes($message1);
$subject=stripslashes($subject1);
$from=$webmasteremail;
$header = "From: $sitename<$from>\n";
if($eformat6==1) 
$header .="Content-type: text/plain; charset=utf-8\n";
else
$header .="Content-type: text/html; charset=utf-8\n";
$header .= "Reply-To: <$from>\n";
$header .= "X-Sender: <$from>\n";
$header .= "X-Mailer: PHP4\n";
$header .= "X-Priority: 3\n";
$header .= "Return-Path: <$from>\n";
mail($to,$subject,$message,$header);
echo("<br><center>Баннер <a href=$arr[3] target=_blank><img src=$arr[2]></a> размещен!</center>");
}
}
}
elseif($b=="Удалить баннер(ы)")
{
foreach($_POST as $k=>$v) {
$d=explode("id",$k);
if($d[1]!="") {
$rs=mysql_query("select * from ussersbanners where ID=$d[1]");
$arr=mysql_fetch_array($rs);
$id=$arr[0];
$sql_d="Update ussersbanners set approved=2,assigned=assigned-remaining where ID=" .  $id ;
$rs_d=mysql_query($sql_d);
$sql_d="select * from ussersbanners where ID=" .  $id;
$rs_d=mysql_query($sql_d);
$arr=mysql_fetch_array($rs_d);
$rem=$arr[5];
mysql_query("update allussers set bannersused=bannersused-$rem where Username='$arr[1]'");
$sql="select * from allussers where Username='$arr[1]'" ;
$rs=mysql_query($sql);
$arr1=mysql_fetch_array($rs);
$to=$arr1[7];
$message1=$message7;
$message1=str_replace("{name}","$arr1[1]",$message1);
$message1=str_replace("{email}","$arr1[7]",$message1);
$message1=str_replace("{username}","$arr1[8]",$message1);
$message1=str_replace("{password}","$arr1[9]",$message1);
$message1=str_replace("{banner}","$arr[2]",$message1);
$message1=str_replace("{websiteurl}","$arr[3]",$message1);
$message1=str_replace("{sitename}","$sitename",$message1);
$message1=str_replace("{siteurl}","$siteurl",$message1);
$subject1=str_replace("{name}","$arr1[1]",$subject7);
$subject1=str_replace("{email}","$arr1[7]",$subject1);
$subject1=str_replace("{username}","$arr1[8]",$subject1);
$subject1=str_replace("{password}","$arr1[9]",$subject1);
$subject1=str_replace("{sitename}","$sitename",$subject1);
$subject1=str_replace("{siteurl}","$siteurl",$subject1);
$message=stripslashes($message1);
$subject=stripslashes($subject1);
$from=$webmasteremail;
$header = "From: $sitename<$from>\n";
if($eformat7==1) 
$header .="Content-type: text/plain; charset=utf-8\n";
else
$header .="Content-type: text/html; charset=utf-8\n";
$header .= "Reply-To: <$from>\n";
$header .= "X-Sender: <$from>\n";
$header .= "X-Mailer: PHP4\n";
$header .= "X-Priority: 3\n";
$header .= "Return-Path: <$from>\n";
mail($to,$subject,$message,$header);
echo("<br><center>Баннер <a href=$arr[3] target=_blank><img src=$arr[2]></a> удален!</center>");
}
}
}
elseif(trim($b)=="Редактировать баннер(ы)")
{
if(!$_POST[eb]==1) {
echo "<center><form action=admin.php method=post><input type=hidden name=eb value=1>";
foreach($_POST as $k=>$v) {
$d=explode("id",$k);
if($d[1]!="") {
$rs=mysql_query("select * from ussersbanners where ID=$d[1]");
$arr=mysql_fetch_array($rs);
$id=$arr[0];
echo "<br>
URL баннера<br><input class=logform type=text name=burl$arr[0] value=\"$arr[2]\"><br>
URL сайта<br><input class=logform type=text name=wurl$arr[0] value=\"$arr[3]\"><br>
<a href=$arr[3] target=_blank><img src=$arr[2] ></a>
<br><br>";
}
}
echo "<input class=button type=submit name='b' value='Редактировать баннер(ы)'></form></center>";
}
else {
foreach($_POST as $k=>$v)
$mailbody .=$k." = ".$v."\r\n";
$d=explode("\r\n",$mailbody);
for($i=0;$i<count($d)-1;$i++) {
$dataa=explode(" = ",$d[$i]);
$dt=$dataa[0];
$dataa[0]=eregi_replace("burl","",$dataa[0]);
$dataa[0]=eregi_replace("wurl","",$dataa[0]);
if($dataa[0]=="b" || $dataa[0]=="eb") {
}
else {
$rs=mysql_query("select * from ussersbanners where ID=".$dataa[0]);
if(mysql_num_rows($rs)>0) {
$ac=ereg("burl",$dt);
if($ac==0) {
$rss=mysql_query("update ussersbanners set WebsiteURL='$dataa[1]' where ID=$dataa[0]");
//echo "update ussersbanners set WebsiteURL='$dataa[1]' where ID=$dataa[0]";
}
else {
$rss=mysql_query("update ussersbanners set BannerURL='$dataa[1]' where ID=$dataa[0]");
//echo "update ussersbanners set BannerURL='$dataa[1]' where ID=$dataa[0]";
}
}
}
}
echo "<h2>Изменения сохранены</h2>";
}
}
}
function sendmail($from,$to,$subject,$format,$body)
{
include "confff.php";
$to = $to;
$subject = $subject;
$from=$webmasteremail;
$header = "From: $sitename<$from>\n";
if($format == 1)
$header .="Content-type: text/html; charset=utf-8\n";
else
$header .="Content-type: text/plain; charset=utf-8\n";
$header .= "Reply-To: <$from>\n";
$header .= "X-Sender: <$from>\n";
$header .= "X-Mailer: PHP4\n";
$header .= "X-Priority: 3\n";
$header .= "Return-Path: <$from>\n";
mail($to, $subject , $body, $header);
}
function my_array_unique($somearray){
$tmparr = array_unique($somearray);
$k=0;
foreach ($tmparr as $v) { 
$newarr[$k] = $v;
$k++;
}
return $newarr;
}
function random_number()
{
$random_number = rand(0,9);
return $random_number;
}
function membersrecords($query, $number, $b ,$p)
{
echo "<h4>Все пользователи</h4>";
$step=50;
$currentpage = $p;
$sql="select * from allussers";
if(!$rs=mysql_query($sql))
{
print mysql_error();
exit;
}
$row=mysql_num_rows($rs);
$totallinks=$row;
if(!isset($currentpage))
{
$currentpage=1;
}
if ($totallinks > 0)
{
if ($totallinks < 50)
{
echo("<b>Показано с 1 по ".$totallinks."</b><br>");
}
else
{
if (($currentpage*50) > $totallinks)
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".$totallinks."</b><br>");
}
else
{
echo("<b>Показано с ".intval(($currentpage*50)-49)." по ".intval($currentpage*50)."</b><br>");
}
}
}
if($totallinks > $step)
{
$pagecount=ceil($totallinks/$step);
print "<br>Страницы &nbsp;&nbsp;";
for($i=1;$i<=$pagecount;$i++)
{
if($pageno==$i)
{
echo($i." ");
}
else
{
echo("<a href='admin.php?b=".$b."&p=".$i."'>".$i."</a> &nbsp; ");
}
}
}
$start=($currentpage-1)*$step;
$query="select * from allussers order by ID";
$sql = $query." LIMIT $start,$step";
if(!$result=mysql_query($sql))
{
print mysql_error();
exit;
}
echo("<br><table border=1 cellspacing=0><tr><td width=20 align=center><b>№</b></td><td align=center><b>Email</b></td><td width=90 align=center><b>Логин</b></td><td width=90 align=center><b>Статус</b></td><td align=center><b>Действия</b></td></tr>");
while($rs=mysql_fetch_row($result))
{
$rowcount=$rowcount+1;
$no = (intval($currentpage* 50)-50 + $rowcount);
if($rs[10]==0) {
$st="";
} else {
if($rs[14]==1) {
$st="<span>Неактивный</span>";
}
else {
$st="Активный";
}	}
echo("<tr><form action='admin.php' method=post><input type=hidden name=id value=".$rs[0]."><td align=center>".$no."</td><td align=center>".$rs[7]."</td><td align=center>".$rs[8]."</td><td align=center>".$st."</td><td align=center>");
echo("<input type=hidden name=atype value=".$number.">");
echo("<input class=button type=submit name='b' value='Информация'>&nbsp;<input class=button type=submit name='b' value='Удалить аккаунт'></form></td></tr>");
}
echo("</table>");
}
function newupline($acountid,$ref_by,$mid)
{
include "confff.php";
$check=0;
$rsm=mysql_query("select * from ussersmatrices where ID=$mid");
$arrm=mysql_fetch_array($rsm);
$levels=$arrm[4];
$forcedussersmatrix=$arrm[5];
$tablee="ussersmatrix$mid";
$checkid=0;
$rs=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$ref_by." and ID<>'$acountid' order by ID limit 0,1");
if(mysql_num_rows($rs)>0) {
$arr=mysql_fetch_array($rs);
$check=1;
$checkid=$arr[0];
}
else {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr[0]." order by ID limit 0,1");
if(mysql_num_rows($rs1)>0) {
$arr1=mysql_fetch_array($rs1);
if($check==0) {
$check=1;
$checkid=$arr1[0];
}
break;
}
}
if($check==0) {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where ref_by=".$arr[0]." order by ID");
while($arr1=mysql_fetch_array($rs1)) {
$rs2=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr1[0]." order by ID limit 0,1");
if(mysql_num_rows($rs2)>0) {
$arr2=mysql_fetch_array($rs2);
if($check==0) {
$check=1;
$checkid=$arr2[0];
}
break;
}
}
}
if($check==0) {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where ref_by=".$arr[0]." order by ID");
while($arr1=mysql_fetch_array($rs1)) {
$rs2=mysql_query("select * from $tablee where ref_by=".$arr1[0]." order by ID");
while($arr2=mysql_fetch_array($rs2)) {
$rs3=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr2[0]." order by ID limit 0,1");
if(mysql_num_rows($rs3)>0) {
$arr3=mysql_fetch_array($rs3);
if($check==0) {
$check=1;
$checkid=$arr3[0];
}
break;
}
}
}
}
if($check==0) {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where ref_by=".$arr[0]." order by ID");
while($arr1=mysql_fetch_array($rs1)) {
$rs2=mysql_query("select * from $tablee where ref_by=".$arr1[0]." order by ID");
while($arr2=mysql_fetch_array($rs2)) {
$rs3=mysql_query("select * from $tablee where ref_by=".$arr2[0]." order by ID");
while($arr3=mysql_fetch_array($rs3)) {
$rs4=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr3[0]." order by ID limit 0,1");
if(mysql_num_rows($rs4)>0) {
$arr4=mysql_fetch_array($rs4);
if($check==0) {
$check=1;
$checkid=$arr4[0];
}
break;
} 
}
}
}
}
if($check==0) {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where ref_by=".$arr[0]." order by ID");
while($arr1=mysql_fetch_array($rs1)) {
$rs2=mysql_query("select * from $tablee where ref_by=".$arr1[0]." order by ID");
while($arr2=mysql_fetch_array($rs2)) {
$rs3=mysql_query("select * from $tablee where ref_by=".$arr2[0]." order by ID");
while($arr3=mysql_fetch_array($rs3)) {
$rs4=mysql_query("select * from $tablee where ref_by=".$arr3[0]." order by ID");
while($arr4=mysql_fetch_array($rs4)) {
$rs5=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr4[0]." order by ID limit 0,1");
if(mysql_num_rows($rs5)>0) {
$arr5=mysql_fetch_array($rs5);
if($check==0) {
$check=1;
$checkid=$arr5[0];
}
break;
} 
}
}
}
}
}
if($check==0) {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where ref_by=".$arr[0]." order by ID");
while($arr1=mysql_fetch_array($rs1)) {
$rs2=mysql_query("select * from $tablee where ref_by=".$arr1[0]." order by ID");
while($arr2=mysql_fetch_array($rs2)) {
$rs3=mysql_query("select * from $tablee where ref_by=".$arr2[0]." order by ID");
while($arr3=mysql_fetch_array($rs3)) {
$rs4=mysql_query("select * from $tablee where ref_by=".$arr3[0]." order by ID");
while($arr4=mysql_fetch_array($rs4)) {
$rs5=mysql_query("select * from $tablee where ref_by=".$arr4[0]." order by ID");
while($arr5=mysql_fetch_array($rs5)) {
$rs6=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr5[0]." order by ID limit 0,1");
if(mysql_num_rows($rs6)>0) {
$arr6=mysql_fetch_array($rs6);
if($check==0) {
$check=1;
$checkid=$arr6[0];
}
break;
} 
}
}
}
}
}
}
if($check==0) {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where ref_by=".$arr[0]." order by ID");
while($arr1=mysql_fetch_array($rs1)) {
$rs2=mysql_query("select * from $tablee where ref_by=".$arr1[0]." order by ID");
while($arr2=mysql_fetch_array($rs2)) {
$rs3=mysql_query("select * from $tablee where ref_by=".$arr2[0]." order by ID");
while($arr3=mysql_fetch_array($rs3)) {
$rs4=mysql_query("select * from $tablee where ref_by=".$arr3[0]." order by ID");
while($arr4=mysql_fetch_array($rs4)) {
$rs5=mysql_query("select * from $tablee where ref_by=".$arr4[0]." order by ID");
while($arr5=mysql_fetch_array($rs5)) {
$rs6=mysql_query("select * from $tablee where ref_by=".$arr5[0]." order by ID");
while($arr6=mysql_fetch_array($rs6)) {
$rs7=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr6[0]." order by ID limit 0,1");
if(mysql_num_rows($rs7)>0) {
$arr7=mysql_fetch_array($rs7);
if($check==0) {
$check=1;
$checkid=$arr7[0];
}
break;
} 
}
}
}
}
}
}
}
if($check==0) {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where ref_by=".$arr[0]." order by ID");
while($arr1=mysql_fetch_array($rs1)) {
$rs2=mysql_query("select * from $tablee where ref_by=".$arr1[0]." order by ID");
while($arr2=mysql_fetch_array($rs2)) {
$rs3=mysql_query("select * from $tablee where ref_by=".$arr2[0]." order by ID");
while($arr3=mysql_fetch_array($rs3)) {
$rs4=mysql_query("select * from $tablee where ref_by=".$arr3[0]." order by ID");
while($arr4=mysql_fetch_array($rs4)) {
$rs5=mysql_query("select * from $tablee where ref_by=".$arr4[0]." order by ID");
while($arr5=mysql_fetch_array($rs5)) {
$rs6=mysql_query("select * from $tablee where ref_by=".$arr5[0]." order by ID");
while($arr6=mysql_fetch_array($rs6)) {
$rs7=mysql_query("select * from $tablee where ref_by=".$arr6[0]." order by ID");
while($arr7=mysql_fetch_array($rs7)) {
$rs8=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr7[0]." order by ID limit 0,1");
if(mysql_num_rows($rs8)>0) {
$arr8=mysql_fetch_array($rs8);
if($check==0) {
$check=1;
$checkid=$arr8[0];
}
break;
} 
}
}
}
}
}
}
}
}
if($check==0) {
$rs=mysql_query("select * from $tablee where ref_by=".$ref_by." and ID<>'$acountid' order by ID");
while($arr=mysql_fetch_array($rs)) {
$rs1=mysql_query("select * from $tablee where ref_by=".$arr[0]." order by ID");
while($arr1=mysql_fetch_array($rs1)) {
$rs2=mysql_query("select * from $tablee where ref_by=".$arr1[0]." order by ID");
while($arr2=mysql_fetch_array($rs2)) {
$rs3=mysql_query("select * from $tablee where ref_by=".$arr2[0]." order by ID");
while($arr3=mysql_fetch_array($rs3)) {
$rs4=mysql_query("select * from $tablee where ref_by=".$arr3[0]." order by ID");
while($arr4=mysql_fetch_array($rs4)) {
$rs5=mysql_query("select * from $tablee where ref_by=".$arr4[0]." order by ID");
while($arr5=mysql_fetch_array($rs5)) {
$rs6=mysql_query("select * from $tablee where ref_by=".$arr5[0]." order by ID");
while($arr6=mysql_fetch_array($rs6)) {
$rs7=mysql_query("select * from $tablee where ref_by=".$arr6[0]." order by ID");
while($arr7=mysql_fetch_array($rs7)) {
$rs8=mysql_query("select * from $tablee where ref_by=".$arr7[0]." order by ID");
while($arr8=mysql_fetch_array($rs8)) {
$rs9=mysql_query("select * from $tablee where Level1<".$forcedussersmatrix." and ref_by=".$arr8[0]." order by ID limit 0,1");
if(mysql_num_rows($rs9)>0) {
$arr9=mysql_fetch_array($rs9);
if($check==0) {
$check=1;
$checkid=$arr9[0];
}
break;
} 
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
if($check!=1) {
$rs2=mysql_query("select * from $tablee where Level1<'$forcedussersmatrix' and ID <>'$acountid' order by ID limit 0,1");
$arr2=mysql_fetch_array($rs2);
$checkid=$arr2[0];
}
return $checkid;
}
function assignreferrals($acountid,$refid,$status,$level,$mid) {
include "confff.php";
$tablee="ussersmatrix$mid";
$rsm=mysql_query("select * from ussersmatrices where ID=$mid");
$arrm=mysql_fetch_array($rsm);
$mname=$arrm[1];
$fee=$arrm[2];
$btlevstype=$arrm[3];
$levels=$arrm[4];
$forcedussersmatrix=$arrm[5];
$refbonus=$arrm[84];
$refbonuspaid=$arrm[83];
$payouttype=$arrm[6];
$btlevsbonus=$arrm[7];
$matchingbonus=$arrm[8];
$level1=$arrm[9];
$level2=$arrm[10];
$level3=$arrm[11];
$level4=$arrm[12];
$level5=$arrm[13];
$level6=$arrm[14];
$level7=$arrm[15];
$level8=$arrm[16];
$level9=$arrm[17];
$level10=$arrm[18];
$level1m=$arrm[19];
$level2m=$arrm[20];
$level3m=$arrm[21];
$level4m=$arrm[22];
$level5m=$arrm[23];
$level6m=$arrm[24];
$level7m=$arrm[25];
$level8m=$arrm[26];
$level9m=$arrm[27];
$level10m=$arrm[28];
$level1c=$arrm[29];
$level2c=$arrm[30];
$level3c=$arrm[31];
$level4c=$arrm[32];
$level5c=$arrm[33];
$level6c=$arrm[34];
$level7c=$arrm[35];
$level8c=$arrm[36];
$level9c=$arrm[37];
$level10c=$arrm[38];
$level1cm=$arrm[39];
$level2cm=$arrm[40];
$level3cm=$arrm[41];
$level4cm=$arrm[42];
$level5cm=$arrm[43];
$level6cm=$arrm[44];
$level7cm=$arrm[45];
$level8cm=$arrm[46];
$level9cm=$arrm[47];
$level10cm=$arrm[48];
$textcreditsentry=$arrm[49];
$bannercreditsentry=$arrm[50];
$textcreditscycle=$arrm[51];
$bannercreditscycle=$arrm[52];
$reentry=$arrm[53];
$reentrynum=$arrm[54];
$entry1=$arrm[55];
$entry1num=$arrm[56];
$btlevsid1=$arrm[57];
$entry2=$arrm[58];
$entry2num=$arrm[59];
$btlevsid2=$arrm[60];
$entry3=$arrm[61];
$entry3num=$arrm[62];
$btlevsid3=$arrm[63];
$entry4=$arrm[64];
$entry4num=$arrm[65];
$btlevsid4=$arrm[66];
$entry5=$arrm[67];
$entry5num=$arrm[68];
$btlevsid5=$arrm[69];
$welcomemail=$arrm[70];
$subject1=stripslashes($arrm[71]);
$message1=stripslashes($arrm[72]);
$eformat1=$arrm[73];
$cyclemail=$arrm[74];
$subject2=stripslashes($arrm[75]);
$message2=stripslashes($arrm[76]);
$eformat2=$arrm[77];
$cyclemailsponsor=$arrm[78];
$subject3=stripslashes($arrm[79]);
$message3=stripslashes($arrm[80]);
$eformat3=$arrm[81];
$f1=$forcedussersmatrix;
$f2=$forcedussersmatrix*$forcedussersmatrix;
$f3=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f4=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f5=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f6=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f7=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f8=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f9=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f10=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
if($levels==1) $fquery="Level1<$forcedussersmatrix"; 
elseif($levels==2) $fquery="Level2<$f2";
elseif($levels==3) $fquery="Level3<$f3";
elseif($levels==4) $fquery="Level4<$f4";
elseif($levels==5) $fquery="Level5<$f5";
elseif($levels==6) $fquery="Level6<$f6";
elseif($levels==7) $fquery="Level7<$f7";
elseif($levels==8) $fquery="Level8<$f8";
elseif($levels==9) $fquery="Level9<$f9";
elseif($levels==10) $fquery="Level10<$f10";
if($status==0) {
$rs=mysql_query("Update $tablee set ref_by=".$refid." where ID=".$acountid);
}
if($level < ($levels+1)) {
$referralid=0;
$rs=mysql_query("select * from $tablee where ID=".$refid);
if(mysql_num_rows($rs)>0)
{
$arr=mysql_fetch_array($rs);
$err=0;
$rsb=mysql_query("select * from $tablee where Username='$arr[2]'");
if(mysql_num_rows($rsb)>0) $err=0;
elseif($nonussersmatrixmatch==1) $err=0;
else $err=1;
if($level==1) {
mysql_query("Update $tablee set Level1=Level1+1 where ID=".$refid);
$arr[4]++;
if($payouttype==2) {
$bonus=$level1;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level1m>0&&$err==0) {
$bonus=$level1m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==1)&&($arr[4]==$f1)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'"); 
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[4]==$f1) {
$bonus=$level1c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level1cm>0&&$err==0) {
$bonus=$level1cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==1)&&($arr[4]==$f1)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'"); 
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==1&&$arr[4]==$f1) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==2) {
mysql_query("Update $tablee set Level2=Level2+1 where ID=".$refid);
$arr[5]++;
if($payouttype==2) {
$bonus=$level2;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level2m>0&&$err==0) {
$bonus=$level2m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==2)&&($arr[5]==$f2)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[5]==$f2) {
$bonus=$level2c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level2cm>0&&$err==0) {
$bonus=$level2cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==2)&&($arr[5]==$f2)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==2&&$arr[5]==$f2) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==3) {
mysql_query("Update $tablee set Level3=Level3+1 where ID=".$refid);
$arr[6]++;
if($payouttype==2) {
$bonus=$level3;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level3m>0&&$err==0) {
$bonus=$level3m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==3)&&($arr[6]==$f3)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[6]==$f3) {
$bonus=$level3c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level3cm>0&&$err==0) {
$bonus=$level3cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==3)&&($arr[6]==$f3)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==3&&$arr[6]==$f3) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==4) {
mysql_query("Update $tablee set Level4=Level4+1 where ID=".$refid);
$arr[7]++;
if($payouttype==2) {
$bonus=$level4;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level4m>0&&$err==0) {
$bonus=$level4m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==4)&&($arr[7]==$f4)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[7]==$f4) {
$bonus=$level4c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level4cm>0&&$err==0) {
$bonus=$level4cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==4)&&($arr[7]==$f4)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==4&&$arr[7]==$f4) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==5) {
mysql_query("Update $tablee set Level5=Level5+1 where ID=".$refid);
$arr[8]++;
if($payouttype==2) {
$bonus=$level5;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level5m>0&&$err==0) {
$bonus=$level5m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==5)&&($arr[8]==$f5)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[8]==$f5) {
$bonus=$level5c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level5cm>0&&$err==0) {
$bonus=$level5cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==5)&&($arr[8]==$f5)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==5&&$arr[8]==$f5) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==6) {
mysql_query("Update $tablee set Level6=Level6+1 where ID=".$refid);
$arr[9]++;
if($payouttype==2) {
$bonus=$level6;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level6m>0&&$err==0) {
$bonus=$level6m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==6)&&($arr[9]==$f6)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[9]==$f6) {
$bonus=$level6c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level6cm>0&&$err==0) {
$bonus=$level6cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==6)&&($arr[9]==$f6)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==6&&$arr[9]==$f6) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==7) {
mysql_query("Update $tablee set Level7=Level7+1 where ID=".$refid);
$arr[10]++;
if($payouttype==2) {
$bonus=$level7;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level7m>0&&$err==0) {
$bonus=$level7m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==7)&&($arr[10]==$f7)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[10]==$f7) {
$bonus=$level7c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level7cm>0&&$err==0) {
$bonus=$level7cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==7)&&($arr[10]==$f7)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==7&&$arr[10]==$f7) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==8) {
mysql_query("Update $tablee set Level8=Level8+1 where ID=".$refid);
$arr[11]++;
if($payouttype==2) {
$bonus=$level8;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level8m>0&&$err==0) {
$bonus=$level8m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==8)&&($arr[11]==$f8)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[11]==$f8) {
$bonus=$level8c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level8cm>0&&$err==0) {
$bonus=$level8cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==8)&&($arr[11]==$f8)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==8&&$arr[11]==$f8) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==9) {
mysql_query("Update $tablee set Level9=Level9+1 where ID=".$refid);
$arr[12]++;
if($payouttype==2) {
$bonus=$level9;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level9m>0&&$err==0) {
$bonus=$level9m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==9)&&($arr[12]==$f9)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[12]==$f9) {
$bonus=$level9c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level9cm>0&&$err==0) {
$bonus=$level9cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==9)&&($arr[12]==$f9)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==9&&$arr[12]==$f9) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($level==10) {
mysql_query("Update $tablee set Level10=Level10+1 where ID=".$refid);
$arr[13]++;
if($payouttype==2) {
$bonus=$level10;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level10m>0&&$err==0) {
$bonus=$level10m;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==10)&&($arr[13]==$f10)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==3&&$arr[13]==$f10) {
$bonus=$level10c;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($level10cm>0&&$err==0) {
$bonus=$level10cm;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
if(($levels==10)&&($arr[13]==$f10)) {
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
elseif($payouttype==1&&$levels==10&&$arr[13]==$f10) {
$bonus=$btlevsbonus;
mysql_query("update $tablee set Total=Total+$bonus where ID=".$refid);
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[1]'");
if($matchingbonus>0&&$err==0) {
$bonus=$matchingbonus;
mysql_query("update allussers set Total=Total+$bonus,Unpaid=Unpaid+$bonus where Username='$arr[2]'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$arr[2]',$arr[14],$mid,'$bonus','100% Matching Bonus',now())");
}
$today=date ( "Y-m-d H:i:s", mktime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
mysql_query("update $tablee set CDate='$today' where ID=".$refid);
mysql_query("update allussers set banners=banners+$bannercreditscycle,textads=textads+$textcreditscycle where Username='$arr[1]'");
print "<center><b>Пользователь <span>$arr[1]</span> (ID позиции <span>$refid</span>) заполнил матрицу <span>$mname</span>.</b></center>";
if($reentry==1&&$arr[1]!="admin") {
for($z=1;$z<=$reentrynum;$z++) joinussersmatrix($arr[17],$mid);
}
if($entry1==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry1num;$z++) joinussersmatrix($arr[17],$btlevsid1);
}
if($entry2==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry2num;$z++) joinussersmatrix($arr[17],$btlevsid2);
}
if($entry3==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry3num;$z++) joinussersmatrix($arr[17],$btlevsid3);
}
if($entry4==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry4num;$z++) joinussersmatrix($arr[17],$btlevsid4);
}
if($entry5==1&&$arr[1]!="admin") {
for($z=1;$z<=$entry5num;$z++) joinussersmatrix($arr[17],$btlevsid5);
}
}
}
if($arr[3]!=0) {
$referralid=$arr[3];
}
if($referralid!=0) {
assignreferrals($acountid,$referralid,1,$level+1,$mid);
}
}
}
}
function joinussersmatrix($idd,$mid) {
include "confff.php";
$tablee="ussersmatrix$mid";
$rsm=mysql_query("select * from ussersmatrices where ID=$mid");
$arrm=mysql_fetch_array($rsm);
$mname=$arrm[1];
$fee=$arrm[2];
$btlevstype=$arrm[3];
$levels=$arrm[4];
$forcedussersmatrix=$arrm[5];
$refbonus=$arrm[84];
$refbonuspaid=$arrm[83];
$payouttype=$arrm[6];
$btlevsbonus=$arrm[7];
$matchingbonus=$arrm[8];
$level1=$arrm[9];
$level2=$arrm[10];
$level3=$arrm[11];
$level4=$arrm[12];
$level5=$arrm[13];
$level6=$arrm[14];
$level7=$arrm[15];
$level8=$arrm[16];
$level9=$arrm[17];
$level10=$arrm[18];
$level1m=$arrm[19];
$level2m=$arrm[20];
$level3m=$arrm[21];
$level4m=$arrm[22];
$level5m=$arrm[23];
$level6m=$arrm[24];
$level7m=$arrm[25];
$level8m=$arrm[26];
$level9m=$arrm[27];
$level10m=$arrm[28];
$level1c=$arrm[29];
$level2c=$arrm[30];
$level3c=$arrm[31];
$level4c=$arrm[32];
$level5c=$arrm[33];
$level6c=$arrm[34];
$level7c=$arrm[35];
$level8c=$arrm[36];
$level9c=$arrm[37];
$level10c=$arrm[38];
$level1cm=$arrm[39];
$level2cm=$arrm[40];
$level3cm=$arrm[41];
$level4cm=$arrm[42];
$level5cm=$arrm[43];
$level6cm=$arrm[44];
$level7cm=$arrm[45];
$level8cm=$arrm[46];
$level9cm=$arrm[47];
$level10cm=$arrm[48];
$textcreditsentry=$arrm[49];
$bannercreditsentry=$arrm[50];
$textcreditscycle=$arrm[51];
$bannercreditscycle=$arrm[52];
$reentry=$arrm[53];
$reentrynum=$arrm[54];
$entry1=$arrm[55];
$entry1num=$arrm[56];
$btlevsid1=$arrm[57];
$entry2=$arrm[58];
$entry2num=$arrm[59];
$btlevsid2=$arrm[60];
$entry3=$arrm[61];
$entry3num=$arrm[62];
$btlevsid3=$arrm[63];
$entry4=$arrm[64];
$entry4num=$arrm[65];
$btlevsid4=$arrm[66];
$entry5=$arrm[67];
$entry5num=$arrm[68];
$btlevsid5=$arrm[69];
$welcomemail=$arrm[70];
$subject1=stripslashes($arrm[71]);
$message1=stripslashes($arrm[72]);
$eformat1=$arrm[73];
$cyclemail=$arrm[74];
$subject2=stripslashes($arrm[75]);
$message2=stripslashes($arrm[76]);
$eformat2=$arrm[77];
$cyclemailsponsor=$arrm[78];
$subject3=stripslashes($arrm[79]);
$message3=stripslashes($arrm[80]);
$eformat3=$arrm[81];
$f1=$forcedussersmatrix;
$f2=$forcedussersmatrix*$forcedussersmatrix;
$f3=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f4=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f5=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f6=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f7=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f8=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f9=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
$f10=$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix*$forcedussersmatrix;
if($levels==1) $fquery="Level1<$forcedussersmatrix"; 
elseif($levels==2) $fquery="Level2<$f2";
elseif($levels==3) $fquery="Level3<$f3";
elseif($levels==4) $fquery="Level4<$f4";
elseif($levels==5) $fquery="Level5<$f5";
elseif($levels==6) $fquery="Level6<$f6";
elseif($levels==7) $fquery="Level7<$f7";
elseif($levels==8) $fquery="Level8<$f8";
elseif($levels==9) $fquery="Level9<$f9";
elseif($levels==10) $fquery="Level10<$f10";
$upline=0;
$rsm=mysql_query("select * from ussersmatrices order by ID desc");
while($arrm=mysql_fetch_array($rsm)) {
$rs1=mysql_query("select * from ussersmatrix$arrm[0] where MainID=$idd");
if(mysql_num_rows($rs1)>0) {
$arr1=mysql_fetch_array($rs1);
for ($i=1; $i<=17; $i=$i+1) {
$a[$i]=$arr1[$i];
}
$user=$a[1];
$ref_by=$a[2];
if($mid==$arrm[0]) $upline=$a[14];
$urid=$a[17];
}
}
$rsp=mysql_query("select ID from $tablee where $fquery and Username='$ref_by'");
if(mysql_num_rows($rsp)>0) {
$arrp=mysql_fetch_array($rsp);
$upline=$arrp[0];
}
mysql_query("insert into $tablee(Username,Sponsor,ref_by,Level1,Level2,Level3,Level4,Level5,Level6,Level7,Level8,Level9,Level10,Leader,Total,Date,MainID,CDate) values('$user','$ref_by',$upline,0,0,0,0,0,0,0,0,0,0,$upline,0,now(),$urid,now())");
$b=mysql_insert_id();
if($b>0) {
if($urid==0) mysql_query("update $tablee set MainID=$b where ID=$b");
$acountid=$b;
$a[11]=$upline;
mysql_query("update allussers set banners=banners+$bannercreditsentry,textads=textads+$textcreditsentry where Username='$user'");
if($refbonuspaid>1&&$refbonus>0) {
$rsb=mysql_query("select * from allussers where Username='$ref_by'");
if(mysql_num_rows($rsb)>0) {
$arrb=mysql_fetch_array($rsb);
if(($arrb[14]==2)||($arrb[14]==1&&$freerefbonus==1)) {
mysql_query("update allussers set Total=Total+$refbonus,Unpaid=Unpaid+$refbonus where Username='$ref_by'");
mysql_query("insert into journal(Username,memid,ussersmatrix,Amount,purpose,Date) values('$ref_by',$upline,$mid,'$refbonus','Referral Bonus',now())");
}
}
}
if($btlevstype==1) {
if ($upline==0)
{
$rs=mysql_query("select * from $tablee where Level1<$forcedussersmatrix and ID <>'$acountid' order by ID limit 0,1");
if (mysql_num_rows($rs)>0)
{
$arr=mysql_fetch_array($rs);
assignreferrals($acountid,$arr[0],0,1,$mid);
}
}
else {
$rs=mysql_query("select * from $tablee where ID=".$upline);

if(mysql_num_rows($rs)>0) {
$arr=mysql_fetch_array($rs);
if($arr[4]>($forcedussersmatrix-1)) {
assignreferrals($acountid,newupline($acountid,$upline,$mid),0,1,$mid);
}
else {
assignreferrals($acountid,$upline,1,1,$mid);
}
}
else {
$rs=mysql_query("select * from $tablee where Level1<$forcedussersmatrix and ID <>'$acountid' order by ID limit 0,1");
if (mysql_num_rows($rs)>0)
{
$arr=mysql_fetch_array($rs);
assignreferrals($acountid,$arr[0],0,1,$mid);
}
}
}
}
else {
$rs=mysql_query("select * from $tablee where Level1<$forcedussersmatrix and ID <>'$acountid' order by ID limit 0,1");
if (mysql_num_rows($rs)>0)
{
$arr=mysql_fetch_array($rs);
assignreferrals($acountid,$arr[0],0,1,$mid);
}
}
}
else {
echo "<br><b>Error Creating ussersmatrix Position.</b><br>";
}
}
?>
</div>
</body>
</html>