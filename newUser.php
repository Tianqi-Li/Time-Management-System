
<?php

include_once('database.php');
$id = mysql_real_escape_string( $_POST["openid"] );
$username = mysql_real_escape_string( $_POST["username"] );
$category = mysql_real_escape_string( $_POST["category"] );
$email = mysql_real_escape_string( $_POST["email"] );
    
                   
    $sql = "INSERT INTO users (openid, username, email, category) VALUES('$id', '$username', '$email', '$category');";
    
    $result = mysql_query($sql);
    
    if( $result ) {
        $sql1 = "INSERT INTO emails (username, email, signup_email) VALUES('$username', '$email', 'false');";
        $result1 = mysql_query($sql1);
        session_start();
	$_SESSION['user'] = $username;
        if($category === "manager") {
            header("Location:manager_index.php");
            exit();
        } else {
            header("Location:project_view.php");
            exit();
        }
 
	//echo "Welcome ". $username. ". Now choose your project";
    }
?>

