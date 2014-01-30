<?php
include_once('database.php');
header("Content-Type: application/json");

session_start();
ini_set("session.cookie_httponly", 1);
$username = $_SESSION['user'];

$project = mysql_real_escape_string( $_POST["project"] );
// Check if worker is already in the project
$sql1 = "SELECT project FROM workers WHERE (worker='$username' AND project='$project')";
$res1 = mysql_query($sql1);
$rows = mysql_fetch_array($res1);

if($rows) {
    echo json_encode(array(
        "success" => false,
        "message" => "You are already in that project"
    ));
    exit();
} else {
    $sql = "INSERT INTO workers (worker, project) VALUES('$username','$project');";
    $result = mysql_query($sql);
    
    if( $result ) {
	echo json_encode(array(
	    "success" => true,
            "title" => $project
	));
	exit();
    } else {
	echo json_encode(array(
	    "success" => false,
            "message" => "No such project",
	));
	exit();
    }

}


?>