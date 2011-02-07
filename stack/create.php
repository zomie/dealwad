<?php

//just contains mysql connection method with user/pass
include 'connect.php';

mysql_select_db("stacker", $connect) or die(mysql_error());
//create table stacker in the db stacker
$sql = "CREATE TABLE stacker
(
pid INT(8) NOT NULL AUTO_INCREMENT,
PRIMARY KEY(pid),
stackStr VARCHAR(255),
createdAt DATETIME DEFAULT NULL
)";
mysql_query($sql, $connect) or die(mysql_error());
?>