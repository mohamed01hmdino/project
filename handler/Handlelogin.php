<?php 
include('../core/validation.php');
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];

 // Validate username
 if (!requiredVal($username)) {
    header('Location: ../login.php');
    exit;
} elseif (!maxVal($username, 30)) { 
    header('Location: ../login.php');
    exit;
}

// Validate password 
if (!minVal($password,8)) {
    header('Location: ../login.php');
    exit;
}

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
        echo "Invalid login credentials.";
    }

    $stmt->close();
    $conn->close();
}

