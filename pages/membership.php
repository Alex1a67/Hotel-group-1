<?php include "config/db.php"; ?>
<link rel="stylesheet" href="assets/css/dashboard.css">

<div class="page-wrap">

  <div class="page-header">
    <div class="page-eyebrow">History & Records</div>
    <h1 class="page-title">Check <em>Logs</em></h1>
  </div>

  <!-- Income Summary -->
  <?php
  $incQ = $conn->query("
    SELECT
      IFNULL(SUM(p.amount),0)  AS total_income,
      IFNULL(SUM(p.nights),0)  AS total_nights,
      COUNT(p.payment_id)      AS total_payments,
      IFNULL(AVG(p.amount),0)  AS avg_payment
    FROM payments p
  ");
  $inc = $incQ->fetch_assoc();
  ?>

  <div class="stats-row">
    <div class="stat-card">
      <div class="stat-label">Total Revenue</div>
      <div class="stat-value gold" style="font-size:1.6rem;">Rp <?= number_format($inc['total_income']) ?></div>
      <div class="stat-sub">All-time income</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Total Nights Sold</div>
      <div class="stat-value"><?= number_format($inc['total_nights']) ?></div>
      <div class="stat-sub">Nights occupied</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Completed Check-Outs</div>
      <div class="stat-value"><?= $inc['total_payments'] ?></div>
      <div class="stat-sub">Paid transactions</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Avg Revenue / Stay</div>
      <div class="stat-value gold">Rp <?= number_format($inc['avg_payment']) ?></div>
      <div class="stat-sub">Per checkout</div>
    </div>
  </div>

  <!-- Check-Out Logs -->
  <div class="luxury-card">
    <div class="card-header">
      <div class="card-title">Completed <span>Stays</span></div>
    </div>

    <div class="search-wrap">
      <input type="text" class="search-input" id="logSearch"
             placeholder="Search by name, room, method…"
             oninput="filterTable('logSearch','logTable')">
    </div>

    <div style="overflow-x:auto;">
      <table class="lux-table" id="logTable">
        <thead>
          <tr>
            <th>Booking ID</th>
            <th>Guest Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Room Type</th>
            <th>Price / Night</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Nights</th>
            <th>Total Paid</th>
            <th>Method</th>
            <th>Paid At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $logsQ = $conn->query("
            SELECT
              b.booking_id,
              g.guest_name,
              g.email,
              g.phone,
              r.room_type,
              r.price,
              b.check_in,
              b.check_out,
              p.amount,
              p.nights,
              p.method,
              p.paid_at
            FROM bookings b
            JOIN guests   g ON b.guest_id  = g.guest_id
            JOIN rooms    r ON b.room_id   = r.room_id
            JOIN payments p ON p.booking_id = b.booking_id
            WHERE b.status = 'Checked Out'
            ORDER BY p.paid_at DESC
          ");

          $grandTotal = 0;

          if ($logsQ && $logsQ->num_rows > 0):
            while ($log = $logsQ->fetch_assoc()):
              $grandTotal += $log['amount'];
          ?>
          <tr>
            <td style="color:var(--gold);font-weight:600;">#<?= $log['booking_id'] ?></td>
            <td style="font-weight:600;color:var(--white);"><?= htmlspecialchars($log['guest_name']) ?></td>
            <td style="color:var(--text-muted);font-size:12px;"><?= htmlspecialchars($log['email'] ?? '—') ?></td>
            <td><?= htmlspecialchars($log['phone']) ?></td>
            <td><?= htmlspecialchars($log['room_type']) ?></td>
            <td>Rp <?= number_format($log['price']) ?></td>
            <td><?= date('d M Y, H:i', strtotime($log['check_in'])) ?></td>
            <td><?= date('d M Y, H:i', strtotime($log['check_out'])) ?></td>
            <td><?= $log['nights'] ?> night<?= $log['nights'] != 1 ? 's' : '' ?></td>
            <td style="color:var(--gold);font-weight:600;">Rp <?= number_format($log['amount']) ?></td>
            <td><span class="badge badge-confirmed"><?= htmlspecialchars($log['method']) ?></span></td>
            <td style="font-size:12px;color:var(--text-muted);"><?= date('d M Y, H:i', strtotime($log['paid_at'])) ?></td>
          </tr>
          <?php endwhile;
          else: ?>
          <tr><td colspan="12" style="text-align:center;color:var(--text-muted);padding:40px;">No completed check-outs yet.</td></tr>
          <?php endif; ?>
        </tbody>
        <?php if ($grandTotal > 0): ?>
        <tfoot>
          <tr style="background:var(--black-el);">
            <td colspan="9" style="padding:14px 20px;font-weight:700;font-size:11px;letter-spacing:.15em;text-transform:uppercase;color:var(--text-muted);">Grand Total</td>
            <td style="padding:14px 20px;font-weight:700;color:var(--gold);font-size:1.1rem;">Rp <?= number_format($grandTotal) ?></td>
            <td colspan="2"></td>
          </tr>
        </tfoot>
        <?php endif; ?>
      </table>
    </div>
  </div>

  <!-- Revenue by Room Type -->
  <div class="luxury-card section-gap">
    <div class="card-header">
      <div class="card-title">Revenue by <span>Room Type</span></div>
    </div>
    <div style="overflow-x:auto;">
      <table class="lux-table">
        <thead>
          <tr>
            <th>Room Type</th>
            <th>Price / Night</th>
            <th>Completed Stays</th>
            <th>Total Nights</th>
            <th>Total Revenue</th>
            <th>Avg Stay (nights)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $revQ = $conn->query("
            SELECT
              r.room_type,
              r.price,
              COUNT(p.payment_id)    AS total_stays,
              IFNULL(SUM(p.nights),0) AS total_nights,
              IFNULL(SUM(p.amount),0) AS total_revenue,
              IFNULL(AVG(p.nights),0) AS avg_nights
            FROM rooms r
            LEFT JOIN bookings b  ON r.room_id   = b.room_id  AND b.status='Checked Out'
            LEFT JOIN payments p  ON p.booking_id = b.booking_id
            GROUP BY r.room_id
            ORDER BY total_revenue DESC
          ");

          while ($rv = $revQ->fetch_assoc()):
          ?>
          <tr>
            <td style="font-weight:600;color:var(--white);"><?= htmlspecialchars($rv['room_type']) ?></td>
            <td>Rp <?= number_format($rv['price']) ?></td>
            <td><?= $rv['total_stays'] ?></td>
            <td><?= $rv['total_nights'] ?></td>
            <td style="color:var(--gold);font-weight:600;">Rp <?= number_format($rv['total_revenue']) ?></td>
            <td><?= round($rv['avg_nights'], 1) ?> nights</td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<script>
function filterTable(inputId, tableId) {
  const q = document.getElementById(inputId).value.toLowerCase();
  document.querySelectorAll('#'+tableId+' tbody tr').forEach(r => {
    r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
}
</script>
