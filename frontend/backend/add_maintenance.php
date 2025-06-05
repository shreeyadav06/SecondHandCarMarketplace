<?php
include 'db.php';

// Get POST data
$car_id = $_POST['car_id'];
$service_date = $_POST['service_date'];
$description = $_POST['description'];
$cost = $_POST['cost'];
$mechanic = $_POST['mechanic_name'];

// Handle file uploads
$serviceBillFile = '';
$carRegistrationFile = '';
$uploadDir = "../../uploads/maintenance/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Service Bill
if (isset($_FILES['service_bill']) && $_FILES['service_bill']['error'] == 0) {
    $serviceBillFile = uniqid('bill_') . '_' . basename($_FILES['service_bill']['name']);
    move_uploaded_file($_FILES['service_bill']['tmp_name'], $uploadDir . $serviceBillFile);
}

// Car Registration
if (isset($_FILES['car_registration']) && $_FILES['car_registration']['error'] == 0) {
    $carRegistrationFile = uniqid('reg_') . '_' . basename($_FILES['car_registration']['name']);
    move_uploaded_file($_FILES['car_registration']['tmp_name'], $uploadDir . $carRegistrationFile);
}

// Validate that the car exists in the cars table
$car_sql = "SELECT CarID FROM cars WHERE CarID = '$car_id'";
$car_result = $conn->query($car_sql);

if ($car_result->num_rows == 0) {
    die("Invalid Car ID. No such car exists.");
}

// Insert maintenance record
$sql = "INSERT INTO MaintenanceRecords 
    (CarID, ServiceDate, Description, Cost, MechanicName, ServiceBill, CarRegistration) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issdsss",
    $car_id, $service_date, $description, $cost, $mechanic, $serviceBillFile, $carRegistrationFile
);

if ($stmt->execute()) {
    echo "Maintenance record added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
