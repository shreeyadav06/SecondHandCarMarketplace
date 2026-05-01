<?php
header('Content-Type: application/json');
include 'db.php';

$brand = $_POST['brand'] ?? '';
$model = $_POST['model'] ?? '';
$year = $_POST['year'] ?? '';
$price = $_POST['price'] ?? '';
$car_type = $_POST['car_type'] ?? '';
$car_condition = $_POST['car_condition'] ?? '';
$mileage = $_POST['mileage'] ?? '';
$horsepower = $_POST['horsepower'] ?? '';
$transmission = $_POST['transmission'] ?? '';
$seller_id = $_POST['seller_id'] ?? '';
$status = $_POST['status'] ?? '';

// Handle image upload
$carImage = '';
if (isset($_FILES['car_image']) && $_FILES['car_image']['error'] == 0) {
    $targetDir = "../../images/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $carImage = uniqid() . '_' . basename($_FILES["car_image"]["name"]);
    $targetFile = $targetDir . $carImage;
    if (!move_uploaded_file($_FILES["car_image"]["tmp_name"], $targetFile)) {
        echo json_encode(['success' => false, 'message' => 'Image upload failed.']);
        exit;
    }
}

$sql = "INSERT INTO Cars (Brand, Model, Year, Price, CarType, CarCondition, Mileage, Horsepower, Transmission, CarImage, SellerID, Status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssidsisissis",
    $brand, $model, $year, $price, $car_type, $car_condition, $mileage, $horsepower, $transmission, $carImage, $seller_id, $status
);

if ($stmt->execute()) {
    $car_id = $conn->insert_id;
    echo json_encode(['success' => true, 'car_id' => $car_id]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}
$stmt->close();
$conn->close();
?>
