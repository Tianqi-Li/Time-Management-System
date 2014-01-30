<?php
include_once('database.php');
if(isset($_GET['del']))
{
    $id=$_GET['del'];
    $res=mysql_query("SELECT * FROM projects WHERE id=$id");
    $row = mysql_fetch_array($res);
    if($row) {
        $title = $row['title'];
        // Delete project from TABLE projects
        $sql1="DELETE FROM projects WHERE id='$id'";
        $res1=mysql_query($sql1) or die("Failed".mysql_error());
        // Delete project from TABLE workers
        $res2=mysql_query("SELECT * FROM workers WHERE project=$title");
        while($row2 = mysql_fetch_assoc($res2)) {
            if($row2) {
            mysql_query("DELETE FROM workers WHERE project=$title") or die("Failed".mysql_error());
            }
        }
        // Delete project from TABLE timesheets
        $res4=mysql_query("SELECT * FROM timesheets WHERE project=$title");
            while($row3 = mysql_fetch_array($res4)) {
            if($row3) {
            mysql_query("DELETE FROM timesheets WHERE project=$title") or die("Failed".mysql_error());
            }
        }
        header("Location:manager_index.php");
    }   
    
}
?>