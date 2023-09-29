<?php
include('../core/validation.php');
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validate username
    if (!requiredVal($username)) {
        header('Location: ../register.php');
        exit;
    } elseif (!maxVal($username, 30)) { 
        header('Location: ../register.php');
        exit;
    }

    // Validate password 
    if (!minVal($password,8)) {
        header('Location: ../register.php');
        exit;
    }

    // Validate email
    if (!requiredVal($email)) {
        header('Location: ../register.php');
        exit;
    } elseif (!emailVal($email)) {
        header('Location: ../register.php');
        exit;
    }

    // Check if username or email already exists in the database
    $Stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $Stmt->bind_param("ss", $username, $email);
    $Stmt->execute();
    $Stmt->store_result();

    if ($Stmt->num_rows > 0) {
        echo "Username or email already exists.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $insertStmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($insertStmt->execute()) {
            header('Location: ../login.php');
            exit;
        } else {
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $Stmt->close();
    $conn->close();
}
?>