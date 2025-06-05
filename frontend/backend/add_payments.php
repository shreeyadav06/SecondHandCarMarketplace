<?php
include 'db.php';

$booking_id = $_POST['booking_id'];
$amount = $_POST['amount'];
$payment_date = $_POST['payment_date'];

// Adjust the table/fields as per your schema
$sql = "INSERT INTO Payments (BookingID, Amount, PaymentDate) VALUES ('$booking_id', '$amount', '$payment_date')";
if ($conn->query($sql) === TRUE) {
    header("Location: ../customer_dashboard.html?success=payment_done");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>