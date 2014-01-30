<?php
$mysqli = new mysqli('ec2-107-22-9-201.compute-1.amazonaws.com/', 'lydia', '1234', 'project');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>