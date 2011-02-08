<?php
//Resources Utilized in order of reading:
//http://php.net/manual/en/language.oop5.php
//http://net.tutsplus.com/tutorials/php/object-oriented-php-for-beginners/
//http://www.freewebmasterhelp.com/tutorials/phpmysq

//include parent sql class
include 'Sql.php';


/*
 * Class Stacker
 * The Stacker class utilizes a table in a database in reverse order to simulate a stack.
 * It contains methods to show the stack, to push to the stack, and to pop a record off of the stack
*/

class Stacker extends Sql{

	//function pop
	//Grabs the last record in the table stores it to be returned and then deletes that record
	public static function pop() {
		$query = "SELECT * FROM stacker ORDER BY createdAt DESC LIMIT 1";
		$result = parent::executeQuery($query);
		$stack = '';
		$pid = 0;
		while($row = mysql_fetch_array($result)) {
			$stack = $row['stackStr'];
			$pid = $row['pid'];
		}

		//remove that record
		$delete = "DELETE FROM stacker WHERE pid = " . $pid;
		parent::executeQuery($delete);

		//return the last item in the stack
		return $stack;
	}

	//function push
	//param item - item to be added to the top of the stack
	//Pushes a new item to a table
	public static function push($item) {
		//build query to insert into stacker table and have it clean the item param
		$query = "INSERT INTO stacker VALUES ('', '" . strip_tags($item) . "', NOW())";
		parent::executeQuery($query);
	}

	//function show
	//Grabs the stack table in reverse order based on date entered (simulating a stack)
	//and returns it as a ul
	public static function show() {
		$query = "SELECT * FROM stacker ORDER BY createdAt DESC";
		$result = parent::executeQuery($query);
		$stack = '<h3>The Stack</h3><ul>';
		while($row = mysql_fetch_array($result)) {
		  	$stack .= "<li>" . $row['stackStr'] . "</li>";
		}
		$stack .= '</ul>';
		return $stack;
	}

}

?>