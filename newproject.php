<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create Project</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>

<body>
    <h1>Create Project</h1>
        <form action="" method="post" id="myForm">
            <input type="submit" value="Back to Main Page" name="back"><br>
            ProjectName:<input type="text" name="projectname" id="project_name"/><br>
            StartDate:  <input type="text" name="startdate" id="datepicker1"/>
            EndDate:    <input type="text" name="enddate" id="datepicker2"/><br>
            Description:<br>
            <textarea id="textarea" name="description" cols="50" rows="4"></textarea><br>
            <input type="submit" value="Post" id="submit" name="create">
        </form>
    <?php
        include_once('database.php');
        session_start();
        $username=$_SESSION['user'];
        $name = $_POST['projectname'];
        $start_date = $_POST['startdate'];
        $end_date = $_POST['enddate'];
        $description = $_POST['description'];
        if(isset($_POST['create'])){
            if($name!==null&&$start_date!==null&&$end_date!==null&&$description!==null){
        if(mysql_query("INSERT INTO projects VALUES('','$username','$name','$start_date','$end_date','$description')"))
            echo "success";
        else
            echo "failed";
        }
        else echo "Please complete the form!";
        }
        if(isset($_POST['back'])){
            header("Location:manager_index.php"); 
        }
?>
    <script>
        $( "#datepicker1" ).datepicker({dateFormat:"yy-mm-dd"});
        $("#datepicker1").datepicker("option","dateFormat","yy-mm-dd");
        $( "#datepicker2" ).datepicker({dateFormat:"yy-mm-dd"});
        $("#datepicker2").datepicker("option","dateFormat","yy-mm-dd");
    </script>

</body>
</html>