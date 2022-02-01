<?php
$dbhost="localhost";
$dbname="demospec_mm2x2";
$dbuser="Admin";
$dbpass="12345678";

  $dbconnect=mysql_connect($dbhost,$dbuser,$dbpass);
  mysql_select_db($dbname);
