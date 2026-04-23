<?php
include "../../config/db.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../index.php?page=booking"); exit();
}
$id     = (int)$_POST['booking_id'];
$status = $conn->real_escape_string($_POST['status']);
$conn->query("UPDATE bookings SET status='$status' WHERE booking_id=$id");
header("Location: ../../index.php?page=booking&msg=Booking+updated&type=success");
exit();
