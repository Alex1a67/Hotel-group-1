<?php include "config/db.php"; ?>
<link rel="stylesheet" href="assets/css/dashboard.css">
<link rel="stylesheet" href="assets/css/navbar.css">

<?php
/* ── Handle flash messages ── */
$msg = '';
$msgType = '';
if (isset($_GET['msg'])) {
    $msg     = htmlspecialchars($_GET['msg']);
    $msgType = $_GET['type'] ?? 'success';
}
?>

<div class="page-wrap">

  <!-- Page Header -->
  <div class="page-header">
    <div class="page-eyebrow">Booking Management</div>
    <h1 class="page-title">Active <em>Bookings</em></h1>
  </div>

  <?php if ($msg): ?>
  <div class="alert alert-<?= $msgType === 'error' ? 'danger' : 'success' ?>" style="max-width:900px;margin:0 auto 24px;">
    <?= $msg ?>
  </div>
  <?php endif; ?>

  <!-- Stats Row -->
  <?php
  $statsQ = $conn->query("
    SELECT
      COUNT(CASE WHEN status='Checked In'  THEN 1 END) AS active,
      COUNT(CASE WHEN status='Checked Out' THEN 1 END) AS completed,
      COUNT(*) AS total
    FROM bookings
  ");
  $stats = $statsQ->fetch_assoc();

  $incomeQ = $conn->query("SELECT IFNULL(SUM(amount),0) AS income FROM payments");
  $income  = $incomeQ->fetch_assoc()['income'];
  ?>

  <div class="stats-row">
    <div class="stat-card">
      <div class="stat-label">Currently Checked In</div>
      <div class="stat-value gold"><?= $stats['active'] ?></div>
      <div class="stat-sub">Active guests</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Total Completed</div>
      <div class="stat-value"><?= $stats['completed'] ?></div>
      <div class="stat-sub">Check-outs logged</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">All-Time Bookings</div>
      <div class="stat-value"><?= $stats['total'] ?></div>
      <div class="stat-sub">Since inception</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Total Income</div>
      <div class="stat-value gold" style="font-size:1.4rem;">Rp <?= number_format($income) ?></div>
      <div class="stat-sub">From check-outs</div>
    </div>
  </div>

  <!-- Bookings Table -->
  <div class="luxury-card">
    <div class="card-header">
      <div class="card-title">Booking <span>Records</span></div>
      <a href="#addBookingForm" class="btn btn-gold btn-sm">+ New Booking</a>
    </div>

    <div class="search-wrap">
      <input type="text" class="search-input" id="bookingSearch" placeholder="Search by name, room, status…" oninput="filterTable('bookingSearch','bookingTable')">
    </div>

    <div style="overflow-x:auto;">
      <table class="lux-table" id="bookingTable">
        <thead>
          <tr>
            <th>Booking ID</th>
            <th>Guest Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Room Type</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Duration</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = $conn->query("
            SELECT
              b.booking_id,
              g.guest_name,
              g.email,
              g.phone,
              r.room_type,
              r.price,
              b.check_in,
              b.check_out,
              b.status,
              IFNULL(p.amount, 0) AS paid_amount,
              IFNULL(p.nights, 0) AS nights
            FROM bookings b
            JOIN guests  g ON b.guest_id = g.guest_id
            JOIN rooms   r ON b.room_id  = r.room_id
            LEFT JOIN payments p ON p.booking_id = b.booking_id
            ORDER BY b.booking_id DESC
          ");

          while ($row = $result->fetch_assoc()):
            $statusBadge = $row['status'] === 'Checked In' ? 'badge-in' : 'badge-out';

            /* duration calc */
            $duration = '—';
            if ($row['check_in'] && $row['check_out']) {
                $ci = new DateTime($row['check_in']);
                $co = new DateTime($row['check_out']);
                $diff = $ci->diff($co);
                $duration = $diff->days . ' night' . ($diff->days != 1 ? 's' : '');
            } elseif ($row['check_in'] && $row['status'] === 'Checked In') {
                $ci = new DateTime($row['check_in']);
                $now = new DateTime();
                $diff = $ci->diff($now);
                $duration = $diff->days . 'n (ongoing)';
            }
          ?>
          <tr>
            <td style="color:var(--gold);font-weight:600;">#<?= $row['booking_id'] ?></td>
            <td style="font-weight:600;color:var(--white);"><?= htmlspecialchars($row['guest_name']) ?></td>
            <td style="color:var(--text-muted);font-size:12px;"><?= htmlspecialchars($row['email'] ?? '—') ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['room_type']) ?></td>
            <td><?= date('d M Y, H:i', strtotime($row['check_in'])) ?></td>
            <td><?= $row['check_out'] ? date('d M Y, H:i', strtotime($row['check_out'])) : '<span style="color:var(--text-muted)">—</span>' ?></td>
            <td><?= $duration ?></td>
            <td><?= $row['paid_amount'] > 0 ? 'Rp ' . number_format($row['paid_amount']) : '<span style="color:var(--text-muted)">Pending</span>' ?></td>
            <td><span class="badge <?= $statusBadge ?>"><?= $row['status'] ?></span></td>
            <td>
              <?php if ($row['status'] === 'Checked In'): ?>
              <a href="modules/booking/checkout.php?id=<?= $row['booking_id'] ?>"
                 class="btn btn-outline btn-sm"
                 onclick="return confirm('Confirm check-out for <?= htmlspecialchars($row['guest_name']) ?>?')">
                Check Out
              </a>
              <?php else: ?>
              <span style="color:var(--text-muted);font-size:11px;">Completed</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add Booking Form -->
  <div class="luxury-card section-gap" id="addBookingForm">
    <div class="card-header">
      <div class="card-title">New <span>Booking</span></div>
    </div>

    <form action="modules/booking/create.php" method="POST">
      <div class="lux-form">
        <div class="form-grid">

          <div class="form-group">
            <label class="form-label">Full Name *</label>
            <input type="text" name="guest_name" class="form-input" placeholder="e.g. Yarisunal Firdaus" required
                   style="text-transform:capitalize;" oninput="this.value=this.value.replace(/\b\w/g,c=>c.toUpperCase())">
          </div>

          <div class="form-group">
            <label class="form-label">Email Address *</label>
            <input type="email" name="email" class="form-input" placeholder="guest@email.com" required>
          </div>

          <div class="form-group">
            <label class="form-label">Phone Number *</label>
            <input type="text" name="phone" id="phoneInput" class="form-input" placeholder="0812-3456-7890" required maxlength="15">
          </div>

          <div class="form-group">
            <label class="form-label">Room Type *</label>
            <select name="room_id" class="form-select" id="roomSelect" required>
              <?php
              $rooms = $conn->query("
                SELECT
                  r.room_id, r.room_type, r.price, r.total_rooms,
                  (r.total_rooms - COUNT(b.booking_id)) AS live_available
                FROM rooms r
                LEFT JOIN bookings b ON b.room_id = r.room_id AND b.status = 'Checked In'
                GROUP BY r.room_id
                ORDER BY r.price ASC
              ");
              while ($rm = $rooms->fetch_assoc()):
                $avail    = (int)$rm['live_available'];
                $disabled = $avail <= 0 ? 'disabled' : '';
              ?>
              <option value="<?= $rm['room_id'] ?>" <?= $disabled ?>
                data-price="<?= $rm['price'] ?>">
                <?= $rm['room_type'] ?> — Rp <?= number_format($rm['price']) ?>/night
                <?= $avail <= 0 ? ' (FULLY BOOKED)' : " ({$avail} avail)" ?>
              </option>
              <?php endwhile; ?>
            </select>
          </div>

        </div>

        <!-- Price Preview -->
        <div id="pricePreview" style="background:var(--black-el);border:1px solid var(--black-line);border-radius:9px;padding:14px 18px;margin-bottom:0;display:flex;align-items:center;gap:12px;">
          <span style="font-size:11px;letter-spacing:.15em;text-transform:uppercase;color:var(--text-muted);">Room Rate</span>
          <span id="priceDisplay" style="font-family:var(--serif);font-size:1.4rem;color:var(--gold);font-weight:400;">—</span>
          <span style="font-size:11px;color:var(--text-muted);">/ night · Room availability updates in real-time</span>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-gold">✦ Confirm Booking & Check In</button>
      </div>
    </form>
  </div>

</div><!-- .page-wrap -->

<script>
/* Phone formatter */
document.getElementById('phoneInput').addEventListener('input', function(e) {
  let v = e.target.value.replace(/\D/g, '');
  e.target.value = v.replace(/(\d{4})(?=\d)/g, '$1-');
});

/* Room price preview */
const roomSel = document.getElementById('roomSelect');
const priceDisplay = document.getElementById('priceDisplay');

function updatePrice() {
  const opt = roomSel.options[roomSel.selectedIndex];
  const price = parseInt(opt.dataset.price) || 0;
  priceDisplay.textContent = 'Rp ' + price.toLocaleString('id-ID');
}
roomSel.addEventListener('change', updatePrice);
updatePrice();

/* Table search */
function filterTable(inputId, tableId) {
  const q = document.getElementById(inputId).value.toLowerCase();
  const rows = document.querySelectorAll('#' + tableId + ' tbody tr');
  rows.forEach(r => {
    r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
}
</script>
