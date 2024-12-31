<?php
include 'db_connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required!";
        exit;
    }

    if ($password != $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $email]);
    if ($stmt->rowCount() > 0) {
        echo "Username or email already exists.";
        exit;
    }

    $query = "INSERT INTO users (username, fullname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $fullname, $email, $hashed_password]);

    $_SESSION['username'] = $username;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['email'] = $email;

    header("Location: login.php");
    exit;
}
?>
