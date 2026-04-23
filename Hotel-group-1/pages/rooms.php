<?php include "config/db.php"; ?>
<link rel="stylesheet" href="assets/css/dashboard.css">
<link rel="stylesheet" href="assets/css/main.css">

<style>
  body {
    background-color: black ;
    color: black; /* optional: makes text readable */
  }
</style>

<div class="page-wrap">

  <div class="page-header">
    <div class="page-eyebrow">Live Availability</div>
    <h1 class="page-title">Room <em>Inventory</em></h1>
  </div>

  <!-- Room Availability Cards -->
  <?php
  /*
   * Sync available_rooms from live bookings first.
   * This ensures the column is always accurate no matter what.
   */
  $conn->query("
    UPDATE rooms r
    SET r.available_rooms = r.total_rooms - (
        SELECT COUNT(*) FROM bookings b
        WHERE b.room_id = r.room_id AND b.status = 'Checked In'
    )
  ");

  /* Now read — active_bookings is a live subquery count */
  $roomsQ = $conn->query("
    SELECT
      r.room_id,
      r.room_type,
      r.price,
      r.total_rooms,
      r.available_rooms,
      (SELECT COUNT(*) FROM bookings b
       WHERE b.room_id = r.room_id AND b.status = 'Checked In') AS active_bookings
    FROM rooms r
    ORDER BY r.price ASC
  ");

  $roomImages = [
    1 => 'Amaris.webp',
    2 => 'SuitePresident.webp',
    3 => 'KamarPremierKing.webp',
    4 => 'Studiodouble30.webp',
    5 => 'Fpro.jpg',
    6 => 'Wpromax.jpg',
  ];
  ?>

  <!-- Summary stats -->
  <?php
  $totQ = $conn->query("
    SELECT
      SUM(r.total_rooms) AS t,
      SUM(
        r.total_rooms - (SELECT COUNT(*) FROM bookings b WHERE b.room_id = r.room_id AND b.status = 'Checked In')
      ) AS a
    FROM rooms r
  ");
  $tot  = $totQ->fetch_assoc();
  $occupied = $tot['t'] - $tot['a'];
  $pct = $tot['t'] > 0 ? round(($occupied/$tot['t'])*100) : 0;
  ?>
  <div class="stats-row" style="margin-bottom:40px;">
    <div class="stat-card">
      <div class="stat-label">Total Rooms</div>
      <div class="stat-value"><?= $tot['t'] ?></div>
      <div class="stat-sub">Across all types</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Available Now</div>
      <div class="stat-value gold"><?= $tot['a'] ?></div>
      <div class="stat-sub">Ready to book</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Occupied</div>
      <div class="stat-value"><?= $occupied ?></div>
      <div class="stat-sub">Guests checked in</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Occupancy Rate</div>
      <div class="stat-value gold"><?= $pct ?>%</div>
      <div class="stat-sub">Current fill rate</div>
    </div>
  </div>

  <!-- Rooms grid -->
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px;">
    <?php while ($rm = $roomsQ->fetch_assoc()):
      $available = (int)$rm['available_rooms'];
      $occupancy = $rm['total_rooms'] > 0
        ? round((($rm['total_rooms'] - $available) / $rm['total_rooms']) * 100)
        : 0;
      $imgFile = $roomImages[$rm['room_id']] ?? 'Amaris.webp';
      $isFull  = $available <= 0;
      $barColor = $occupancy >= 90 ? '#E74C3C' : ($occupancy >= 60 ? '#F5A623' : '#C9A84C');
    ?>
    <div class="luxury-card" style="overflow:hidden;">
      <!-- Room Image -->
      <div style="height:180px;overflow:hidden;position:relative;">
        <img src="assets/img/<?= urlencode($imgFile) ?>" alt="<?= htmlspecialchars($rm['room_type']) ?>"
             style="width:100%;height:100%;object-fit:cover;transition:transform .5s;" loading="lazy" onerror="this.style.display='none';this.parentElement.style.background='#1a1a2e'"
             onmouseover="this.style.transform='scale(1.05)'"
             onmouseout="this.style.transform='scale(1)'">
        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,10,10,.7) 0%,transparent 50%);"></div>
        <?php if ($isFull): ?>
        <div style="position:absolute;top:14px;right:14px;background:rgba(192,57,43,.9);color:#fff;font-size:9px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;padding:5px 12px;border-radius:20px;">FULLY BOOKED</div>
        <?php elseif ($available <= 2): ?>
        <div style="position:absolute;top:14px;right:14px;background:rgba(245,166,35,.9);color:#000;font-size:9px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;padding:5px 12px;border-radius:20px;">LAST <?= $available ?> LEFT</div>
        <?php endif; ?>
        <div style="position:absolute;bottom:14px;left:16px;">
          <div style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:400;color:#fff;"><?= htmlspecialchars($rm['room_type']) ?></div>
          <div style="font-size:11px;color:rgba(255,255,255,.6);letter-spacing:.08em;">Rp <?= number_format($rm['price']) ?> / night</div>
        </div>
      </div>

      <!-- Stats -->
      <div style="padding:20px 24px;">
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:18px;text-align:center;">
          <div>
            <div style="font-size:1.5rem;font-weight:400;color:var(--s);font-family:'Cormorant Garamond',serif;"><?= $rm['total_rooms'] ?></div>
            <div style="font-size:9.5px;text-transform:uppercase;letter-spacing:.15em;color:var(--text-muted);">Total</div>
          </div>
          <div>
            <div style="font-size:1.5rem;font-weight:400;color:var(--gold);font-family:'Cormorant Garamond',serif;"><?= $available ?></div>
            <div style="font-size:9.5px;text-transform:uppercase;letter-spacing:.15em;color:var(--text-muted);">Available</div>
          </div>
          <div>
            <div style="font-size:1.5rem;font-weight:400;color:var(--white);font-family:'Cormorant Garamond',serif;"><?= $rm['active_bookings'] ?></div>
            <div style="font-size:9.5px;text-transform:uppercase;letter-spacing:.15em;color:var(--text-muted);">Occupied</div>
          </div>
        </div>

        <!-- Occupancy bar -->
        <div style="margin-bottom:18px;">
          <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
            <span style="font-size:10px;letter-spacing:.12em;text-transform:uppercase;color:var(--text-muted);">Occupancy</span>
            <span style="font-size:11px;font-weight:700;color:<?= $barColor ?>;"><?= $occupancy ?>%</span>
          </div>
          <div style="background:var(--black-el);border-radius:4px;height:6px;overflow:hidden;">
            <div style="height:100%;width:<?= $occupancy ?>%;background:<?= $barColor ?>;border-radius:4px;transition:width .5s;"></div>
          </div>
        </div>

        <!-- Action -->
        <?php if (!$isFull): ?>
        <a href="index.php?page=booking" class="btn btn-gold" style="width:100%;justify-content:center;">
          Book This Room
        </a>
        <?php else: ?>
        <a href="index.php?page=reserved" class="btn btn-outline" style="width:100%;justify-content:center;">
          Reserve for Later
        </a>
        <?php endif; ?>
      </div>
    </div>
    <?php endwhile; ?>
  </div>

  <!-- Currently Occupied Rooms Table -->
  <div class="luxury-card section-gap">
    <div class="card-header">
      <div class="card-title">Currently <span>Occupied</span></div>
    </div>
    <div style="overflow-x:auto;">
      <table class="lux-table">
        <thead>
          <tr>
            <th>Room Type</th>
            <th>Guest Name</th>
            <th>Check-In</th>
            <th>Nights So Far</th>
            <th>Accrued Cost</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $occupiedQ = $conn->query("
            SELECT
              b.booking_id,
              g.guest_name,
              r.room_type,
              r.price,
              b.check_in
            FROM bookings b
            JOIN guests g ON b.guest_id = g.guest_id
            JOIN rooms  r ON b.room_id  = r.room_id
            WHERE b.status = 'Checked In'
            ORDER BY b.check_in ASC
          ");

          if ($occupiedQ->num_rows === 0): ?>
          <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:40px;">No rooms currently occupied.</td></tr>
          <?php else:
            while ($occ = $occupiedQ->fetch_assoc()):
              $ci    = new DateTime($occ['check_in']);
              $now   = new DateTime();
              $nights = max(1, (int)$ci->diff($now)->days);
              $accrued = $nights * $occ['price'];
          ?>
          <tr>
            <td><?= htmlspecialchars($occ['room_type']) ?></td>
            <td style="font-weight:600;color:var(--white);"><?= htmlspecialchars($occ['guest_name']) ?></td>
            <td><?= date('d M Y, H:i', strtotime($occ['check_in'])) ?></td>
            <td><span class="badge badge-in"><?= $nights ?> night<?= $nights!=1?'s':'' ?></span></td>
            <td style="color:var(--gold);">Rp <?= number_format($accrued) ?></td>
            <td>
              <a href="modules/booking/checkout.php?id=<?= $occ['booking_id'] ?>"
                 class="btn btn-outline btn-sm"
                 onclick="return confirm('Check out <?= htmlspecialchars($occ['guest_name']) ?>?')">
                Check Out
              </a>
            </td>
          </tr>
          <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<script>
/* Auto-refresh room availability every 30 seconds */
setTimeout(() => location.reload(), 30000);
</script>
