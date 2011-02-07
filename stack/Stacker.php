<?php
//Resources Utilized in order of reading:
//http://php.net/manual/en/language.oop5.php

//just contains mysql connection method with user/pass
include 'connect.php';

/*
 * Class Stacker
 * modifies a stack in a db table through pop and push methods
*/

class Stacker {
	//public $table = "stacker";

	public static function pop() {
		$query = "SELECT * FROM stacker ORDER BY createdAt DESC LIMIT 1";
		mysql_select_db("stacker", $GLOBALS['connect']);
		$result = mysql_query($query, $GLOBALS['connect']) or die(mysql_error());
		$stack = '';
		$pid = 0;
		while($row = mysql_fetch_array($result)) {
			$stack = $row['stackStr'];
			$pid = $row['pid'];
		}

		//remove that record
		$delete = "DELETE FROM stacker WHERE pid = " . $pid;
		mysql_query($delete, $GLOBALS['connect']) or die(mysql_error());

		return $stack;
	}

	public static function push($item) {
		//build query to insert into stacker table and have it clean the item param
		$query = "INSERT INTO stacker VALUES ('', '" . strip_tags($item) . "', NOW())";
		mysql_select_db("stacker", $GLOBALS['connect']);
		mysql_query($query, $GLOBALS['connect']) or die(mysql_error());
		//mysql_close($GLOBALS['connect']);
	}

	public static function show() {
		$query = "SELECT * FROM stacker ORDER BY createdAt DESC";
		mysql_select_db("stacker", $GLOBALS['connect']);
		$result = mysql_query($query, $GLOBALS['connect']) or die(mysql_error());
		$stack = '<h3>The Stack</h3><ul>';
		while($row = mysql_fetch_array($result)) {
		  	$stack .= "<li>" . $row['stackStr'] . "</li>";
		}
		$stack .= '</ul>';
		return $stack;
	}

}

?>