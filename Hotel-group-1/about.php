<?php include "config/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About — YFW Haven Grand</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
<style>
:root {
  --black:      #0A0A0A;
  --navy:       #060f1f;
  --card:       #111827;
  --line:       rgba(201,168,76,.15);
  --gold:       #C9A84C;
  --gold-light: #E2C06A;
  --gold-dim:   rgba(201,168,76,.12);
  --white:      #FFFFFF;
  --text:       #E8E0CC;
  --muted:      rgba(255,255,255,.38);
  --serif:      'Cormorant Garamond', Georgia, serif;
  --sans:       'DM Sans', system-ui, sans-serif;
}
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0; }
html { scroll-behavior: smooth; }
body {
  font-family: var(--sans);
  background: var(--navy);
  color: var(--text);
  overflow-x: hidden;
}
a { text-decoration: none; color: inherit; }
img { display: block; width: 100%; height: 100%; object-fit: cover; }

/* ── NAV ── */
.nav {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 100;
  height: 68px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  background: rgba(6,15,31,.88);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--line);
}
.nav-logo {
  font-family: var(--serif);
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--gold);
  letter-spacing: .06em;
}
.nav-back {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .2em;
  text-transform: uppercase;
  color: var(--gold);
  border: 1px solid rgba(201,168,76,.3);
  border-radius: 8px;
  padding: 8px 18px;
  transition: all .2s;
}
.nav-back:hover { background: var(--gold-dim); border-color: var(--gold); }

/* ── HERO ── */
.hero {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 100px 28px 80px;
  position: relative;
}
.orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(130px);
  opacity: .25;
  pointer-events: none;
}
.orb-1 { width:600px; height:600px; background:#C9A84C; top:-200px; left:-200px; }
.orb-2 { width:500px; height:500px; background:#8C6E2F; bottom:-150px; right:-150px; }
.orb-3 { width:350px; height:350px; background:#C9A84C; top:40%; left:55%; }

.hero-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 9.5px;
  font-weight: 700;
  letter-spacing: .26em;
  text-transform: uppercase;
  color: var(--gold);
  border: 1px solid rgba(201,168,76,.3);
  border-radius: 40px;
  padding: 6px 18px;
  margin-bottom: 28px;
}
.hero-title {
  font-family: var(--serif);
  font-size: clamp(3rem, 7vw, 5.5rem);
  font-weight: 300;
  line-height: 1.08;
  color: var(--white);
  margin-bottom: 20px;
}
.hero-title em { color: var(--gold); font-style: italic; }
.hero-sub {
  font-size: 14px;
  color: var(--muted);
  letter-spacing: .08em;
  max-width: 440px;
  margin: 0 auto;
}

/* ── SECTION ── */
.section { padding: 100px 28px; }
.wrap { max-width: 1100px; margin: 0 auto; }

.section-eyebrow {
  font-size: 9px;
  font-weight: 700;
  letter-spacing: .28em;
  text-transform: uppercase;
  color: var(--gold);
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 14px;
}
.section-eyebrow::after {
  content: '';
  flex: 1;
  height: 1px;
  background: var(--line);
  max-width: 80px;
}
.section-title {
  font-family: var(--serif);
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 300;
  color: var(--white);
  margin-bottom: 48px;
}
.section-title em { color: var(--gold); font-style: italic; }

/* ── TEAM GRID ── */
.team-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 28px;
}
@media(max-width:800px) { .team-grid { grid-template-columns: 1fr; } }

.team-card {
  perspective: 1200px;
  height: 440px;
}
.card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  transform-style: preserve-3d;
  transition: transform .8s cubic-bezier(.4,0,.2,1);
  cursor: pointer;
}
.team-card:hover .card-inner { transform: rotateY(180deg); }

.card-front, .card-back {
  position: absolute;
  inset: 0;
  border-radius: 20px;
  backface-visibility: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 32px 24px;
}
.card-front {
  background: rgba(201,168,76,.05);
  border: 1px solid rgba(201,168,76,.15);
  backdrop-filter: blur(20px);
}
.card-back {
  transform: rotateY(180deg);
  background: #111827;
  border: 1px solid rgba(201,168,76,.2);
}
.card-front img {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 22px;
  border: 2px solid var(--gold);
}
.card-name {
  font-family: var(--serif);
  font-size: 1.25rem;
  font-weight: 400;
  color: var(--white);
  margin-bottom: 6px;
  text-align: center;
}
.card-role {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .2em;
  text-transform: uppercase;
  color: var(--gold);
}
.card-back-title {
  font-family: var(--serif);
  font-size: 1.4rem;
  color: var(--gold);
  margin-bottom: 16px;
  text-align: center;
}
.card-back-desc {
  font-size: 13.5px;
  color: var(--muted);
  text-align: center;
  line-height: 1.7;
}
.card-back-quote {
  margin-top: 20px;
  font-family: var(--serif);
  font-size: 1.1rem;
  font-style: italic;
  color: rgba(201,168,76,.6);
  text-align: center;
}

/* ── MISSION ── */
.mission-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
  margin-top: 0;
}
@media(max-width:700px) { .mission-grid { grid-template-columns:1fr; } }

.mission-card {
  background: rgba(201,168,76,.04);
  border: 1px solid rgba(201,168,76,.12);
  border-radius: 16px;
  padding: 32px;
}
.mission-icon {
  font-size: 2rem;
  margin-bottom: 16px;
}
.mission-head {
  font-family: var(--serif);
  font-size: 1.4rem;
  font-weight: 400;
  color: var(--white);
  margin-bottom: 10px;
}
.mission-text {
  font-size: 13.5px;
  color: var(--muted);
  line-height: 1.75;
}

/* ── STAT ROW ── */
.stat-strip {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: 2px;
  background: var(--line);
  border-radius: 16px;
  overflow: hidden;
  margin-top: 80px;
}
@media(max-width:700px) { .stat-strip { grid-template-columns: 1fr 1fr; } }

.stat-item {
  background: var(--card);
  padding: 36px 24px;
  text-align: center;
}
.stat-num {
  font-family: var(--serif);
  font-size: 3rem;
  font-weight: 300;
  color: var(--gold);
  display: block;
  line-height: 1;
  margin-bottom: 8px;
}
.stat-lbl {
  font-size: 9.5px;
  font-weight: 700;
  letter-spacing: .2em;
  text-transform: uppercase;
  color: var(--muted);
}

/* ── DIVIDER ── */
.gold-line {
  width: 60px;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--gold), transparent);
  margin: 0 auto 60px;
}
</style>
</head>
<body>

<!-- Nav -->
<nav class="nav">
  <div class="nav-logo">YFW Haven Grand</div>
  <a href="index.php" class="nav-back">← Return to Portal</a>
</nav>

<!-- Hero -->
<section class="hero">
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>
  <div class="hero-tag">✦ The Architects</div>
  <h1 class="hero-title">Meet the <em>Minds</em><br>Behind YFW</h1>
  <p class="hero-sub">Three visionaries building the future of luxury hospitality.</p>
</section>

<!-- Team -->
<section class="section" style="padding-top:20px;">
  <div class="wrap">
    <div class="section-eyebrow">Our Team</div>
    <h2 class="section-title">The <em>Architects</em></h2>
    <div class="team-grid">

      <div class="team-card">
        <div class="card-inner">
          <div class="card-front">
            <img src="assets/img/yari.jpg" alt="Yarisunal Firdaus">
            <div class="card-name">Yarisunal Firdaus</div>
            <div class="card-role">Project Manager</div>
          </div>
          <div class="card-back">
            <div class="card-back-title">Project Manager</div>
            <div class="card-back-desc">Vision holder and strategic architect of the YFW experience. Bridges the gap between luxury and bleeding-edge technology.</div>
            <div class="card-back-quote">"The future should feel inevitable."</div>
          </div>
        </div>
      </div>

      <div class="team-card">
        <div class="card-inner">
          <div class="card-front">
            <img src="assets/img/fariel.jpeg" alt="M. Fariel Abda">
            <div class="card-name">M. Fariel Abda</div>
            <div class="card-role">Data & Assets Survey</div>
          </div>
          <div class="card-back">
            <div class="card-back-title">Data Specialist</div>
            <div class="card-back-desc">Transforms raw data into operational insights. Responsible for asset valuation, market research, and site intelligence across all nodes.</div>
            <div class="card-back-quote">"Data is the new gold."</div>
          </div>
        </div>
      </div>

      <div class="team-card">
        <div class="card-inner">
          <div class="card-front">
            <img src="assets/img/wida.jpg" alt="Wida Sultan Utama Iryon">
            <div class="card-name">Wida Sultan Utama Iryon</div>
            <div class="card-role">Backend Developer</div>
          </div>
          <div class="card-back">
            <div class="card-back-title">Backend Developer</div>
            <div class="card-back-desc">The engine room of YFW. Designs every database relationship, API flow, and system logic that keeps the hotel running at peak performance.</div>
            <div class="card-back-quote">"Build the system that builds itself."</div>
          </div>
        </div>
      </div>

    </div>

    <!-- Stats -->
    <div class="stat-strip">
      <div class="stat-item"><span class="stat-num">3</span><div class="stat-lbl">Founders</div></div>
      <div class="stat-item"><span class="stat-num">8</span><div class="stat-lbl">Global Nodes</div></div>
      <div class="stat-item"><span class="stat-num">105</span><div class="stat-lbl">Total Rooms</div></div>
      <div class="stat-item"><span class="stat-num">2026</span><div class="stat-lbl">Founded</div></div>
    </div>
  </div>
</section>

<!-- Mission -->
<section class="section" style="background:rgba(201,168,76,.02);border-top:1px solid rgba(201,168,76,.08);border-bottom:1px solid rgba(201,168,76,.08);">
  <div class="wrap">
    <div class="section-eyebrow">Why We Exist</div>
    <h2 class="section-title">Our <em>Mission</em></h2>
    <div class="mission-grid">
      <div class="mission-card">
        <div class="mission-icon">🌍</div>
        <div class="mission-head">World-Class Nodes</div>
        <div class="mission-text">YFW Haven Grand operates across 8 global cities — each node carefully chosen for economic momentum, tech adoption, and luxury demand. From Jakarta HQ to Milan.</div>
      </div>
      <div class="mission-card">
        <div class="mission-icon">🤖</div>
        <div class="mission-head">AI-First Hospitality</div>
        <div class="mission-text">Every room is powered by adaptive AI — from facial recognition at check-in to AI butlers that learn your preferences. Technology is not a feature, it's the experience.</div>
      </div>
      <div class="mission-card">
        <div class="mission-icon">✦</div>
        <div class="mission-head">Luxury Without Compromise</div>
        <div class="mission-text">We refuse to choose between cutting-edge technology and timeless luxury. YFW is the only hotel brand where RTX 6090 TI gaming rigs share space with panoramic bathtubs.</div>
      </div>
      <div class="mission-card">
        <div class="mission-icon">🔐</div>
        <div class="mission-head">Private & Secure</div>
        <div class="mission-text">Enterprise-grade security at every node. Biometric access, end-to-end encrypted communications, and private fiber infrastructure. Your stay is yours alone.</div>
      </div>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>

<script>
/* 3D tilt on team cards */
document.querySelectorAll('.team-card').forEach(card => {
  const inner = card.querySelector('.card-inner');
  card.addEventListener('mousemove', e => {
    if (inner.style.transform.includes('180')) return;
    const r = card.getBoundingClientRect();
    const x = e.clientX - r.left - r.width / 2;
    const y = e.clientY - r.top  - r.height / 2;
    inner.style.transform = `rotateY(${x/20}deg) rotateX(${-y/20}deg)`;
  });
  card.addEventListener('mouseleave', () => {
    if (!inner.style.transform.includes('180')) inner.style.transform = '';
  });
});
</script>
</body>
</html>
