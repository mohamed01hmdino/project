<?php 
include('../core/validation.php');
include('db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password ,email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $dbUsername, $dbPassword ,$dbemail);

    if ($stmt->fetch() && password_verify($password, $dbPassword)) {
        session_start();
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $dbUsername;
        $_SESSION['email'] = $dbemail;

        header('Location: ../welcome.php');
    } else {
        $_SESSION['error_login'] = 'Invalid login credentials.';
        header("location:../login.php");
    }

    $stmt->close();
    $conn->close();
}

