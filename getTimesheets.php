<?php

include_once('database.php');
header("Content-Type: application/json");

session_start();
ini_set("session.cookie_httponly", 1);
$username = $_SESSION['user'];

$sunday = mysql_real_escape_string( $_POST["sunday"] );
$saturday = mysql_real_escape_string( $_POST["saturday"] );
$sql = "SELECT project FROM workers WHERE (worker='$username')";
$res = mysql_query($sql);
$timesheets = array();
    while($project = mysql_fetch_assoc($res)) {
        $title = $project['project'];
        $sql1 = "SELECT day, hour FROM timesheets WHERE (username='$username' AND project='$title' AND day BETWEEN '$sunday' AND '$saturday')";
        $res1 = mysql_query($sql1);
        $sheet = array(
                "title" => $title,
                "sun" => 0,
                "mon" => 0,
                "tue" => 0,
                "wed" => 0,
                "thr" => 0,
                "fri" => 0,
                "sat" => 0);
        while($r = mysql_fetch_assoc($res1)) {
            $weekday = $r['day'];
            $dayStr = date('l', strtotime( $weekday));
        switch ($dayStr)
        {
            case "Sunday":
                $sheet["sun"] = $r['hour'];
                break;
            case "Monday":
                $sheet["mon"] = $r['hour'];
                break;
            case "Tuesday":
                $sheet["tue"] = $r['hour'];
                break;
            case "Wednesday":
                $sheet["wed"] = $r['hour'];
                break;
            case "Thursday":
                $sheet["thr"] = $r['hour'];
                break;
            case "Friday":
                $sheet["fri"] = $r['hour'];
                break;
            case "Saturday":
                $sheet["sat"] = $r['hour'];
                break;
        }
    }
        $timesheets[] = $sheet;
    }
    
if($timesheets != null) {
    echo json_encode(array(
        "success" => true,
        "timesheets" => $timesheets 
    ));
    exit();
} else {
    echo json_encode(array(
        "success" => false,
        "message" => "The user has not signed up in any project"
    ));
    exit();
}


?>