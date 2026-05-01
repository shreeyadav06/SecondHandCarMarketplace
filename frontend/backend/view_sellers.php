<?php
include 'db.php';

$query = "SELECT SellerID, Name, Contact, Address FROM Sellers";
$result = mysqli_query($conn, $query);

$sellers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $sellers[] = $row;
}
echo json_encode($sellers);
?>
