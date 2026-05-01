<?php
$host = 'localhost';
$db = 'dbmsproject';
$user = 'root';
$pass = '';
$port = 3307; // update to your port

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>