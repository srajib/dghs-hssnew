<?php 

$host = "103.247.238.173";
$user = "root";
$pass = "mistestdb";
$db = "dghs_hrm_main";

mysql_connect($host,$user,$pass) or die("Connection failed");
mysql_select_db($db) or die("Database not found");
?>