<?php include "config/db.php"; ?>
<link rel="stylesheet" href="assets/css/dashboard.css">

<?php
$msg = '';
$msgType = '';
if (isset($_GET['msg'])) {
    $msg     = htmlspecialchars($_GET['msg']);
    $msgType = $_GET['type'] ?? 'success';
}

/* ── Handle confirm reservation → booking ── */
if (isset($_GET['confirm']) && is_numeric($_GET['confirm'])) {
    $res_id = (int)$_GET['confirm'];

    $resQ = $conn->query("
        SELECT
            res.*,
            g.guest_name,
            r.room_type,
            r.total_rooms,
            (r.total_rooms - (
                SELECT COUNT(*) FROM bookings b2
                WHERE b2.room_id = r.room_id AND b2.status = 'Checked In'
            )) AS live_available
        FROM reservations res
        JOIN guests g ON res.guest_id = g.guest_id
        JOIN rooms  r ON res.room_id  = r.room_id
        WHERE res.reservation_id = $res_id AND res.status = 'Pending'
    ");

    if ($resQ && $resQ->num_rows > 0) {
        $res = $resQ->fetch_assoc();

        if ($res['live_available'] > 0) {
            $conn->begin_transaction();
            try {
                $conn->query("
                    INSERT INTO bookings (guest_id, room_id, check_in, status)
                    VALUES ({$res['guest_id']}, {$res['room_id']}, NOW(), 'Checked In')
                ");
                $conn->query("UPDATE reservations SET status='Confirmed' WHERE reservation_id=$res_id");
                /* Recalculate from live bookings — no manual +/- */
                $conn->query("
                    UPDATE rooms r
                    SET r.available_rooms = r.total_rooms - (
                        SELECT COUNT(*) FROM bookings b
                        WHERE b.room_id = r.room_id AND b.status = 'Checked In'
                    )
                    WHERE r.room_id = {$res['room_id']}
                ");
                $conn->commit();
                header("Location: index.php?page=reserved&msg=Reservation+confirmed+and+guest+checked+in&type=success");
                exit();
            } catch (Exception $e) {
                $conn->rollback();
            }
        } else {
            header("Location: index.php?page=reserved&msg=Room+full,+cannot+confirm&type=error");
            exit();
        }
    }
}

/* ── Handle cancel ── */
if (isset($_GET['cancel']) && is_numeric($_GET['cancel'])) {
    $res_id = (int)$_GET['cancel'];
    $conn->query("UPDATE reservations SET status='Cancelled' WHERE reservation_id=$res_id");
    header("Location: index.php?page=reserved&msg=Reservation+cancelled&type=success");
    exit();
}
?>

<div class="page-wrap">

  <div class="page-header">
    <div class="page-eyebrow">Reservation Management</div>
    <h1 class="page-title">Guest <em>Reservations</em></h1>
  </div>

  <?php if ($msg): ?>
  <div class="alert alert-<?= $msgType === 'error' ? 'danger' : 'success' ?>" style="max-width:960px;margin:0 auto 24px;">
    <?= $msg ?>
  </div>
  <?php endif; ?>

  <!-- Stats -->
  <?php
  $sQ = $conn->query("
    SELECT
      COUNT(CASE WHEN status='Pending'   THEN 1 END) AS pending,
      COUNT(CASE WHEN status='Confirmed' THEN 1 END) AS confirmed,
      COUNT(CASE WHEN status='Cancelled' THEN 1 END) AS cancelled,
      COUNT(*) AS total
    FROM reservations
  ");
  $s = $sQ->fetch_assoc();
  ?>
  <div class="stats-row">
    <div class="stat-card">
      <div class="stat-label">Pending</div>
      <div class="stat-value gold"><?= $s['pending'] ?></div>
      <div class="stat-sub">Awaiting confirmation</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Confirmed</div>
      <div class="stat-value"><?= $s['confirmed'] ?></div>
      <div class="stat-sub">Checked in</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Cancelled</div>
      <div class="stat-value"><?= $s['cancelled'] ?></div>
      <div class="stat-sub">Not proceeding</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Total Reservations</div>
      <div class="stat-value"><?= $s['total'] ?></div>
      <div class="stat-sub">All time</div>
    </div>
  </div>

  <!-- Reservations Table -->
  <div class="luxury-card">
    <div class="card-header">
      <div class="card-title">All <span>Reservations</span></div>
      <a href="#addReservationForm" class="btn btn-gold btn-sm">+ New Reservation</a>
    </div>

    <div class="search-wrap">
      <input type="text" class="search-input" id="resSearch"
             placeholder="Search by guest, room, status…"
             oninput="filterTable('resSearch','resTable')">
    </div>

    <div style="overflow-x:auto;">
      <table class="lux-table" id="resTable">
        <thead>
          <tr>
            <th>Reservation ID</th>
            <th>Guest Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Room Type</th>
            <th>Price / Night</th>
            <th>Reserved On</th>
            <th>Expected Check-In</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $resResult = $conn->query("
            SELECT
              res.reservation_id,
              res.reserve_date,
              res.expected_checkin,
              res.status,
              g.guest_name,
              g.email,
              g.phone,
              r.room_type,
              r.price,
              r.available_rooms
            FROM reservations res
            JOIN guests g ON res.guest_id = g.guest_id
            JOIN rooms  r ON res.room_id  = r.room_id
            ORDER BY res.reservation_id DESC
          ");

          if ($resResult && $resResult->num_rows > 0):
            while ($row = $resResult->fetch_assoc()):
              $badgeClass = match($row['status']) {
                'Pending'   => 'badge-pending',
                'Confirmed' => 'badge-confirmed',
                default     => 'badge-out'
              };
          ?>
          <tr>
            <td style="color:var(--gold);font-weight:600;">#<?= $row['reservation_id'] ?></td>
            <td style="font-weight:600;color:var(--white);"><?= htmlspecialchars($row['guest_name']) ?></td>
            <td style="color:var(--text-muted);font-size:12px;"><?= htmlspecialchars($row['email'] ?? '—') ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['room_type']) ?></td>
            <td>Rp <?= number_format($row['price']) ?></td>
            <td><?= date('d M Y', strtotime($row['reserve_date'])) ?></td>
            <td><?= $row['expected_checkin'] ? date('d M Y', strtotime($row['expected_checkin'])) : '<span style="color:var(--text-muted)">—</span>' ?></td>
            <td><span class="badge <?= $badgeClass ?>"><?= $row['status'] ?></span></td>
            <td style="display:flex;gap:6px;flex-wrap:wrap;">
              <?php if ($row['status'] === 'Pending'): ?>
              <a href="index.php?page=reserved&confirm=<?= $row['reservation_id'] ?>"
                 class="btn btn-gold btn-sm"
                 onclick="return confirm('Confirm and check in <?= htmlspecialchars($row['guest_name']) ?>?')">
                Confirm & Check In
              </a>
              <a href="index.php?page=reserved&cancel=<?= $row['reservation_id'] ?>"
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Cancel this reservation?')">
                Cancel
              </a>
              <?php else: ?>
              <span style="color:var(--text-muted);font-size:11px;"><?= $row['status'] ?></span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endwhile;
          else: ?>
          <tr><td colspan="10" style="text-align:center;color:var(--text-muted);padding:40px;">No reservations yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add Reservation Form -->
  <div class="luxury-card section-gap" id="addReservationForm">
    <div class="card-header">
      <div class="card-title">New <span>Reservation</span></div>
    </div>

    <form action="modules/reservation/create.php" method="POST">
      <div class="lux-form">
        <div class="form-grid">

          <div class="form-group">
            <label class="form-label">Full Name *</label>
            <input type="text" name="guest_name" class="form-input"
                   placeholder="e.g. Budi Santoso" required
                   oninput="this.value=this.value.replace(/\b\w/g,c=>c.toUpperCase())">
          </div>

          <div class="form-group">
            <label class="form-label">Email Address *</label>
            <input type="email" name="email" class="form-input" placeholder="guest@email.com" required>
          </div>

          <div class="form-group">
            <label class="form-label">Phone Number *</label>
            <input type="text" name="phone" id="resPhone" class="form-input"
                   placeholder="0812-3456-7890" required maxlength="15">
          </div>

          <div class="form-group">
            <label class="form-label">Room Type *</label>
            <select name="room_id" class="form-select" required>
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
              <option value="<?= $rm['room_id'] ?>" <?= $disabled ?>>
                <?= $rm['room_type'] ?> — Rp <?= number_format($rm['price']) ?>/night
                <?= $avail <= 0 ? ' (FULLY BOOKED)' : " ({$avail} avail)" ?>
              </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Expected Check-In Date</label>
            <input type="date" name="expected_checkin" class="form-input"
                   min="<?= date('Y-m-d') ?>">
          </div>

        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-gold">✦ Create Reservation</button>
      </div>
    </form>
  </div>

</div>

<script>
document.getElementById('resPhone').addEventListener('input', function(e) {
  let v = e.target.value.replace(/\D/g,'');
  e.target.value = v.replace(/(\d{4})(?=\d)/g,'$1-');
});

function filterTable(inputId, tableId) {
  const q = document.getElementById(inputId).value.toLowerCase();
  document.querySelectorAll('#'+tableId+' tbody tr').forEach(r => {
    r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
}
</script>
