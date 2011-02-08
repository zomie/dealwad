<?php
//just contains user/pass/db vars to be accessed which should not be checked in
include 'connect.php';

/*
 * Class Sql
 * The Sql class just abstracts out the sql call
 * It contains a method to execute a sql query
*/

class Sql {

	//function executeQuery
	//param query - sql query to be executed
	//Executes a sql query to access a database
	//returns a sql query result
	public static function executeQuery($query) {
		$connect = mysql_connect('localhost',$GLOBALS['user'],$GLOBALS['password']);
		mysql_select_db($GLOBALS['db'], $connect);
		$result = mysql_query($query, $connect) or die(mysql_error());
		mysql_close($connect);

		return $result;
	}

}

?>