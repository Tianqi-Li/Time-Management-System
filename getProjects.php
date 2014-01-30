<?php
include_once('database.php');
header("Content-Type: application/json");

session_start();
ini_set("session.cookie_httponly", 1);
$username = $_SESSION['user'];

$sql = "SELECT * FROM projects";
$res = mysql_query($sql);
$projects = array();


while($project = mysql_fetch_assoc($res)) {

    $projects[] = $project;
    
}


if($projects != null) {
    echo json_encode(array(
            "projectExisted" => true,
            "projects" => $projects
	    
    ));
    exit();
} else {
    echo json_encode(array(
            "projectExisted" => false,
	    "message" => "Project not exist"
    ));
    exit();
}

?>