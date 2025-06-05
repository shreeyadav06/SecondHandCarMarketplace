<?php
require_once 'db.php';
header('Content-Type: application/json');
$result = $conn->query("SELECT * FROM cars"); // <-- lowercase
$cars = [];
while ($row = $result->fetch_assoc()) {
    $cars[] = $row;
}
echo json_encode($cars);
?>