<?php
include 'db.php';

$carID = $_POST['carID'];
$customerID = $_POST['customerID'];
$date = $_POST['date'];
$totalAmount = $_POST['amount'];

// get seller ID from car
$sellerQuery = $conn->query("SELECT SellerID FROM Cars WHERE CarID = $carID");
$row = $sellerQuery->fetch_assoc();
$sellerID = $row['SellerID'];

$sql = "INSERT INTO Transactions (CarID, CustomerID, SellerID, Date, TotalAmount) VALUES ('$carID', '$customerID', '$sellerID', '$date', '$totalAmount')";
if ($conn->query($sql) === TRUE) {
    echo "Transaction added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>