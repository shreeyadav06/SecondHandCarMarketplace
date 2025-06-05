<?php
include 'db.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$role = trim($_POST['role']);

if (!$username || !$password || !$role) {
    header("Location: ../login.html?error=emptyfields");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
$stmt->bind_param("ss", $username, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        // Redirect based on role
        if ($role === 'admin') {
            header("Location: ../admin_dashboard.html?success=admin");
            exit();
        } elseif ($role === 'customer') {
            header("Location: ../customer_dashboard.html?success=customer");
            exit();
        } elseif ($role === 'seller') {
            header("Location: ../seller_dashboard.html?success=seller");
            exit();
        } else {
            header("Location: ../index.html");
            exit();
        }
    } else {
        header("Location: ../login.html?error=wrongpass");
        exit();
    }
} else {
    header("Location: ../login.html?error=nouser");
    exit();
}
?>