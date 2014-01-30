<!DOCTYPE html>

<html>
<head>
    <title>My Time Management</title>
    <link rel="stylesheet" type="text/css" href="signin.css" />
    <link rel="stylesheet" type="text/css" href="register.css" />
</head>

<body>
    
    <h2>Welcome to the Time Management System</h2>

<?php 
require_once 'openid.php';
$openid = new LightOpenID("ec2-54-200-25-58.us-west-2.compute.amazonaws.com");

$openid->identity = 'https://www.google.com/accounts/o8/id';
$openid->required = array(
  'namePerson/first',
  'namePerson/last',
  'contact/email',
);
$openid->returnUrl = 'http://ec2-54-200-25-58.us-west-2.compute.amazonaws.com/~TianqiFor330/login.php'
?>

<a class="btn-auth btn-google large" href="<?php echo $openid->authUrl() ?>">
    Sign in with <b>google</b>
</a>

</body>
</html>
