<?php

include_once('database.php');
header("Content-Type: application/json");

session_start();
ini_set("session.cookie_httponly", 1);
$username = $_SESSION['user'];

$sql = "SELECT * FROM emails WHERE (username='$username')";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

if($row) {
    if($row['signup_email'] === "false") {
        // Sign up email has not been sent
         $sql1 = "UPDATE emails SET signup_email='true' WHERE (username='$username')";
         //$result = mysql_query($sql1);
         $email = $row['email'];
         echo json_encode(array(
            "needtosend" => true,
            "email" => $email
        ));
        exit();
    } else {
        echo json_encode(array(
            "needtosend" => false
        ));
        exit();
    }
   
}


?>