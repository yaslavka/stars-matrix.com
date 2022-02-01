			<div class="rightblock">
				<h2>Реклама</h2>
<?php
$rs=mysql_query("select * from ussersbanners where remaining>0 and approved=1 order by rand() limit 0,$showban");
$i=0;
$dtext="";
while($arr=mysql_fetch_array($rs)) {
$rsu=mysql_query("update ussersbanners set remaining=remaining-1 where ID=$arr[0]");
$dtext=$dtext."<div class='bannernull'><a href=$siteurl/reban.php?id=$arr[0] target=_blank rel='nofollow'><img src=$arr[2] width=125 height=125></a></div>";
$i++;
}
if($i<$showban) {
for($j=$i;$j<$showban;$j++) {
$dtext=$dtext."<div class='bannernull'><a href=$siteurl/join.php><img src=$siteurl/banners/125x125.gif width=125 height=125></a></div>";
}
}
echo $dtext;
?>
			</div>