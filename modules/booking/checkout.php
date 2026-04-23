<?php
include "../../config/db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../../index.php?page=booking&msg=Invalid+booking+ID&type=error");
    exit();
}

$booking_id = (int)$_GET['id'];

/* ── Fetch booking details ── */
$detailQ = $conn->query("
    SELECT
        b.booking_id,
        b.check_in,
        b.status,
        b.room_id,
        g.guest_name,
        g.guest_id,
        r.room_type,
        r.price
    FROM bookings b
    JOIN guests g ON b.guest_id = g.guest_id
    JOIN rooms  r ON b.room_id  = r.room_id
    WHERE b.booking_id = $booking_id
");

if (!$detailQ || $detailQ->num_rows === 0) {
    header("Location: ../../index.php?page=booking&msg=Booking+not+found&type=error");
    exit();
}

$row = $detailQ->fetch_assoc();

/* Guard: already checked out */
if ($row['status'] === 'Checked Out') {
    header("Location: ../../index.php?page=booking&msg=Guest+already+checked+out&type=error");
    exit();
}

/* ── Calculate nights & total ── */
$checkIn   = new DateTime($row['check_in']);
$checkOut  = new DateTime();                  // NOW
$diffDays  = (int)$checkIn->diff($checkOut)->days;
$nights    = max(1, $diffDays);               // minimum 1 night
$totalCost = $nights * (int)$row['price'];

$checkOutStr  = $checkOut->format('Y-m-d H:i:s');
$guestName    = $conn->real_escape_string($row['guest_name']);
$roomType     = $conn->real_escape_string($row['room_type']);
$checkInStr   = $conn->real_escape_string($row['check_in']);
$room_id      = (int)$row['room_id'];

/* ── Transaction ── */
$conn->begin_transaction();

try {
    /* 1. Update booking status & check-out time */
    $conn->query("
        UPDATE bookings
        SET status = 'Checked Out', check_out = '$checkOutStr'
        WHERE booking_id = $booking_id
    ");

    /* 2. Insert payment record */
    $conn->query("
        INSERT INTO payments (booking_id, amount, nights, method)
        VALUES ($booking_id, $totalCost, $nights, 'Cash')
    ");

    /* 3. Sync available_rooms = total_rooms - active bookings (after status update above) */
    $conn->query("
        UPDATE rooms r
        SET r.available_rooms = r.total_rooms - (
            SELECT COUNT(*) FROM bookings b
            WHERE b.room_id = r.room_id AND b.status = 'Checked In'
        )
        WHERE r.room_id = $room_id
    ");

    $conn->commit();

    $msg = urlencode("Check-out complete. {$row['guest_name']} — $nights night(s) — Rp " . number_format($totalCost));
    header("Location: ../../index.php?page=booking&msg=$msg&type=success");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    header("Location: ../../index.php?page=booking&msg=Error+during+checkout&type=error");
    exit();
}
?>
