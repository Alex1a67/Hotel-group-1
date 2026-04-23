<?php include "config/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'booking':
        include "pages/booking.php";
        break;
    case 'reserved':
        include "pages/reserved.php";
        break;
    case 'rooms':
        include "pages/rooms.php";
        break;
    case 'membership':
        include "pages/membership.php";
        break;
    case 'data_center':
        include "pages/data_center.php";
        break;
    default:
        include "pages/home.php";
}
?>

<?php include "includes/footer.php"; ?>
