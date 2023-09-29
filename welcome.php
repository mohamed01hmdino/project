<!DOCTYPE html>
<?php include 'inc/footer.php' ; ?>
<?php include 'inc/header.php' ; ?>
<?php include 'inc/nav.php' ; ?>
<?php
 session_start(); 
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $id = $_SESSION ['user_id'];
    $email = $_SESSION ['email'];
} else {
    header('Location: login.php');
    exit;}

?>
<?php  include 'handler/Handlelogin.php'; ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/welcome_style.css">
    <title>Welcome</title>
</head>
<body>
    <div class="container">
    <h1>Welcome</h1>
    <p>You're username is : <?php echo $username; ?></p>
    <p>You're id is : <?php echo $id; ?></p>
    <p>You're email is : <?php echo $email; ?></p>
    <p><a href="handler/Handlelogout.php">Logout</a></p>
</body>
</html>