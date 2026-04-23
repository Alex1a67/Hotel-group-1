<?php $currentPage = $_GET['page'] ?? 'home'; ?>
<link rel="stylesheet" href="assets/css/navbar.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">

<header class="nav-wrap">
  <div class="nav-container">

   <div class="nav-logo">
    <a href="about.php" class="logo-link" style="display:flex;align-items:center;gap:12px;">
      <img src="assets/img/logo.png" alt="YFW Haven Grand" class="logo-img">
      <span class="logo-text">YFW Haven Grand</span>
    </a>
  </div>

    <nav class="nav-menu" id="navMenu">
      <a href="index.php?page=home"        class="<?= $currentPage=='home'        ? 'active' : '' ?>">Portal</a>
      <a href="index.php?page=booking"     class="<?= $currentPage=='booking'     ? 'active' : '' ?>">Booking</a>
      <a href="index.php?page=reserved"    class="<?= $currentPage=='reserved'    ? 'active' : '' ?>">Reservations</a>
      <a href="index.php?page=rooms"       class="<?= $currentPage=='rooms'       ? 'active' : '' ?>">Rooms</a>
      <a href="index.php?page=membership"  class="<?= $currentPage=='membership'  ? 'active' : '' ?>">Check Logs</a>
      <a href="index.php?page=data_center" class="<?= $currentPage=='data_center' ? 'active' : '' ?>">Data Center</a>
    </nav>

    <div class="nav-cta">
      <a href="index.php?page=booking" class="btn-book">Book Now</a>
    </div>

    <div class="nav-toggle" id="navToggle" onclick="document.getElementById('navMenu').classList.toggle('open')">
      <span></span><span></span><span></span>
    </div>

  </div>
</header>
