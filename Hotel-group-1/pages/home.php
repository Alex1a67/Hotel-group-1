<?php ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/navbar.css">

<style>
/* ── Override cyan accents to gold for luxury theme ── */
:root {
  --cyan: #C9A84C;
}
.hero { background: #0A0A0A; }
.hero-eyebrow { color: #C9A84C; border-color: rgba(201,168,76,.35); }
.orb-cyan { background: rgba(201,168,76,.10); }
.orb-gold { background: rgba(201,168,76,.07); }
.orb-mid  { background: rgba(201,168,76,.05); }
.ci-letter.y { background: rgba(201,168,76,.12); color: #C9A84C; }
.ci-letter.f { background: rgba(201,168,76,.08); color: #E2C06A; }
.ci-letter.w { background: rgba(10,10,10,.6);    color: #fff; }
.cal-nav-btn:hover { border-color: #C9A84C; background: rgba(201,168,76,.08); }
.cal-day.in-range { background: rgba(201,168,76,.08); }
.cnt-btn:hover:not(:disabled) { border-color: #C9A84C; background: rgba(201,168,76,.08); }
.rt-card:hover { border-color: #C9A84C; background: rgba(201,168,76,.05); }
.rt-badge { background: #C9A84C; color: #0A0A0A; }
.rt-card.sel { border-color: #C9A84C; background: #C9A84C; }
.rt-card.sel .rt-name  { color: #0A0A0A; }
.rt-card.sel .rt-price { color: #0A0A0A; }
.rt-card.sel .rt-badge { background: #0A0A0A; color: #C9A84C; }
.guest-confirm:hover   { background: #C9A84C; color: #0A0A0A; }
.sb-btn:hover { background: #C9A84C; color: #0A0A0A; }
.btn-apply { background: #C9A84C; }
.btn-apply:hover { background: #8C6E2F; }
.rc-cta:hover { background: #C9A84C; border-color: #C9A84C; color: #0A0A0A; }
.rc-cta.gold-btn { background: #C9A84C; border-color: #C9A84C; }
.room-card.featured { border-color: #C9A84C; }
.concept { background: #111111; }
.concept-heading { color: #E8E0CC; }
.ci-title { color: #E8E0CC; }
.ci-text  { color: #8A7F6E; }
.rooms { background: #0A0A0A; }
.rooms-heading { color: #E8E0CC; }
.room-card { background: #161616; border-color: #2A2A2A; color: #E8E0CC; }
.room-card:hover { box-shadow: 0 24px 60px rgba(201,168,76,.12); }
.rc-name { color: #E8E0CC; }
.rc-desc { color: #8A7F6E; }
.rc-tag  { background: #1E1E1E; color: #8A7F6E; border-color: #2A2A2A; }
.rc-footer { border-top-color: #2A2A2A; }
.rc-cta { border-color: #C9A84C; color: #C9A84C; }
.search-bar { background: #161616; border-top-color: #C9A84C; box-shadow: 0 24px 80px rgba(0,0,0,.6); }
.sb-field:hover { background: #1E1E1E; }
.sb-val { color: #E8E0CC; }
.sb-btn { background: #C9A84C; color: #0A0A0A; }
.sb-dropdown, .guest-dropdown {
  background: #161616;
  border-color: #2A2A2A;
  box-shadow: 0 20px 64px rgba(0,0,0,.8);
}
.cal-day { color: #E8E0CC; }
.cal-day.start, .cal-day.end { background: #C9A84C !important; color: #0A0A0A !important; }
.cal-day.today::after { background: #C9A84C; }
.cal-footer { border-top-color: #2A2A2A; }
.cal-summary-text { color: #8A7F6E; }
.cal-nav-btn { border-color: #2A2A2A; color: #E8E0CC; }
.guest-type-name { color: #E8E0CC; }
.cnt-val { color: #E8E0CC; }
.cnt-btn { border-color: #2A2A2A; color: #E8E0CC; }
.guest-confirm { background: #C9A84C; color: #0A0A0A; }
.room-type-grid .rt-card { border-color: #2A2A2A; }
.rt-name  { color: #E8E0CC; }
.rt-price { color: #8A7F6E; }
.sb-static { background: #161616; }
body { background: #0A0A0A; color: #E8E0CC; }
</style>

<script src="assets/js/main.js" defer></script>
<script src="assets/js/dashboard.js"></script>

<section class="hero">
  <div class="hero-bg">
    <div class="orb orb-cyan"></div>
    <div class="orb orb-gold"></div>
    <div class="orb orb-mid"></div>
  </div>

  <div class="hero-inner">
    <div class="tag hero-eyebrow">✦ Transitional Experience</div>
    <h1 class="hero-title">YFW <em>Haven Grand</em></h1>
    <p class="hero-sub">"<?php echo defined('TAGLINE') ? : 'Where Your Future World Begins'; ?>"</p>
  </div>
</section>

<!-- Search Bar Bridge -->
<div class="search-bar-bridge">
  <div class="search-bar-wrap">
    <div class="search-bar" id="searchBar">

      <div class="sb-field sb-static">
        <div class="sb-label">
          <svg viewBox="0 0 16 16"><circle cx="8" cy="7" r="3"></circle><path d="M8 1C4.686 1 2 3.686 2 7c0 4.418 6 8 6 8s6-3.582 6-8c0-3.314-2.686-6-6-6z"></path></svg>
          Destination
        </div>
        <div class="sb-val">YFW Haven &mdash; South East Asia</div>
      </div>

      <div class="sb-field" id="dateField">
        <div class="sb-label">
          <svg viewBox="0 0 16 16"><rect x="1" y="3" width="14" height="12" rx="2"></rect><path d="M5 1v4M11 1v4M1 7h14"></path></svg>
          Check-In &amp; Check-Out
        </div>
        <div class="sb-val ph" id="dateVal">Select your dates</div>
        <div class="sb-dropdown" id="calDropdown">
          <div class="cal-nav-row">
            <button type="button" class="cal-nav-btn" id="prevMonthBtn">&#8592;</button>
            <div class="cal-month-title-wrap">
              <span class="cal-month-title" id="ml0"></span>
              <span class="cal-month-title" id="ml1"></span>
            </div>
            <button type="button" class="cal-nav-btn" id="nextMonthBtn">&#8594;</button>
          </div>
          <div class="cal-months-grid">
            <div>
              <div class="cal-dow"><span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span></div>
              <div class="cal-grid" id="cg0"></div>
            </div>
            <div>
              <div class="cal-dow"><span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span></div>
              <div class="cal-grid" id="cg1"></div>
            </div>
          </div>
          <div class="cal-footer">
            <div class="cal-summary-text" id="calSummary">Select check-in date</div>
            <div class="cal-footer-actions">
              <button type="button" class="btn-ghost" id="clearDatesBtn">Clear</button>
              <button type="button" class="btn-apply" id="applyDatesBtn">Apply Dates</button>
            </div>
          </div>
        </div>
      </div>

      <div class="sb-field" id="guestField">
        <div class="sb-label">
          <svg viewBox="0 0 16 16"><circle cx="6" cy="5" r="2.5"></circle><path d="M1 14c0-3.314 2.239-6 5-6s5 2.686 5 6"></path><circle cx="11.5" cy="5" r="2"></circle><path d="M14 14c0-2.761-1.343-5-3-5"></path></svg>
          Guests &amp; Room Type
        </div>
        <div class="sb-val" id="guestVal">2 Guests &nbsp;&bull;&nbsp; Y Room</div>
        <div class="guest-dropdown" id="guestDropdown">
          <div class="guest-row">
            <div>
              <div class="guest-type-name">Adults</div>
              <div class="guest-type-desc">Age 13+</div>
            </div>
            <div class="counter">
              <button type="button" class="cnt-btn" id="adMinus" data-type="ad" data-dir="-1">&#8722;</button>
              <span class="cnt-val" id="adVal">2</span>
              <button type="button" class="cnt-btn" data-type="ad" data-dir="1">&#43;</button>
            </div>
          </div>
          <div class="guest-row">
            <div>
              <div class="guest-type-name">Children</div>
              <div class="guest-type-desc">Age 2&ndash;12</div>
            </div>
            <div class="counter">
              <button type="button" class="cnt-btn" id="chMinus" data-type="ch" data-dir="-1" disabled>&#8722;</button>
              <span class="cnt-val" id="chVal">0</span>
              <button type="button" class="cnt-btn" data-type="ch" data-dir="1">&#43;</button>
            </div>
          </div>
          <div class="room-type-section">
            <div class="room-type-label">Room Type</div>
            <div class="room-type-grid">
              <div class="rt-card sel" id="rt-Y" data-room="Y"><div class="rt-icon">🖥️</div><div class="rt-name">Y Room</div><div class="rt-price">Rp 850K/malam</div><div class="rt-badge">SMART</div></div>
              <div class="rt-card" id="rt-F" data-room="F"><div class="rt-icon">🤖</div><div class="rt-name">F Room</div><div class="rt-price">Rp 2.2Jt/malam</div><div class="rt-badge">EXEC</div></div>
              <div class="rt-card" id="rt-W" data-room="W"><div class="rt-icon">🌟</div><div class="rt-name">W Suite</div><div class="rt-price">Rp 5.5Jt/malam</div><div class="rt-badge">LUXURY</div></div>
            </div>
          </div>
          <button type="button" class="guest-confirm" id="guestConfirmBtn">Confirm Selection</button>
        </div>
      </div>

      <button type="button" class="sb-btn" id="searchBtn"
              onclick="window.location='index.php?page=booking'">
        Book<br>Now
      </button>
    </div>
  </div>
</div>

<!-- Live Room Availability Strip -->
<div style="background:#111111;border-top:1px solid #2A2A2A;border-bottom:1px solid #2A2A2A;padding:24px 32px;">
  <div style="max-width:1240px;margin:0 auto;">
    <div style="font-size:9px;font-weight:700;letter-spacing:.25em;text-transform:uppercase;color:#C9A84C;text-align:center;margin-bottom:18px;">✦ Live Room Availability</div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;">
      <?php
      $availRooms = $conn->query("SELECT room_type, price, available_rooms, total_rooms FROM rooms ORDER BY price ASC");
      while ($ar = $availRooms->fetch_assoc()):
        $pct = $ar['total_rooms'] > 0 ? round((($ar['total_rooms']-$ar['available_rooms'])/$ar['total_rooms'])*100) : 0;
        $clr = $ar['available_rooms'] <= 0 ? '#C0392B' : ($ar['available_rooms'] <= 2 ? '#F5A623' : '#C9A84C');
      ?>
      <div style="background:#161616;border:1px solid #2A2A2A;border-radius:10px;padding:14px;text-align:center;">
        <div style="font-size:11px;font-weight:600;color:#E8E0CC;margin-bottom:4px;"><?= htmlspecialchars($ar['room_type']) ?></div>
        <div style="font-size:10px;color:#8A7F6E;margin-bottom:8px;">Rp <?= number_format($ar['price']) ?>/night</div>
        <div style="font-size:1.3rem;font-family:'Cormorant Garamond',serif;font-weight:400;color:<?= $clr ?>;"><?= $ar['available_rooms'] ?></div>
        <div style="font-size:9px;color:#8A7F6E;">avail of <?= $ar['total_rooms'] ?></div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<section class="concept">
  <div class="wrap">
    <div class="concept-grid">
      <div>
        <div class="section-label">About YFW</div>
        <h2 class="concept-heading">The <em>YFW</em> Concept</h2>
        <div class="concept-items">
          <div class="ci">
            <div class="ci-letter y">Y</div>
            <div class="ci-body">
              <div class="ci-title">Your</div>
              <div class="ci-text">Every corner is designed for your personal experience. Smart tech that recognizes your preferences before you ask.</div>
            </div>
          </div>
          <div class="ci">
            <div class="ci-letter f">F</div>
            <div class="ci-body">
              <div class="ci-title">Future</div>
              <div class="ci-text">Innovation without limits. From facial recognition to AI butlers ready to serve you 24/7 with adaptive intelligence.</div>
            </div>
          </div>
          <div class="ci">
            <div class="ci-letter w">W</div>
            <div class="ci-body">
              <div class="ci-title">World</div>
              <div class="ci-text">An exclusive world. Gaming, work, relaxation, and cinema in one iconic 25-story building in the heart of the city.</div>
            </div>
          </div>
        </div>
      </div>
      <div class="concept-mosaic">
        <div class="cm-img"><img src="assets/img/Fpro.jpg" alt="Gaming Setup"><div class="cm-overlay"></div><div class="cm-caption">Gaming Lounge</div></div>
        <div class="cm-img"><img src="assets/img/room2.jpg" alt="Luxury Suite"><div class="cm-overlay"></div><div class="cm-caption">W Suite</div></div>
        <div class="cm-img"><img src="assets/img/Amaris2.webp" alt="F Room"><div class="cm-overlay"></div><div class="cm-caption">F Executive</div></div>
        <div class="cm-img"><img src="assets/img/StudioTwin30.webp" alt="Y Room"><div class="cm-overlay"></div><div class="cm-caption">Y Room Smart</div></div>
      </div>
    </div>
  </div>
</section>

<section class="rooms">
  <div class="wrap">
    <div class="rooms-header">
      <div class="section-label">Select Your Dimension</div>
      <h2 class="rooms-heading">Choose Your <em>Perfect Room</em></h2>
    </div>
    <div class="rooms-grid">

      <div class="room-card">
        <div class="rc-img"><img src="assets/img/Amaris.webp" alt="Y Room"></div>
        <div class="rc-body">
          <div class="rc-name">Y Room <span class="rc-subname">(Smart Standard)</span></div>
          <div class="rc-desc">Kamar pintar dengan digital wall interaktif dan sistem suara ambient yang bisa dikustomisasi sepenuhnya.</div>
          <div class="rc-tags"><span class="rc-tag">Voice Control</span><span class="rc-tag">Digital Wall</span><span class="rc-tag">Smart Lighting</span><span class="rc-tag">Mood Audio</span></div>
          <div class="rc-footer">
            <div><div class="rc-price-old">Rp 1.200.000</div><div class="rc-price">Rp 850.000 <span>/malam</span></div></div>
            <a href="index.php?page=booking" class="rc-cta">Book Now</a>
          </div>
        </div>
      </div>

      <div class="room-card">
        <div class="rc-img"><img src="assets/img/SuitePresidensial.webp" alt="F Room"></div>
        <div class="rc-body">
          <div class="rc-name">F Room <span class="rc-subname">(Executive)</span></div>
          <div class="rc-desc">Produktivitas bertemu kenyamanan. AI Assistant terintegrasi, Smart Mirror, dan workstation ergonomis futuristik.</div>
          <div class="rc-tags"><span class="rc-tag">AI Assistant</span><span class="rc-tag">Smart Mirror</span><span class="rc-tag">Standing Desk</span><span class="rc-tag">4K Monitor</span></div>
          <div class="rc-footer">
            <div><div class="rc-price">Rp 2.200.000 <span>/malam</span></div></div>
            <a href="index.php?page=booking" class="rc-cta">Book Now</a>
          </div>
        </div>
      </div>

      <div class="room-card featured">
        <div class="rc-img"><img src="assets/img/KamarPremierKing.webp" alt="W Suite"></div>
        <div class="rc-body">
          <div class="rc-name">W Suite <span class="rc-subname">(World Class)</span></div>
          <div class="rc-desc">Private mini bar, City View Bathtub panoramik, Memory Foam Bed, dan butler AI personal tersertifikasi.</div>
          <div class="rc-tags"><span class="rc-tag">AI Butler</span><span class="rc-tag">City View Bath</span><span class="rc-tag">Mini Bar</span><span class="rc-tag">Memory Foam</span></div>
          <div class="rc-footer">
            <div><div class="rc-price">Rp 5.500.000 <span>/malam</span></div></div>
            <a href="index.php?page=booking" class="rc-cta">Book Now</a>
          </div>
        </div>
      </div>

      <div class="room-card">
        <div class="rc-badge navy">New</div>
        <div class="rc-img"><img src="assets/img/Studiodouble30.webp" alt="Y Premium"></div>
        <div class="rc-body">
          <div class="rc-name">Y Premium <span class="rc-subname">(Hyper)</span></div>
          <div class="rc-desc">Setup RTX 4090 TI, kursi gaming premium, layar 240Hz wraparound, dan akses fiber 10Gbps dedicated.</div>
          <div class="rc-tags"><span class="rc-tag">RTX 4090 TI</span><span class="rc-tag">240Hz Screen</span><span class="rc-tag">10Gbps Fiber</span><span class="rc-tag">Surround Sound</span></div>
          <div class="rc-footer">
            <div><div class="rc-price">Rp 3.500.000 <span>/malam</span></div></div>
            <a href="index.php?page=booking" class="rc-cta">Book Now</a>
          </div>
        </div>
      </div>

      <div class="room-card">
        <div class="rc-badge navy">New</div>
        <div class="rc-img"><img src="assets/img/Wpromax.jpg" alt="W Pro Max"></div>
        <div class="rc-body">
          <div class="rc-name">W Pro Max <span class="rc-subname">(Hyper)</span></div>
          <div class="rc-desc">Setup RTX 6090 TI, kursi gaming premium, layar 1000Hz wraparound, dan akses fiber 50Gbps dedicated.</div>
          <div class="rc-tags"><span class="rc-tag">RTX 6090 TI</span><span class="rc-tag">1000Hz Screen</span><span class="rc-tag">50Gbps Fiber</span><span class="rc-tag">Surround Sound</span></div>
          <div class="rc-footer">
            <div><div class="rc-price">Rp 6.500.000 <span>/malam</span></div></div>
            <a href="index.php?page=booking" class="rc-cta">Book Now</a>
          </div>
        </div>
      </div>

      <div class="room-card">
        <div class="rc-badge navy">New</div>
        <div class="rc-img"><img src="assets/img/Fpro.jpg" alt="F Pro"></div>
        <div class="rc-body">
          <div class="rc-name">F Pro <span class="rc-subname">(Hyper)</span></div>
          <div class="rc-desc">Setup RTX 5090 TI, kursi gaming premium, layar 600Hz wraparound, dan akses fiber 20Gbps dedicated.</div>
          <div class="rc-tags"><span class="rc-tag">RTX 5090 TI</span><span class="rc-tag">600Hz Screen</span><span class="rc-tag">20Gbps Fiber</span><span class="rc-tag">Surround Sound</span></div>
          <div class="rc-footer">
            <div><div class="rc-price">Rp 4.500.000 <span>/malam</span></div></div>
            <a href="index.php?page=booking" class="rc-cta">Book Now</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
