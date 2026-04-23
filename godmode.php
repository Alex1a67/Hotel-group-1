<?php
$city = htmlspecialchars($_GET['city'] ?? 'Jakarta');

$cityData = [
  'Jakarta' => [
    'country'  => 'Indonesia',
    'region'   => 'Asia Pacific',
    'flag'     => '🇮🇩',
    'status'   => 'HQ — Operational',
    'score'    => 98,
    'badge'    => 'HEADQUARTERS',
    'badge_clr'=> '#C9A84C',
    'coords'   => '-6.2088, 106.8456',
    'why' => [
      ['','Largest City in SEA', 'Jakarta has 34M+ metro population — Southeast Asia\'s largest urban economy and the home of Indonesia\'s tech startup ecosystem.'],
      ['','GDP Growth 5.1%', 'Indonesia\'s GDP growth consistently outperforms regional averages. The luxury hospitality sector has grown 23% year-on-year.'],
      ['','Hub Airport', 'Soekarno-Hatta International serves 65M+ passengers annually with direct routes to 120+ destinations worldwide.'],
      ['','Business District Demand', 'SCBD and Sudirman corridors host HQs of 8 of the 10 largest companies in SEA — prime corporate guest demand.'],
    ],
    'risks'   => ['Traffic congestion may affect accessibility', 'High competition from established luxury brands'],
    'recommend'=> 'Flagship property in SCBD. Minimum 200 rooms, conference facilities, rooftop experience. Target: C-suite corporate guests + tech elite.',
    'roi_est'  => '38–45%',
    'timeline' => '12–18 months to full operation',
  ],
  'Singapore' => [
    'country'  => 'Singapore',
    'region'   => 'Asia Pacific',
    'flag'     => '🇸🇬',
    'status'   => 'Active Node',
    'score'    => 95,
    'badge'    => 'PRIORITY NODE',
    'badge_clr'=> '#27AE60',
    'coords'   => '1.3521, 103.8198',
    'why' => [
      ['','Global Financial Hub', 'Singapore ranks #1 in Asia for ease of doing business and hosts 7,000+ multinational companies — unmatched corporate guest base.'],
      ['','Luxury Spend Index #1', 'Highest luxury hospitality spend per capita in SEA. Average room rate for luxury properties exceeds $600 USD/night.'],
      ['','Political Stability AAA', 'Triple-A rated stability — critical for long-term property investment and brand positioning.'],
      ['','Changi Connectivity', 'Changi Airport consistently rated world\'s best. Singapore is the transit hub of Asia — massive transit guest potential.'],
    ],
    'risks'   => ['Extremely high real estate acquisition costs', 'Strict regulatory environment for hospitality licensing'],
    'recommend'=> 'Boutique ultra-luxury node in Marina Bay or Orchard district. 80–120 rooms, exclusive F Pro and W Pro Max tiers only. Position as Asia\'s most exclusive AI hotel.',
    'roi_est'  => '42–55%',
    'timeline' => '18–24 months, including licensing',
  ],
  'Tokyo' => [
    'country'  => 'Japan',
    'region'   => 'Asia Pacific',
    'flag'     => '🇯🇵',
    'status'   => 'Active Node',
    'score'    => 91,
    'badge'    => 'TECH NODE',
    'badge_clr'=> '#3498DB',
    'coords'   => '35.6762, 139.6503',
    'why' => [
      ['','Technology Capital of Asia', 'Tokyo is globally synonymous with cutting-edge technology — a perfect brand alignment for YFW\'s AI-first hospitality concept.'],
      ['','Gaming & Esports Market', 'Japan\'s gaming culture is world-leading. Y Premium and F Pro rooms would find their highest-value audience here.'],
      ['','Tourism Recovery Boom', 'Japan received 25M+ international tourists in 2024 with government targets of 60M by 2030.'],
      ['','Premium Brand Receptivity', 'Japanese consumers are among the most quality-conscious in the world — premium pricing commands premium loyalty.'],
    ],
    'risks'   => ['Language barrier for non-Japanese management', 'High operational cost structure', 'Complex regulatory landscape'],
    'recommend'=> 'Shibuya or Shinjuku node. 100–150 rooms emphasising Y Premium and gaming tiers. AI butler fully localised in Japanese. Partnership with local tech firms for authenticity.',
    'roi_est'  => '35–42%',
    'timeline' => '20–28 months',
  ],
  'Seoul' => [
    'country'  => 'South Korea',
    'region'   => 'Asia Pacific',
    'flag'     => '🇰🇷',
    'status'   => 'Active Node',
    'score'    => 88,
    'badge'    => 'EMERGING NODE',
    'badge_clr'=> '#9B59B6',
    'coords'   => '37.5665, 126.9780',
    'why' => [
      ['','Fastest 5G Adoption Globally', 'Korea\'s 5G infrastructure is the world\'s most advanced — ideal for YFW\'s high-bandwidth room technology stack.'],
      ['','K-Wave Cultural Power', 'Seoul\'s global cultural influence drives premium tourism from East Asia, Europe, and the Americas at accelerating rates.'],
      ['','Gangnam Luxury District', 'Gangnam-gu has one of the highest luxury retail densities in the world — natural demand overlap with YFW\'s demographic.'],
      ['','Esports Capital', 'Seoul hosted the first dedicated esports stadium. Y Premium and F Pro rooms position perfectly for this market.'],
    ],
    'risks'   => ['Geopolitical proximity risk (DPRK)', 'Highly competitive domestic hotel market'],
    'recommend'=> 'Gangnam district, 120–160 rooms. Heavy gaming-tier emphasis. AI systems in Korean. Target K-pop industry, esports professionals, and corporate tech guests.',
    'roi_est'  => '32–40%',
    'timeline' => '16–22 months',
  ],
  'Dubai' => [
    'country'  => 'UAE',
    'region'   => 'Middle East',
    'flag'     => '🇦🇪',
    'status'   => 'Active Node',
    'score'    => 93,
    'badge'    => 'LUXURY GATEWAY',
    'badge_clr'=> '#C9A84C',
    'coords'   => '25.2048, 55.2708',
    'why' => [
      ['','Highest Luxury ADR in World', 'Dubai\'s luxury hotels command the highest average daily rates globally — YFW\'s top tiers (W Pro Max at Rp 6.5M) would be competitively priced here.'],
      ['','Global Crossroads', '90+ nationalities live in Dubai. It\'s the connective tissue of travel between Asia, Europe, and Africa — unrivalled transit guest capture.'],
      ['','Zero-Tax Business Environment', 'Dubai\'s tax-free corporate structure dramatically improves operational margins compared to any other node city.'],
      ['','Expo 2030 Legacy Growth', 'Post-Expo infrastructure and government investment is driving sustained luxury hospitality demand through 2035.'],
    ],
    'risks'   => ['Cultural sensitivity considerations for certain room features', 'High competition from globally-established ultra-luxury brands'],
    'recommend'=> 'Downtown Dubai or DIFC node. 150–180 rooms, all tiers, with enhanced privacy features for VIP guests. W Suite and W Pro Max as primary revenue drivers. Partner with Emirates for premium guest referrals.',
    'roi_est'  => '48–60%',
    'timeline' => '14–20 months',
  ],
  'Paris' => [
    'country'  => 'France',
    'region'   => 'Europe',
    'flag'     => '🇫🇷',
    'status'   => 'Active Node',
    'score'    => 89,
    'badge'    => 'CULTURE NODE',
    'badge_clr'=> '#E74C3C',
    'coords'   => '48.8566, 2.3522',
    'why' => [
      ['','Most Visited City on Earth', 'Paris receives 45M+ tourists annually — the single largest inbound tourism market in Europe.'],
      ['','Luxury Capital of the World', 'LVMH, Hermès, Chanel — Paris is where luxury is defined. YFW\'s positioning as tech-luxury finds its most receptive audience here.'],
      ['','Conference & Events Market', 'Paris hosts more international conferences than any other city. Corporate guest demand is year-round and high-yield.'],
      ['🇪🇺','EU Market Gateway', 'A Paris node serves as the gateway to the EU market — positioning for future expansion to Amsterdam, Berlin, and beyond.'],
    ],
    'risks'   => ['High labour costs and strong worker protections', 'Strict historic building preservation laws may limit development options', 'Seasonal tourism fluctuation'],
    'recommend'=> '8th or 16th arrondissement. 100–140 rooms. Emphasise W Suite and F Room for business travellers. Design must respect Haussmann architectural context while delivering futurist interiors. Partner with luxury concierge services.',
    'roi_est'  => '33–41%',
    'timeline' => '24–30 months (planning permissions)',
  ],
  'London' => [
    'country'  => 'United Kingdom',
    'region'   => 'Europe',
    'flag'     => '🇬🇧',
    'status'   => 'Active Node',
    'score'    => 90,
    'badge'    => 'FINANCE NODE',
    'badge_clr'=> '#2ECC71',
    'coords'   => '51.5074, -0.1278',
    'why' => [
      ['','Global Financial Capital', 'London\'s financial sector generates massive corporate travel demand 52 weeks a year — the most resilient market for luxury business hotels.'],
      ['','Tech Hub — Silicon Roundabout', 'London\'s Tech City is Europe\'s largest tech cluster. YFW\'s AI-first concept aligns perfectly with the city\'s innovation identity.'],
      ['','Heathrow — World\'s Busiest Hub', 'Heathrow connects London to 200+ destinations. Transit and layover luxury guest capture is significant.'],
      ['','Cultural Gravity', 'London\'s global cultural influence ensures a diverse, high-spending international guest mix year-round.'],
    ],
    'risks'   => ['Post-Brexit regulatory complexity for EU guests', 'Extremely high property acquisition costs in central zones', 'High corporate tax environment'],
    'recommend'=> 'Mayfair or Canary Wharf node. 120–160 rooms. F Room and W Suite primary tiers targeting finance professionals. Smart room tech pitched as productivity tool for high-powered guests.',
    'roi_est'  => '36–44%',
    'timeline' => '22–28 months',
  ],
  'Milan' => [
    'country'  => 'Italy',
    'region'   => 'Europe',
    'flag'     => '🇮🇹',
    'status'   => 'Active Node',
    'score'    => 83,
    'badge'    => 'DESIGN NODE',
    'badge_clr'=> '#1ABC9C',
    'coords'   => '45.4642, 9.1900',
    'why' => [
      ['','Fashion & Design Capital', 'Milan hosts the world\'s premier fashion weeks and design fairs (Salone del Mobile). Seasonal luxury demand spikes are exceptional.'],
      ['','Innovation & Manufacturing', 'Northern Italy\'s industrial corridor houses Europe\'s most innovative manufacturing ecosystem — B2B corporate demand is strong.'],
      ['','Luxury F&B Tourism', 'Italy\'s culinary reputation drives high-spend lifestyle tourism year-round. YFW\'s hospitality concept complements this cultural draw.'],
      ['','Design Credibility', 'A Milan node instantly elevates YFW\'s design credibility — being seen alongside the world\'s most respected design brands.'],
    ],
    'risks'   => ['Lower room rate ceiling vs. London/Paris/Dubai', 'Bureaucratic property development process in Italy', 'Smaller corporate base compared to other European nodes'],
    'recommend'=> 'Porta Nuova or Brera district. 80–100 rooms. Emphasise design-forward W Suite as flagship. Target fashion, design, and F&B industry professionals. Seasonal pricing strategy for fashion week periods.',
    'roi_est'  => '28–36%',
    'timeline' => '26–34 months',
  ],
];

$d = $cityData[$city] ?? $cityData['Jakarta'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>GodMode — <?= $city ?> | YFW Haven Grand</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
<style>
:root {
  --navy:#060f1f; --deep:#030a14; --card:#0d1a2b; --card2:#0f1e30;
  --line:rgba(201,168,76,.14); --gold:#C9A84C; --gold-dim:rgba(201,168,76,.1);
  --gold-light:#E2C06A; --white:#fff; --text:#E8E0CC; --muted:rgba(255,255,255,.4);
  --serif:'Cormorant Garamond',Georgia,serif; --sans:'DM Sans',system-ui,sans-serif;
  --success:#27AE60; --danger:#E74C3C;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:var(--sans);background:var(--deep);color:var(--text);overflow-x:hidden;min-height:100vh;}
a{text-decoration:none;color:inherit;}

/* scan-line overlay for godmode feel */
body::before {
  content:'';
  position:fixed;
  inset:0;
  background: repeating-linear-gradient(0deg,transparent,transparent 2px,rgba(201,168,76,.012) 2px,rgba(201,168,76,.012) 4px);
  pointer-events:none;
  z-index:0;
}

/* ── NAV ── */
.nav {
  position:fixed;top:0;left:0;right:0;z-index:100;
  height:64px;display:flex;align-items:center;justify-content:space-between;
  padding:0 36px;
  background:rgba(3,10,20,.92);backdrop-filter:blur(24px);
  border-bottom:1px solid var(--line);
}
.nav-left { display:flex;align-items:center;gap:16px; }
.nav-badge {
  font-size:8.5px;font-weight:800;letter-spacing:.25em;text-transform:uppercase;
  padding:4px 12px;border-radius:4px;
  background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.3);
  color:var(--gold);
}
.nav-logo { font-family:var(--serif);font-size:1rem;font-weight:600;color:var(--gold);letter-spacing:.06em; }
.nav-close {
  font-size:10px;font-weight:700;letter-spacing:.18em;text-transform:uppercase;
  color:var(--muted);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:7px 16px;
  transition:all .2s;
}
.nav-close:hover{color:var(--gold);border-color:rgba(201,168,76,.3);}

/* ── HERO BAND ── */
.hero-band {
  padding: 100px 36px 56px;
  position:relative;
  border-bottom:1px solid var(--line);
  background: linear-gradient(180deg, rgba(201,168,76,.04) 0%, transparent 100%);
}
.hero-band::before {
  content:''; position:absolute;
  top:0;left:0;right:0;height:1px;
  background:linear-gradient(90deg,transparent,var(--gold) 40%,var(--gold) 60%,transparent);
}
.hero-inner { max-width:1200px;margin:0 auto; }

.city-flag { font-size:3.5rem;margin-bottom:16px;display:block; }
.city-eyebrow {
  font-size:9px;font-weight:700;letter-spacing:.28em;text-transform:uppercase;
  color:var(--gold);margin-bottom:12px;display:flex;align-items:center;gap:10px;
}
.city-eyebrow::after{content:'';flex:0 0 40px;height:1px;background:rgba(201,168,76,.3);}
.city-title {
  font-family:var(--serif);font-size:clamp(3rem,6vw,5rem);font-weight:300;
  color:var(--white);line-height:1.05;margin-bottom:6px;
}
.city-title em{color:var(--gold);font-style:italic;}
.city-country{font-size:13px;color:var(--muted);letter-spacing:.08em;margin-bottom:28px;}

.city-meta {
  display:flex;align-items:center;gap:20px;flex-wrap:wrap;
}
.meta-chip {
  display:flex;align-items:center;gap:8px;
  background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);
  border-radius:8px;padding:8px 14px;font-size:11.5px;color:var(--muted);
}
.meta-chip strong{color:var(--text);}
.status-badge {
  font-size:9px;font-weight:800;letter-spacing:.2em;text-transform:uppercase;
  padding:6px 14px;border-radius:6px;
  background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.25);
  color:var(--gold);
}

/* Score ring */
.score-ring {
  position:relative;width:100px;height:100px;flex-shrink:0;
  margin-left:auto;
}
.score-ring svg { transform:rotate(-90deg); }
.score-ring circle { fill:none; stroke-width:7; }
.ring-bg { stroke: rgba(255,255,255,.06); }
.ring-fill { stroke:var(--gold);stroke-linecap:round;transition:stroke-dashoffset 1s cubic-bezier(.4,0,.2,1); }
.score-num {
  position:absolute;inset:0;display:flex;flex-direction:column;
  align-items:center;justify-content:center;
  font-family:var(--serif);font-size:1.8rem;color:var(--gold);line-height:1;
}
.score-lbl{font-family:var(--sans);font-size:8.5px;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;}

/* ── BODY GRID ── */
.body-grid {
  max-width:1200px;margin:0 auto;padding:56px 36px 80px;
  display:grid;grid-template-columns:1fr 360px;gap:32px;
  position:relative;z-index:1;
}
@media(max-width:900px){ .body-grid{grid-template-columns:1fr;} }

/* ── SECTION BLOCK ── */
.sec {
  background:var(--card);border:1px solid var(--line);border-radius:16px;
  margin-bottom:24px;overflow:hidden;
}
.sec-head {
  padding:20px 26px;border-bottom:1px solid var(--line);
  display:flex;align-items:center;gap:12px;
}
.sec-title {
  font-family:var(--serif);font-size:1.25rem;font-weight:400;color:var(--white);
}
.sec-title span{color:var(--gold);}
.sec-body{padding:26px;}

/* ── WHY CARDS ── */
.why-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
@media(max-width:640px){.why-grid{grid-template-columns:1fr;}}
.why-card{
  background:rgba(201,168,76,.03);border:1px solid rgba(201,168,76,.1);
  border-radius:12px;padding:22px 20px;
}
.why-icon{font-size:1.6rem;margin-bottom:10px;}
.why-head{font-family:var(--serif);font-size:1.1rem;color:var(--white);margin-bottom:6px;}
.why-text{font-size:12.5px;color:var(--muted);line-height:1.7;}

/* ── RISKS ── */
.risk-item{
  display:flex;align-items:flex-start;gap:12px;
  padding:12px 0;border-bottom:1px solid rgba(255,255,255,.04);
  font-size:13px;color:var(--muted);line-height:1.6;
}
.risk-item:last-child{border-bottom:none;}
.risk-icon{color:#E74C3C;flex-shrink:0;margin-top:2px;}

/* ── RECOMMEND BOX ── */
.rec-box{
  background:linear-gradient(135deg,rgba(201,168,76,.08),rgba(201,168,76,.03));
  border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:24px;
  font-size:13.5px;color:var(--text);line-height:1.75;
}
.rec-label{
  font-size:9px;font-weight:700;letter-spacing:.22em;text-transform:uppercase;
  color:var(--gold);margin-bottom:12px;
}

/* ── SIDEBAR ── */
.sidebar{display:flex;flex-direction:column;gap:24px;}

.kpi-card{
  background:var(--card);border:1px solid var(--line);border-radius:16px;padding:24px;
}
.kpi-label{font-size:9px;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:var(--muted);margin-bottom:8px;}
.kpi-value{font-family:var(--serif);font-size:2.2rem;font-weight:300;color:var(--gold);line-height:1;}
.kpi-sub{font-size:11px;color:var(--muted);margin-top:4px;}

.node-map{
  background:var(--card);border:1px solid var(--line);border-radius:16px;overflow:hidden;
}
.node-map-head{padding:16px 22px;border-bottom:1px solid var(--line);}
.node-map-title{font-family:var(--serif);font-size:1.1rem;color:var(--white);}
.node-map-title span{color:var(--gold);}

/* globe SVG canvas */
.globe-wrap{padding:20px;display:flex;flex-direction:column;align-items:center;gap:10px;}
canvas#globeCanvas{border-radius:50%;display:block;}
.coords-text{font-size:10px;color:var(--muted);letter-spacing:.08em;font-family:monospace;}

/* Other cities */
.other-nodes{padding:0 20px 20px;}
.other-label{font-size:9px;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:var(--muted);margin-bottom:12px;}
.other-grid{display:flex;flex-wrap:wrap;gap:6px;}
.other-chip{
  font-size:10.5px;color:var(--muted);
  background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);
  border-radius:6px;padding:5px 11px;cursor:pointer;transition:all .2s;
}
.other-chip:hover{color:var(--gold);border-color:rgba(201,168,76,.3);background:rgba(201,168,76,.06);}
.other-chip.active-city{color:var(--gold);border-color:rgba(201,168,76,.4);background:rgba(201,168,76,.08);}

/* ── CTA ── */
.cta-bar{
  max-width:1200px;margin:0 auto;padding:0 36px 60px;
  position:relative;z-index:1;
}
.cta-inner{
  background:linear-gradient(135deg,rgba(201,168,76,.08),rgba(201,168,76,.03));
  border:1px solid rgba(201,168,76,.2);border-radius:16px;
  padding:36px 40px;display:flex;align-items:center;justify-content:space-between;gap:24px;
}
@media(max-width:640px){.cta-inner{flex-direction:column;align-items:flex-start;}}
.cta-text h3{font-family:var(--serif);font-size:1.6rem;color:var(--white);margin-bottom:6px;}
.cta-text p{font-size:13px;color:var(--muted);}
.cta-btns{display:flex;gap:12px;flex-shrink:0;}
.btn-gold{
  background:var(--gold);color:#030a14;
  font-size:10.5px;font-weight:800;letter-spacing:.18em;text-transform:uppercase;
  padding:12px 24px;border-radius:9px;border:none;cursor:pointer;transition:all .2s;
  text-decoration:none;display:inline-flex;align-items:center;gap:6px;
}
.btn-gold:hover{background:var(--gold-light);}
.btn-outline{
  background:transparent;color:var(--gold);
  font-size:10.5px;font-weight:700;letter-spacing:.16em;text-transform:uppercase;
  padding:12px 24px;border-radius:9px;border:1px solid rgba(201,168,76,.3);
  cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;
}
.btn-outline:hover{border-color:var(--gold);background:rgba(201,168,76,.06);}
</style>
</head>
<body>

<!-- Nav -->
<nav class="nav">
  <div class="nav-left">
    <div class="nav-badge"> GODMODE</div>
    <div class="nav-logo">YFW Haven Grand</div>
  </div>
  <a href="javascript:window.close()" class="nav-close">✕ Close</a>
</nav>

<!-- Hero Band -->
<div class="hero-band">
  <div class="hero-inner">
    <span class="city-flag"><?= $d['flag'] ?></span>
    <div class="city-eyebrow">Branch Strategy Analysis</div>
    <h1 class="city-title"><?= $city ?>, <em><?= $d['country'] ?></em></h1>
    <div class="city-country"><?= $d['region'] ?> &nbsp;·&nbsp; Coordinates: <?= $d['coords'] ?></div>

    <div class="city-meta">
      <div class="status-badge" style="background:<?= $d['badge_clr'] ?>18;border-color:<?= $d['badge_clr'] ?>44;color:<?= $d['badge_clr'] ?>;">
        <?= $d['badge'] ?>
      </div>
      <div class="meta-chip">Status: <strong><?= $d['status'] ?></strong></div>
      <div class="meta-chip">Est. ROI: <strong style="color:var(--gold);"><?= $d['roi_est'] ?></strong></div>
      <div class="meta-chip">Timeline: <strong><?= $d['timeline'] ?></strong></div>

      <!-- Score Ring -->
      <div class="score-ring" id="scoreRing">
        <svg width="100" height="100" viewBox="0 0 100 100">
          <circle class="ring-bg" cx="50" cy="50" r="44"/>
          <circle class="ring-fill" cx="50" cy="50" r="44"
            stroke-dasharray="276.46"
            stroke-dashoffset="<?= 276.46 - (276.46 * $d['score'] / 100) ?>"
            id="ringFill"/>
        </svg>
        <div class="score-num">
          <?= $d['score'] ?>
          <div class="score-lbl">Score</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Body -->
<div class="body-grid">

  <!-- LEFT COLUMN -->
  <div>

    <!-- Why This City -->
    <div class="sec">
      <div class="sec-head">
        <div class="sec-title">Why <span><?= $city ?></span></div>
      </div>
      <div class="sec-body">
        <div class="why-grid">
          <?php foreach ($d['why'] as $w): ?>
          <div class="why-card">
            <div class="why-icon"><?= $w[0] ?></div>
            <div class="why-head"><?= $w[1] ?></div>
            <div class="why-text"><?= $w[2] ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Risk Analysis -->
    <div class="sec">
      <div class="sec-head">
        <div class="sec-title">Risk <span>Factors</span></div>
      </div>
      <div class="sec-body">
        <?php foreach ($d['risks'] as $r): ?>
        <div class="risk-item">
          <span class="risk-icon"></span>
          <span><?= $r ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Recommendation -->
    <div class="sec">
      <div class="sec-head">
        <div class="sec-title">YFW <span>Recommendation</span></div>
      </div>
      <div class="sec-body">
        <div class="rec-label">Strategic Directive</div>
        <div class="rec-box"><?= $d['recommend'] ?></div>
      </div>
    </div>

  </div>

  <!-- RIGHT SIDEBAR -->
  <div class="sidebar">

    <div class="kpi-card">
      <div class="kpi-label">Estimated ROI</div>
      <div class="kpi-value"><?= $d['roi_est'] ?></div>
      <div class="kpi-sub">Projected annual return on investment</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label">Development Timeline</div>
      <div class="kpi-value" style="font-size:1.6rem;"><?= $d['timeline'] ?></div>
      <div class="kpi-sub">From site acquisition to full operation</div>
    </div>

    <div class="kpi-card">
      <div class="kpi-label">Strategic Score</div>
      <div class="kpi-value"><?= $d['score'] ?><span style="font-size:1.2rem;color:var(--muted);">/100</span></div>
      <div class="kpi-sub">YFW Branch Viability Index</div>
    </div>

    <!-- Other Nodes + Map -->
    <div class="node-map">
      <div class="node-map-head">
        <div class="node-map-title"> <span><?= $city ?></span> Location</div>
      </div>
      <!-- Google Maps Embed -->
      <?php
        $coords = $d['coords']; // e.g. "1.3521, 103.8198"
        [$lat, $lng] = array_map('trim', explode(',', $coords));
        $mapUrl = "https://maps.google.com/maps?q={$lat},{$lng}&z=13&output=embed";
        $mapsLink = "https://www.google.com/maps?q={$lat},{$lng}&z=13";
      ?>
      <div style="position:relative;">
        <iframe
          src="<?= $mapUrl ?>"
          width="100%"
          height="220"
          style="border:0;display:block;filter:invert(90%) hue-rotate(180deg) saturate(0.8);"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <a href="<?= $mapsLink ?>" target="_blank"
           style="position:absolute;bottom:10px;right:10px;background:rgba(201,168,76,.92);color:#030a14;font-size:9.5px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;padding:6px 12px;border-radius:7px;text-decoration:none;backdrop-filter:blur(4px);">
          Open in Maps ↗
        </a>
      </div>
      <div style="padding:10px 18px 4px;display:flex;align-items:center;gap:8px;">
        <span style="font-size:10px;color:var(--muted);font-family:monospace;letter-spacing:.08em;"><?= $coords ?></span>
      </div>

      <!-- Switch City -->
      <div class="other-nodes" style="padding:14px 18px 16px;">
        <div class="other-label">Switch Node</div>
        <div class="other-grid">
          <?php
          $allCities = ['Jakarta','Singapore','Tokyo','Seoul','Dubai','Paris','London','Milan'];
          foreach ($allCities as $c):
            $isActive = $c === $city ? 'active-city' : '';
          ?>
          <div class="other-chip <?= $isActive ?>"
               onclick="window.location.href='godmode.php?city=<?= $c ?>'">
            <?= $cityData[$c]['flag'] ?> <?= $c ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- CTA Bar -->
<div class="cta-bar">
  <div class="cta-inner">
    <div class="cta-text">
      <h3>Ready to expand to <?= $city ?>?</h3>
      <p>Return to the portal to manage active operations or view the full node network.</p>
    </div>
    <div class="cta-btns">
      <a href="index.php" class="btn-gold">Return to Portal</a>
      <a href="about.php" class="btn-outline">Meet the Team</a>
    </div>
  </div>
</div>

<script>
/* Animate score ring on load */
window.addEventListener('load', () => {
  const fill   = document.getElementById('ringFill');
  const score  = <?= $d['score'] ?>;
  const circ   = 276.46;
  const offset = circ - (circ * score / 100);
  fill.style.transition = 'stroke-dashoffset 1.2s cubic-bezier(.4,0,.2,1)';
  fill.style.strokeDashoffset = circ;
  requestAnimationFrame(() => {
    requestAnimationFrame(() => { fill.style.strokeDashoffset = offset; });
  });
});

/* Page fade-in */
document.body.style.opacity = '0';
document.body.style.transition = 'opacity .4s';
window.addEventListener('load', () => { document.body.style.opacity = '1'; });
</script>
</body>
</html>
