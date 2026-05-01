<?php
include 'db.php';

// Updated query to join the bookings table with customers and cars tables to get the customer name and car name
$query = "
    SELECT 
        b.bookingId, 
        c.name AS customer_name, 
        ca.name AS car_name, 
        b.pickup AS pickup_datetime, 
        b.dropoff AS dropoff_datetime
    FROM 
        bookings b
    JOIN 
        customers c ON b.customer_id = c.customer_id
    JOIN 
        cars ca ON b.car_id = ca.car_id
";

$result = mysqli_query($conn, $query);

$bookings = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}

echo json_encode($bookings);
?>
