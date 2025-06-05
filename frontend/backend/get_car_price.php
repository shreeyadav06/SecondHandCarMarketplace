<?php

include 'db.php';
$car_id = intval($_GET['car_id']);
$result = $conn->query("SELECT Price FROM Cars WHERE CarID = $car_id");
$row = $result->fetch_assoc();
echo json_encode(['price' => $row ? $row['Price'] : null]);
$conn->close();
?>