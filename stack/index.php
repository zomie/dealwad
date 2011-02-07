<html>
<head>
	<style>
		ul {list-style-type:none;margin:0;padding:0;}
		li {width:33%;border:1px solid #ccc; margin:3px;padding:3px;}
	</style>
</head>
<body>
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
include 'Stacker.php';
$stack = new Stacker;
if (!empty($_GET['pushstr'])) {
	$stack->push($_GET['pushstr']);
}
if (!empty($_GET['pop'])) {
	echo 'Item popped: ' . $stack->pop();
}
echo $stack->show();
?>

</body>
</html>