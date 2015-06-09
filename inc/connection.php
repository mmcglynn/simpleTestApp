<?php
function showError() {
	die("Error: " . mysql_errno() . " : " . mysql_error());
}
$hostname = "localhost";
$databaseName = "short_url";
$userName = "root";
$password = "root";

// Connect to the server
if (!($connection = mysql_connect($hostname, $userName, $password)))
	showError();
if (!(mysql_select_db($databaseName, $connection)))
	showError();
?>