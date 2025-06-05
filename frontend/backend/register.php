<?php
include 'db.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$role = trim($_POST['role']);

if (!$username || !$password || !$role) {
    header("Location: ../register.html?error=emptyfields");
    exit();
}

// Check if user already exists
$check = $conn->prepare("SELECT * FROM users WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$result = $check->get_result();
if ($result->num_rows > 0) {
    header("Location: ../register.html?error=exists");
    exit();
}
if (strlen($password) < 6) {
    header("Location: ../register.html?error=weakpass");
    exit();
}
// Hash the password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed, $role);

if ($stmt->execute()) {
    header("Location: ../login.html?success=registered");
    exit();
} else {
    header("Location: ../register.html?error=failed");
    exit();
}
?>