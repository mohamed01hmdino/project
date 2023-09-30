<!DOCTYPE html>
<?php  session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: welcome.php');
  exit;
}
 ?>
<?php include 'inc/footer.php' ; ?>
<?php include 'inc/header.php' ; ?>
<?php include 'inc/nav.php' ; ?>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="container">
    <h2>Register</h2>
    <form id="registerForm" action="handler/Handleregister.php" method="post">
    <?php
  if (isset($_SESSION['error_message'])) {
    echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Clear the error message after displaying
  }
?>
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="password" name="confirmPassword" placeholder="Confirm Password" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
  </div>

  <script src="js/reg_script.js"></script>
</body>
</html>