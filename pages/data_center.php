<?php include "config/db.php"; ?>
<link rel="stylesheet" href="assets/css/dashboard.css">

<?php
/* ── Handle visitor add ── */
if (isset($_POST['addVisitor'])) {
    $vName    = ucwords(strtolower(trim($conn->real_escape_string($_POST['v_name']))));
    $vPurpose = trim($conn->real_escape_string($_POST['v_purpose']));
    $conn->query("INSERT INTO visitors (name, purpose, check_in) VALUES ('$vName','$vPurpose',NOW())");
    header("Location: index.php?page=data_center&msg=Visitor+added&type=success");
    exit();
}

/* ── Handle visitor checkout ── */
if (isset($_GET['vout']) && is_numeric($_GET['vout'])) {
    $vid = (int)$_GET['vout'];
    $conn->query("UPDATE visitors SET check_out=NOW() WHERE visitor_id=$vid AND check_out IS NULL");
    header("Location: index.php?page=data_center&msg=Visitor+checked+out&type=success");
    exit();
}

$msg = '';
$msgType = '';
if (isset($_GET['msg'])) {
    $msg     = htmlspecialchars($_GET['msg']);
    $msgType = $_GET['type'] ?? 'success';
}
?>

<div class="page-wrap">

  <div class="page-header">
    <div class="page-eyebrow">Operations Hub</div>
    <h1 class="page-title">Data <em>Center</em></h1>
  </div>

  <?php if ($msg): ?>
  <div class="alert alert-<?= $msgType==='error'?'danger':'success' ?>" style="max-width:1100px;margin:0 auto 24px;">
    <?= $msg ?>
  </div>
  <?php endif; ?>

  <!-- Overview Stats -->
  <?php
  $ovQ = $conn->query("
    SELECT
      (SELECT COUNT(*) FROM bookings WHERE status='Checked In')   AS active_guests,
      (SELECT COUNT(*) FROM reservations WHERE status='Pending')  AS pending_res,
      (SELECT COUNT(*) FROM visitors WHERE check_out IS NULL)     AS visitors_inside,
      (SELECT IFNULL(SUM(amount),0) FROM payments)                AS total_income
  ");
  $ov = $ovQ->fetch_assoc();
  ?>
  <div class="stats-row">
    <div class="stat-card">
      <div class="stat-label">Active Guests</div>
      <div class="stat-value gold"><?= $ov['active_guests'] ?></div>
      <div class="stat-sub">Currently checked in</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Pending Reservations</div>
      <div class="stat-value"><?= $ov['pending_res'] ?></div>
      <div class="stat-sub">Awaiting confirmation</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Visitors Inside</div>
      <div class="stat-value"><?= $ov['visitors_inside'] ?></div>
      <div class="stat-sub">Not yet checked out</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Total Revenue</div>
      <div class="stat-value gold" style="font-size:1.4rem;">Rp <?= number_format($ov['total_income']) ?></div>
      <div class="stat-sub">All-time</div>
    </div>
  </div>

  <!-- All Bookings (complete view) -->
  <div class="luxury-card">
    <div class="card-header">
      <div class="card-title">All <span>Guests & Bookings</span></div>
    </div>
    <div class="search-wrap">
      <input type="text" class="search-input" id="dcSearch"
             placeholder="Search name, email, room, status…"
             oninput="filterTable('dcSearch','dcTable')">
    </div>
    <div style="overflow-x:auto;">
      <table class="lux-table" id="dcTable">
        <thead>
          <tr>
            <th>Booking ID</th>
            <th>Guest ID</th>
            <th>Guest Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Room</th>
            <th>Room ID</th>
            <th>Price/Night</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Nights</th>
            <th>Amount Paid</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allQ = $conn->query("
            SELECT
              b.booking_id,
              g.guest_id,
              g.guest_name,
              g.email,
              g.phone,
              r.room_id,
              r.room_type,
              r.price,
              b.check_in,
              b.check_out,
              b.status,
              IFNULL(p.amount,0)  AS paid,
              IFNULL(p.nights, 0) AS nights
            FROM bookings b
            JOIN guests  g ON b.guest_id = g.guest_id
            JOIN rooms   r ON b.room_id  = r.room_id
            LEFT JOIN payments p ON p.booking_id = b.booking_id
            ORDER BY b.booking_id DESC
          ");

          while ($row = $allQ->fetch_assoc()):
            $dur = '—';
            if ($row['check_in'] && $row['check_out']) {
                $ci  = new DateTime($row['check_in']);
                $co  = new DateTime($row['check_out']);
                $dur = $ci->diff($co)->days . 'n';
            } elseif ($row['status'] === 'Checked In') {
                $ci  = new DateTime($row['check_in']);
                $now = new DateTime();
                $dur = $ci->diff($now)->days . 'n+';
            }
          ?>
          <tr>
            <td style="color:var(--gold);font-weight:600;">#<?= $row['booking_id'] ?></td>
            <td style="color:var(--text-muted);">G-<?= $row['guest_id'] ?></td>
            <td style="font-weight:600;color:var(--white);"><?= htmlspecialchars($row['guest_name']) ?></td>
            <td style="color:var(--text-muted);font-size:12px;"><?= htmlspecialchars($row['email'] ?? '—') ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['room_type']) ?></td>
            <td style="color:var(--text-muted);">R-<?= $row['room_id'] ?></td>
            <td>Rp <?= number_format($row['price']) ?></td>
            <td><?= date('d M Y, H:i', strtotime($row['check_in'])) ?></td>
            <td><?= $row['check_out'] ? date('d M Y, H:i', strtotime($row['check_out'])) : '<span style="color:var(--text-muted)">—</span>' ?></td>
            <td><?= $dur ?></td>
            <td style="<?= $row['paid']>0 ? 'color:var(--gold);font-weight:600;' : 'color:var(--text-muted);' ?>">
              <?= $row['paid'] > 0 ? 'Rp '.number_format($row['paid']) : 'Pending' ?>
            </td>
            <td>
              <span class="badge <?= $row['status']==='Checked In' ? 'badge-in' : 'badge-out' ?>">
                <?= $row['status'] ?>
              </span>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Visitors Section -->
  <div class="luxury-card section-gap">
    <div class="card-header">
      <div class="card-title">Visitor <span>Log</span></div>
      <button class="btn btn-outline btn-sm" onclick="document.getElementById('addVisitorForm').style.display=document.getElementById('addVisitorForm').style.display==='none'?'block':'none'">
        + Add Visitor
      </button>
    </div>

    <!-- Add Visitor Form -->
    <div id="addVisitorForm" style="display:none;border-bottom:1px solid var(--black-line);">
      <form method="POST" action="index.php?page=data_center">
        <div class="lux-form">
          <div class="form-grid" style="grid-template-columns:1fr 1fr auto;">
            <div class="form-group">
              <label class="form-label">Visitor Name *</label>
              <input type="text" name="v_name" class="form-input" placeholder="Full name" required
                     oninput="this.value=this.value.replace(/\b\w/g,c=>c.toUpperCase())">
            </div>
            <div class="form-group">
              <label class="form-label">Purpose *</label>
              <input type="text" name="v_purpose" class="form-input" placeholder="e.g. Meeting, Delivery…" required>
            </div>
            <div class="form-group" style="justify-content:flex-end;">
              <label class="form-label">&nbsp;</label>
              <button type="submit" name="addVisitor" class="btn btn-gold">Add Visitor</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div style="overflow-x:auto;">
      <table class="lux-table">
        <thead>
          <tr>
            <th>Visitor ID</th>
            <th>Name</th>
            <th>Purpose</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $visQ = $conn->query("SELECT * FROM visitors ORDER BY visitor_id DESC");
          if ($visQ->num_rows === 0): ?>
          <tr><td colspan="8" style="text-align:center;color:var(--text-muted);padding:40px;">No visitors logged.</td></tr>
          <?php else:
            while ($v = $visQ->fetch_assoc()):
              $inside = is_null($v['check_out']);
              if (!$inside && $v['check_in'] && $v['check_out']) {
                  $ci  = new DateTime($v['check_in']);
                  $co  = new DateTime($v['check_out']);
                  $dur = $ci->diff($co)->format('%H:%I hrs');
              } elseif ($inside) {
                  $ci  = new DateTime($v['check_in']);
                  $now = new DateTime();
                  $dur = $ci->diff($now)->format('%H:%I hrs (ongoing)');
              } else {
                  $dur = '—';
              }
          ?>
          <tr>
            <td style="color:var(--gold);">V-<?= $v['visitor_id'] ?></td>
            <td style="font-weight:600;color:var(--white);"><?= htmlspecialchars($v['name']) ?></td>
            <td><?= htmlspecialchars($v['purpose'] ?? '—') ?></td>
            <td><?= date('d M Y, H:i', strtotime($v['check_in'])) ?></td>
            <td><?= $v['check_out'] ? date('d M Y, H:i', strtotime($v['check_out'])) : '<span style="color:var(--text-muted)">—</span>' ?></td>
            <td><?= $dur ?></td>
            <td>
              <?php if ($inside): ?>
              <span class="badge badge-in">Inside</span>
              <?php else: ?>
              <span class="badge badge-out">Left</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if ($inside): ?>
              <a href="index.php?page=data_center&vout=<?= $v['visitor_id'] ?>"
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Check out this visitor?')">
                Check Out
              </a>
              <?php else: ?>
              <span style="color:var(--text-muted);font-size:11px;">Done</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- All Guests List -->
  <div class="luxury-card section-gap">
    <div class="card-header">
      <div class="card-title">Guest <span>Registry</span></div>
    </div>
    <div style="overflow-x:auto;">
      <table class="lux-table">
        <thead>
          <tr>
            <th>Guest ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Total Bookings</th>
            <th>Total Spent</th>
            <th>Joined</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $guestQ = $conn->query("
            SELECT
              g.guest_id,
              g.guest_name,
              g.email,
              g.phone,
              g.created_at,
              COUNT(b.booking_id)         AS total_bookings,
              IFNULL(SUM(p.amount),0)     AS total_spent
            FROM guests g
            LEFT JOIN bookings  b ON b.guest_id   = g.guest_id
            LEFT JOIN payments  p ON p.booking_id  = b.booking_id
            GROUP BY g.guest_id
            ORDER BY g.guest_id DESC
          ");

          while ($g = $guestQ->fetch_assoc()):
          ?>
          <tr>
            <td style="color:var(--gold);">G-<?= $g['guest_id'] ?></td>
            <td style="font-weight:600;color:var(--white);"><?= htmlspecialchars($g['guest_name']) ?></td>
            <td style="color:var(--text-muted);"><?= htmlspecialchars($g['email'] ?? '—') ?></td>
            <td><?= htmlspecialchars($g['phone']) ?></td>
            <td><?= $g['total_bookings'] ?></td>
            <td style="<?= $g['total_spent']>0 ? 'color:var(--gold);font-weight:600;' : '' ?>">
              <?= $g['total_spent'] > 0 ? 'Rp '.number_format($g['total_spent']) : '—' ?>
            </td>
            <td style="font-size:12px;color:var(--text-muted);"><?= date('d M Y', strtotime($g['created_at'])) ?></td>
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
