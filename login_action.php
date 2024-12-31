<?php
include 'connection.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT u.*, r.name AS role_name FROM user u 
          JOIN Role r ON u.role_id = r.id 
          WHERE u.username = :username LIMIT 1";
$stmt = $PDO->prepare($query);  
$stmt->bindParam(':username', $username);
$stmt->execute();

$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['username'];
    $_SESSION['role'] = $user['role_name'];  
    
    if ($user['role_name'] === 'Admin') {  
        header('Location: dashboard.php');
        exit();
    } else {
        echo "You do not have admin privileges.";
    }
} else {
    echo "Invalid username or password.";
}
?>
