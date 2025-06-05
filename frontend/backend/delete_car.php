<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $car_id = $_GET['car_id'];

    // Delete the car from the database
    $sql = "DELETE FROM cars WHERE CarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $car_id);
    if ($stmt->execute()) {
        header('Location: ../admin_dashboard.html?success=car_deleted');
    } else {
        echo "Error deleting car.";
    }
    $stmt->close();
}
?>
