<!DOCTYPE html>
<?php
    //require database
    require 'timedata.php';
    session_start();
?>

<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <title>My Timesheet </title>
</head>

<body>   
<div class="container">

<p class="lead">Today is <?php
$mydate=getdate(date("U"));
echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
?></p>
<p id="display_current_week"></p>

<?php
     if(isset($_SESSION['project_name'])){
        printf("<h2>You joined project: %s </h2>", htmlentities($_SESSION['project_name']));
        printf("<p>You can create and edit your timesheet now</p>");

    }
    else{
        printf("<h2>You don't have a project yet</h2>");
        printf("<form name='project_direct' method='POST' action='project_view.php'>
                <input type='submit' value='View Projects'>
                </form>
             ");
    }
?>


<div class="row">
    <tr class="success">
        <p id="week_period"></p>
    </tr>
</div>

<table class="table table-striped">
    <tr>
    <th>checkbox</th>
    <th>Number</th>
    <th>Project</th>
    <th>Sunday</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
    <th>Total</th>
    <th>Submit</th>
    </tr>
    <tr id="row1">
    <td><intput type="checkbox"></td>
    <td>1</td>
    <td>Project1</td>
    <form name="submit_time" method="post">
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td id="total_hours"></td>
    <td><input type="submit" class="btn" value="Submit" action="timesheet.php"></td>
    </form>

    </tr>
    <tr id="row2">
    <td><intput type="checkbox"></td>
    <td>2</td>
    <td>Project2</td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td><input class="form-control" id="focusedInput" type="text" style="width:100px"></td>
    <td id="total_hours"></td>
    <td><input type="submit" class="btn" value="Submit" action="timesheet.php"></td>
    </tr>
</table>
</div>
<?php 
?>
    <script type="text/javascript" src="calendarHelper.js"></script>
    <script type="text/javascript" src="fetch_time.js"></script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="css/bootstrap.min.js"></script>
</body>
</html>
