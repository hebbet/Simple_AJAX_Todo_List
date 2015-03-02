<?php
	$server = "localhost";
	$db_name = "todo"; // Enter your database name
	$db_user = "todo"; // Enter your username
	$db_pass = "todo"; // Enter your password
	

	mysql_connect($server, $db_user, $db_pass) or die("Could not connect to server!");
	mysql_select_db($db_name) or die("Could not connect to database!");
?>