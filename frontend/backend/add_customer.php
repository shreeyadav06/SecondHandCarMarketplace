<?php
include 'db.php';

$name = $_POST['name'];
$contact = $_POST['contact'];
$email = $_POST['email'];

$sql = "INSERT INTO Customers (Name, Contact, Email) VALUES ('$name', '$contact', '$email')";
if ($conn->query($sql) === TRUE) {
    header("Location: ../admin_dashboard.html?success=customer_added");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>