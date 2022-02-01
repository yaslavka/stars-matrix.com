<?
header("Location: account.php");
session_start();
include "siteconfig/confff.php";
echo stripslashes($arr[2]);
$_SESSION["username_session"]="";
$_SESSION["password_session"]="";
session_destroy();
?>