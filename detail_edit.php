<!DOCTYPE html>

<html>
<head>
    <title>Project Index</title>
    <script src="//cdn.sencha.io/ext-4.2.0-gpl/ext.js"></script>
    <script src="jquery.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script type="text/javascript" src="calendarHelper.js"></script>
    <script type="text/javascript" src="displayTimesheets.js"></script>
</head>

<body>
<h1>Project Details</h1>
<form action="manager_index.php" method="post" id="createProject">
    <input type="submit" value="Back to Main Page" id="submit"><br>
</form>

<?php
session_start();
include_once('database.php');
$username=$_SESSION['user'];

if(isset($_GET['detail'])) {
    $id=$_GET['detail'];
    $res=mysql_query("SELECT * FROM projects WHERE id=$id");
    $row = mysql_fetch_array($res);
    if($row) {
        $title = $row['title'];
        $_SESSION['project'] = $title;
    }   
}
?>
<p id="message"></p>
<div id="project">
    <br>
    <button id="prev_week_btn">previous</button>
    <span id="currentWeek"></span>
    <button id="next_week_btn">next</button>
    <table id="timesheet_table">
        <tr>
		<td >Worker Name</td>
                <td >Sunday</td>
		<td >Monday</td>
		<td >Tuesday</td>
		<td >Wednesday</td>
		<td >Thursday</td>
		<td >Friday</td>
		<td >Saturday</td>
	</tr>
    </table>
  </div>





</body>
</html>
