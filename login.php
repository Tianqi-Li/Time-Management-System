
<?php // login.php
include_once('database.php');
require_once 'openid.php';
$openid = new LightOpenID("ec2-54-200-25-58.us-west-2.compute.amazonaws.com");

if ($openid->mode) {
    if ($openid->mode == 'cancel') {
        echo "User has canceled authentication!";
    } elseif($openid->validate()) {
        $data = $openid->getAttributes();
        $id = $openid ->identity;
        $email = $data['contact/email'];
        $first = $data['namePerson/first'];
        $sql = "SELECT * FROM users WHERE (openid='$id')";
        $res = mysql_query($sql);
        $row = mysql_fetch_array($res);
        if($row) {
            $username = $row['username'];
            $category = $row['category'];
            session_start();
            $_SESSION['user'] = $username;
            echo "Welcome back".$username." you are ".$category;
            if($category === "worker") {
                header("Location:project_view.php");
                exit();
            } else {
                header("Location:manager_index.php");
                exit();
            }
            
        } else {
                echo "Identity: $openid->identity <br>";
                echo "Email: $email <br>";
                echo "First name: $first";
                echo '<br>';
                echo '<form action = "newUser.php" method = "POST">';
                echo '<input type ="hidden" name = "openid" value = "'.$id.'" >';
                echo '<input type ="text" name = "username" value = "username" maxlength="30">';
                echo '<input type ="hidden" name = "email" value = "'.$email.'" >';
                echo '<select name="category">';
                echo '<option selected>Choose your category</option>';
                echo '<option value="manager">Manager</option>';
                echo '<option value="worker">Worker</option>';
                echo '</select>';
                echo '<input type = "submit" value = "Create New Account">';
                echo '</form>';
            }
        }
        
     else {
        echo "The user has not logged in";
    }
} else {
    echo "Go to index page to log in.";
}
?>
