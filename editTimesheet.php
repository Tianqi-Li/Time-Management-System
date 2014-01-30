<?php

include_once('database.php');
header("Content-Type: application/json");

session_start();
ini_set("session.cookie_httponly", 1);
$username = $_SESSION['user'];

$title = mysql_real_escape_string( $_POST["title"] );
$sundate = mysql_real_escape_string( $_POST["sundate"] );
$sunhour = mysql_real_escape_string( $_POST["sunhour"] );
$mondate = mysql_real_escape_string( $_POST["mondate"] );
$monhour = mysql_real_escape_string( $_POST["monhour"] );
$tuedate = mysql_real_escape_string( $_POST["tuedate"] );
$tuehour = mysql_real_escape_string( $_POST["tuehour"] );
$weddate = mysql_real_escape_string( $_POST["weddate"] );
$wedhour = mysql_real_escape_string( $_POST["wedhour"] );
$thrdate = mysql_real_escape_string( $_POST["thrdate"] );
$thrhour = mysql_real_escape_string( $_POST["thrhour"] );
$fridate = mysql_real_escape_string( $_POST["fridate"] );
$frihour = mysql_real_escape_string( $_POST["frihour"] );
$satdate = mysql_real_escape_string( $_POST["satdate"] );
$sathour = mysql_real_escape_string( $_POST["sathour"] );

$timesheet = array(
                array($sundate, $sunhour),
                array($mondate, $monhour),
                array($tuedate, $tuehour),
                array($weddate, $wedhour),
                array($thrdate, $thrhour),
                array($fridate, $frihour),
                array($satdate, $sathour)
    );

$flag = True;
for($i=0; $i<7; $i++) {
    $day = $timesheet[$i][0];
    $hour = $timesheet[$i][1];
    $sql = "SELECT * FROM timesheets WHERE (username='$username' AND project='$title' AND day='$day')";
    $res = mysql_query($sql);
    $rows = mysql_fetch_array($res);
    
    
    if($rows) {
        // Edit the existing timesheet
        $sql1 = "UPDATE timesheets SET hour='$hour' WHERE (username='$username' AND project='$title' AND day='$day')";
        $result = mysql_query($sql1);
        if($result == False) {
            $flag = False;
        } 
    }
    else {
        // Create a new time sheet entry
        $sql1 = "INSERT INTO timesheets (username, project, day, hour) VALUES('$username', '$title', '$day', '$hour');";
        $result = mysql_query($sql1);
        if($result == False) {
            $flag = False;
        }
    }
}

if($flag) {
    echo json_encode(array(
        "success" => true,
        "title" => $title
    ));
    exit();
} else {
    echo json_encode(array(
        "success" => false,
        "message" => "Failed to update time sheet"
    ));
    exit();
}
 
?>