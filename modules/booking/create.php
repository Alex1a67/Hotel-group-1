<?php
include "../../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../index.php?page=booking");
    exit();
}

/* ── Sanitise inputs ── */
$guest_name = ucwords(strtolower(trim($conn->real_escape_string($_POST['guest_name']))));
$email      = strtolower(trim($conn->real_escape_string($_POST['email'])));
$phone      = trim($conn->real_escape_string($_POST['phone']));
$room_id    = (int)$_POST['room_id'];

/* ── Check real availability: total_rooms minus active bookings ── */
$checkQ = $conn->query("
    SELECT
        r.room_id,
        r.room_type,
        r.total_rooms,
        COUNT(b.booking_id) AS occupied
    FROM rooms r
    LEFT JOIN bookings b ON b.room_id = r.room_id AND b.status = 'Checked In'
    WHERE r.room_id = $room_id
    GROUP BY r.room_id
");

if (!$checkQ || $checkQ->num_rows === 0) {
    header("Location: ../../index.php?page=booking&msg=Room+not+found&type=error");
    exit();
}

$roomData  = $checkQ->fetch_assoc();
$realAvail = (int)$roomData['total_rooms'] - (int)$roomData['occupied'];

if ($realAvail <= 0) {
    header("Location: ../../index.php?page=booking&msg=Sorry,+that+room+type+is+fully+booked&type=error");
    exit();
}

/* ── Start transaction ── */
$conn->begin_transaction();

try {
    /* 1. Insert guest */
    $conn->query("
        INSERT INTO guests (guest_name, email, phone)
        VALUES ('$guest_name', '$email', '$phone')
    ");
    $guest_id = $conn->insert_id;

    /* 2. Insert booking */
    $conn->query("
        INSERT INTO bookings (guest_id, room_id, check_in, status)
        VALUES ($guest_id, $room_id, NOW(), 'Checked In')
    ");

    /* 3. Sync available_rooms = total_rooms - active bookings */
    $conn->query("
        UPDATE rooms r
        SET r.available_rooms = r.total_rooms - (
            SELECT COUNT(*) FROM bookings b
            WHERE b.room_id = r.room_id AND b.status = 'Checked In'
        )
        WHERE r.room_id = $room_id
    ");

    $conn->commit();

    header("Location: ../../index.php?page=booking&msg=Guest+checked+in+successfully&type=success");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    header("Location: ../../index.php?page=booking&msg=Error+creating+booking&type=error");
    exit();
}
?>
