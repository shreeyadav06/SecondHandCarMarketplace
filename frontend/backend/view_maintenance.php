<?php
include 'db.php';

$car_id = isset($_GET['car_id']) ? intval($_GET['car_id']) : 0;

if ($car_id > 0) {
    $query = "SELECT ServiceDate, Description, Cost, MechanicName, ServiceBill, CarRegistration FROM MaintenanceRecords WHERE CarID = $car_id";
} else {
    $query = "SELECT ServiceDate, Description, Cost, MechanicName, ServiceBill, CarRegistration FROM MaintenanceRecords";
}
$result = mysqli_query($conn, $query);

$records = [];
while ($row = mysqli_fetch_assoc($result)) {
    $records[] = $row;
}
echo json_encode($records);
?>
