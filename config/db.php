<?php
// config/db.php
// Connects to the 'yfw' database.
// Import database/hotel.sql into MySQL/MariaDB first.

$conn = new mysqli("localhost", "root", "", "yfw");

if ($conn->connect_error) {
    die("<p style='color:red;text-align:center;margin-top:100px;'>
        <strong>Database Connection Failed:</strong> " . htmlspecialchars($conn->connect_error) . "
        <br><small>Make sure you imported database/hotel.sql and MySQL is running.</small>
    </p>");
}

$conn->set_charset("utf8mb4");
?>
