<!DOCTYPE html>

<?php
include_once('database.php');

session_start();
$username = $_SESSION['user'];
echo "Welcome back".$username;

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>My TimeSheet</title>
    <!-- Bootstrap 
    <link href="bootstrap.min.css" rel="stylesheet" media="screen">
    -->
    <script src="//cdn.sencha.io/ext-4.2.0-gpl/ext.js"></script>
    <script src="jquery.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script type="text/javascript" src="calendarHelper.js"></script>
    <script type="text/javascript" src="displayProjects.js"></script>
    
</head>
<body>
  <form action="logout.php" method="post" id="logout" >
    <input type="submit" value="Logout">
 </form>


  <div id="allProjects">
    
  </div>
  
  <div id="signedProjects">
    <br>
    <button id="prev_week_btn">previous</button>
    <span id="currentWeek"></span>
    <button id="next_week_btn">next</button>
    <table id="timesheet_table">
      <tr>
		<td >Project Title</td>
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

<p id="message"></p>
<p id="hours"></p>






 
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    

</body>
</html>