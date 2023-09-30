<?php
include('../core/validation.php');
include('db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_POST['email'];

   // Validate username
if (!requiredVal($username)) {
    $_SESSION['error_message'] = 'Username is required.';
} elseif (!maxVal($username, 30)) {
    $_SESSION['error_message'] = 'Username must be at most 30 characters.';
}

  // Validate password
  if (!minVal($password, 8)) {
    $_SESSION['error_message'] = 'Password must be at least 8 characters long.';
} elseif ($password !== $confirmPassword) { // Check if passwords match
    $_SESSION['error_message'] = 'Passwords do not match.';
}

// Validate email
if (!requiredVal($email)) {
    $_SESSION['error_message'] = 'Email is required.';
} elseif (!emailVal($email)) {
    $_SESSION['error_message'] = 'Invalid email format.';
}

// Check if username or email already exists in the database
$Stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$Stmt->bind_param("ss", $username, $email);
$Stmt->execute();
$Stmt->store_result();

if ($Stmt->num_rows > 0) {
    $_SESSION['error_message'] = 'Username or email already exists.';
}

if (isset($_SESSION['error_message'])) {
    header('Location: ../register.php');
    exit;
 
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