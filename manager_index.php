<!DOCTYPE html>

<?php
include_once('database.php');
session_start();
$username = $_SESSION['user'];
?>

<html>
<head>
    <title>Manager Index</title>
    <script src="//cdn.sencha.io/ext-4.2.0-gpl/ext.js"></script>
    <script src="jquery.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script type="text/javascript" src="checkEmail.js"></script>
</head>

<body>
<h1>Main Page</h1>

<form action="logout.php" method="post" id="logout" >
    <input type="submit" value="Logout">
 </form>

<form action="newproject.php" method="post" id="createProject">
    <input type="submit" value="Create Project" id="submit">
</form>

<div id="allProjects">
</div>


<?php

    echo "<ul>";
    $sql="select * from projects where manager='$username'";
    $qury=mysql_query("$sql");
    while($row=mysql_fetch_array($qury))
        echo "<li><a href=/~TianqiFor330/detail_edit.php?detail=$row[id]><p>$row[title]</p></a>
                <a href=/~TianqiFor330/delete.php?del=$row[id]><p>delete</p></a></li>";
    echo "</ul>";
    
?> 
</body>
</html>