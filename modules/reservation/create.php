<?php
include "../../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../index.php?page=reserved");
    exit();
}

$guest_name       = ucwords(strtolower(trim($conn->real_escape_string($_POST['guest_name']))));
$email            = strtolower(trim($conn->real_escape_string($_POST['email'])));
$phone            = trim($conn->real_escape_string($_POST['phone']));
$room_id          = (int)$_POST['room_id'];
$expected_checkin = !empty($_POST['expected_checkin'])
    ? $conn->real_escape_string($_POST['expected_checkin'])
    : null;

$roomQ = $conn->query("SELECT room_id FROM rooms WHERE room_id=$room_id");
if (!$roomQ || $roomQ->num_rows === 0) {
    header("Location: ../../index.php?page=reserved&msg=Invalid+room&type=error");
    exit();
}

$conn->begin_transaction();
try {
    /* Insert guest */
    $conn->query("INSERT INTO guests (guest_name, email, phone) VALUES ('$guest_name','$email','$phone')");
    $guest_id = $conn->insert_id;

    /* Insert reservation */
    $ecVal = $expected_checkin ? "'$expected_checkin'" : 'NULL';
    $conn->query("
        INSERT INTO reservations (guest_id, room_id, reserve_date, expected_checkin, status)
        VALUES ($guest_id, $room_id, CURDATE(), $ecVal, 'Pending')
    ");

    $conn->commit();
    header("Location: ../../index.php?page=reserved&msg=Reservation+created+successfully&type=success");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    header("Location: ../../index.php?page=reserved&msg=Error+creating+reservation&type=error");
    exit();
}
?>
