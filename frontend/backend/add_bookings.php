<?php
include 'db.php';

$customer_id = $_POST['customer_id'];
$car_id = $_POST['car_id'];
$contact = $_POST['contact'];
$aadhar = $_POST['aadhar'];
$address = $_POST['address'];
$license = $_POST['license'];
$validity = $_POST['validity'];
$buying_date = $_POST['buying_date'];

// Insert booking
$sql = "INSERT INTO bookings (customer_id, car_id, contact, aadhar, address, license, validity, buying_date)
        VALUES ('$customer_id', '$car_id', '$contact', '$aadhar', '$address', '$license', '$validity', '$buying_date')";

if ($conn->query($sql) === TRUE) {
    $booking_id = $conn->insert_id;
    header("Location: ../payment.html?booking_id=$booking_id&car_id=$car_id");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
