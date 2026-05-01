<?php
session_start();
include 'db.php';

$name = $_POST['name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$address = $_POST['address'];

// Directly insert seller, no OTP check
$sql = "INSERT INTO Sellers (Name, Contact, Email, Address) VALUES ('$name', '$contact', '$email', '$address')";
if ($conn->query($sql) === TRUE) {
    header("Location: ../seller_dashboard.html?success=seller_added");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
