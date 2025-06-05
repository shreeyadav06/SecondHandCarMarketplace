<?php
include 'db.php';

$query = "SELECT CarID, SellerID, Brand, Model, Year, Price, CarType, CarCondition, Mileage, Horsepower, Transmission, CarImage, Status FROM Cars";
$result = $conn->query($query);

$cars = [];
while ($row = $result->fetch_assoc()) {
    $cars[] = $row;
}
echo json_encode($cars);
$conn->close();
?>
