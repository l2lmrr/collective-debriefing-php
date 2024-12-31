<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'situation';

try {
    $PDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
