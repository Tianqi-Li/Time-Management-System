<?php
// Content of database.php
 /*
$mysqli = new mysqli('localhost', 'module8User', 'module8User', 'module8');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
*/
$conn = mysql_connect('localhost', 'module8User', 'module8User');
$db   = mysql_select_db('module8');
?>



