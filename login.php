<!DOCTYPE html>
<?php include 'inc/footer.php' ; ?>
<?php include 'inc/header.php' ; ?>
<?php include 'inc/nav.php' ; ?>
<?php  session_start(); ?>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form id="loginForm" action="handler/Handlelogin.php" method="post">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
  </div>

  <script src="js/login_script.js"></script>
</body>
</html>