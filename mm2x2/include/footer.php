	<div class="clear"></div>
    <?php
include "siteconfig/confff.php";
$rsa=mysql_query("select * from freepag where ID=1");
$sql = "select count(*) from allussers where active=1 and status=1";
$result = mysql_query($sql);
$rsa  =  mysql_fetch_row($result);
$sql1 = "select count(*) from allussers where active=1 and status=2";
$result1 = mysql_query($sql1);
$rsa1  =  mysql_fetch_row($result1);
$sqlpp1 = "select count(*) from allussers where active=0";
$resultpp1 = mysql_query($sqlpp1);
$rspp1  =  mysql_fetch_row($resultpp1);
$sql6 = "select sum(Amount) from transaactions where approved=1";
$result6 = mysql_query($sql6);
$rs6  =  mysql_fetch_row($result6);
?>
	<div class="footer">
		<div class="stats">
			<table width="100%" valign="center">
				<tr><td align="center"><h4>Регистраций&nbsp;<?php echo ''.($rsa[0]+$rsa1[0]+$rspp1[0]).'' ?></h4></td>
				<td align="center"><h4>Участников&nbsp;<?php echo ''.(0+$rsa1[0]).'' ?></h4></td>
				<td align="center"><h4>Выплачено&nbsp;$<?php echo ''.(0+$rs6[0]).'' ?></h4></td></tr>
			</table>
		</div>
	</div>
	<div class="copyright">
		<div class="copyrightin">
			&copy; Copyright 2021, <?php echo $sitename; ?>
			<div class="footerright">
			    Работаем с <a href="https://perfectmoney.is/" target="_blank">Perfect Money</a> <?php if (!empty($qiwi)) { echo 'и <a href="https://qiwi.ru" target="_blank">QIWI</a>'; } ?>
		    </div>
		</div>
	</div>
</div>
</body>
</html>