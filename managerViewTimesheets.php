<?php

session_start();
include_once('database.php');
$username = $_SESSION['user'];
$title = $_SESSION['project'];
$sunday = mysql_real_escape_string( $_POST["sunday"] );
$saturday = mysql_real_escape_string( $_POST["saturday"] );
$sql = "SELECT * FROM workers WHERE (project='$title')";
$res = mysql_query($sql);

$timesheets = array(); 
    while($worker = mysql_fetch_assoc($res)) {
        $workername = $worker['worker'];
        $sql1 = "SELECT day, hour FROM timesheets WHERE (username='$workername' AND project='$title' AND day BETWEEN '$sunday' AND '$saturday')";
        $res1 = mysql_query($sql1);
        $sheet = array(
                "workername" => $workername,
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
        "message" => "This project is not available yet"
    ));
    exit();
}


?>