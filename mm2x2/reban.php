<?php
include "siteconfig/confff.php";
$id =(int)$_GET[id];
      $sql = "select * from ussersbanners where id=". $id;
      $result = mysql_query($sql);
if(mysql_num_rows($result)>0) {
      $arr = mysql_fetch_array($result);
$rs=mysql_query("update ussersbanners set hits=hits+1 where id=$id");
mysql_close($dbconnect);
	header("Location:".$arr[3]);
}
else {
echo "<br><b>ОШИБКА!</b><br>";
mysql_close($dbconnect);
}
?>