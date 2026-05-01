<?php
include 'db.php';

$query = "SELECT CustomerID, Name, Contact, Email FROM Customers";
$result = mysqli_query($conn, $query);

$customers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $customers[] = $row;
}
echo json_encode($customers);
?>
