<?php
include "../../config/db.php";
header('Content-Type: application/json');

$result = $conn->query("
    SELECT b.booking_id, g.guest_name, g.email, g.phone, r.room_type, r.price,
           b.check_in, b.check_out, b.status
    FROM bookings b
    JOIN guests g ON b.guest_id = g.guest_id
    JOIN rooms  r ON b.room_id  = r.room_id
    ORDER BY b.booking_id DESC
");

$rows = [];
while ($row = $result->fetch_assoc()) $rows[] = $row;
echo json_encode($rows);
