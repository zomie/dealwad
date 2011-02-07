<html>
<head>
	<style>
		ul {list-style-type:none;margin:0;padding:0;}
		li {width:33%;border:1px solid #ccc; margin:3px;padding:3px;}
	</style>
</head>
<body>
<h2>Simple Stack Class Illistration Page</h2>
<p>You can view the source at: <a href="https://github.com/zomie/dealwad/tree/master/stack">https://github.com/zomie/dealwad/tree/master/stack</a></p>
<form action="index.php" method="get">
	<label for="pushstr">String To Push:</label>
	<input type="text" id="pushstr" name="pushstr">
	<input type="submit" value="push">
</form>
<form action="index.php" method="get">
	<input type="hidden" name="pop" value="true">
	<input type="submit" value="pop">
</form>
<?php
//include the Stacker class
include 'Stacker.php';
//create new instance of stacker
$stack = new Stacker;
//see if something is being pushed in the stack
if (!empty($_GET['pushstr'])) {
	$stack->push($_GET['pushstr']);
}
//see if a record is being popped
if (!empty($_GET['pop'])) {
	echo 'Item popped: ' . $stack->pop();
}
//show the stack
echo $stack->show();
?>

</body>
</html>