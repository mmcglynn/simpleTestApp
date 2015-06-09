<?php

require_once("inc/connection.php");

$de= mysql_real_escape_string($_GET["decode"]);
 
$sql = 'select * from urls where output="$de"';

$result=mysql_query("select * from urls where output='$de'");

while($row = mysql_fetch_array($result)) {

	$res=$row['original'];

	header("location:".$res);
}

?>