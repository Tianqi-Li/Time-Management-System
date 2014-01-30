<?php
include_once('database.php');
header("Content-Type: application/json");

session_start();
ini_set("session.cookie_httponly", 1);
$username = $_SESSION['user'];

$project = mysql_real_escape_string( $_POST["title"] );

    $sql = "DELETE FROM workers WHERE (worker='$username' AND project='$project');";
    $result = mysql_query($sql);
    $sql1 = "DELETE FROM timesheets WHERE (username='$username' AND project='$project');";
    $result1 = mysql_query($sql1);
    
    if( $result && $result1) {
        $sql2 = "SELECT * FROM projects WHERE (title='$project')";
        $res = mysql_query($sql2);
        $row = mysql_fetch_array($res);
        if($row) {
            $manager = $row['manager'];
            $sql3 = "SELECT * FROM users WHERE (username='$manager')";
            $res1 = mysql_query($sql3);
            $row1 = mysql_fetch_array($res1);
            if($row1) {
                $email = $row1['email'];
                echo json_encode(array(
                "success" => true,
                "email" => $email
                ));
            exit();
            }
        }
	
    } else {
	echo json_encode(array(
	    "success" => false,
            "message" => "You did not quit the project"
	));
	exit();
    }


?>