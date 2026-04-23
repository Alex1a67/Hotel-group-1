<?php
include "../../config/db.php";
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../../index.php?page=booking&msg=Invalid+ID&type=error"); exit();
}
$id = (int)$_GET['id'];
// Get room_id first to restore availability if still checked in
$q = $conn->query("SELECT room_id, status FROM bookings WHERE booking_id=$id");
if ($q && $q->num_rows > 0) {
    $r = $q->fetch_assoc();
    if ($r['status'] === 'Checked In') {
        $conn->query("UPDATE rooms SET available_rooms=available_rooms+1 WHERE room_id={$r['room_id']}");
    }
    $conn->query("DELETE FROM payments WHERE booking_id=$id");
    $conn->query("DELETE FROM bookings WHERE booking_id=$id");
}
header("Location: ../../index.php?page=booking&msg=Booking+deleted&type=success");
exit();
