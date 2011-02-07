<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
//just contains mysql connection method with user/pass
include 'connect.php';

mysql_select_db("stacker", $connect) or die(mysql_error());
$sql = "CREATE TABLE stacker
(
pid INT(8) NOT NULL AUTO_INCREMENT,
PRIMARY KEY(pid),
stackStr VARCHAR(255),
createdAt DATETIME DEFAULT NULL
)";
mysql_query($sql, $connect) or die(mysql_error());
?>