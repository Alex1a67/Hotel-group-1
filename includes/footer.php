<style>
.site-footer {
  background: #4b4a03;
  border-top: 1px solid rgba(201,168,76,.18);
  padding: 64px 0 0;
  margin-top: 80px;
  font-family: 'DM Sans', system-ui, sans-serif;
  position: relative;
  overflow: hidden;
}
.site-footer::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, #C9A84C 30%, #C9A84C 70%, transparent);
}
.footer-inner {
  max-width: 1240px;
  margin: 0 auto;
  padding: 0 28px;
  display: grid;
  grid-template-columns: 1.6fr 1fr 1fr 1.4fr;
  gap: 48px;
  align-items: start;
}
.footer-logo {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: 1.5rem;
  font-weight: 600;
  color: #C9A84C;
  letter-spacing: .06em;
  margin-bottom: 10px;
}
.footer-tagline {
  font-size: 12.5px;
  color: rgba(255,255,255,.4);
  line-height: 1.7;
  max-width: 220px;
  letter-spacing: .02em;
}
.footer-col-title {
  font-size: 9px;
  font-weight: 700;
  letter-spacing: .28em;
  text-transform: uppercase;
  color: #C9A84C;
  margin-bottom: 18px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.footer-col-title::after {
  content: '';
  flex: 1;
  height: 1px;
  background: rgba(201,168,76,.2);
}
.footer-nodes {
  display: flex;
  flex-wrap: wrap;
  gap: 8px 0;
  align-items: center;
}
.node-link {
  font-size: 12.5px;
  color: rgba(255,255,255,.5);
  letter-spacing: .03em;
  transition: color .2s;
  white-space: nowrap;
  text-decoration: none;
  cursor: pointer;
}
.node-link:hover { color: #C9A84C; }
.node-dot { color: rgba(201,168,76,.35); margin: 0 8px; font-size: 10px; }
.node-hq {
  font-size: 8.5px;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: #C9A84C;
  background: rgba(201,168,76,.1);
  border: 1px solid rgba(201,168,76,.25);
  border-radius: 4px;
  padding: 1px 6px;
  margin-left: 5px;
  vertical-align: middle;
}
.newsletter-form {
  display: flex;
  gap: 0;
  margin-top: 2px;
}
.newsletter-input {
  flex: 1;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(201,168,76,.2);
  border-right: none;
  border-radius: 8px 0 0 8px;
  color: rgba(255,255,255,.7);
  font-family: 'DM Sans', sans-serif;
  font-size: 12px;
  padding: 10px 14px;
  outline: none;
  transition: border-color .2s;
  min-width: 0;
}
.newsletter-input::placeholder { color: rgba(255,255,255,.25); }
.newsletter-input:focus { border-color: rgba(201,168,76,.5); }
.newsletter-btn {
  background: #C9A84C;
  border: none;
  border-radius: 0 8px 8px 0;
  color: #060f1f;
  font-family: 'DM Sans', sans-serif;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .18em;
  text-transform: uppercase;
  padding: 10px 16px;
  cursor: pointer;
  transition: background .2s;
}
.newsletter-btn:hover { background: #E2C06A; }
.footer-divider {
  max-width: 1240px;
  margin: 48px auto 0;
  padding: 0 28px;
  border: none;
  border-top: 1px solid rgba(255,255,255,.06);
}
.footer-bottom {
  max-width: 1240px;
  margin: 0 auto;
  padding: 20px 28px 28px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
}
.footer-copy { font-size: 11px; color: rgba(255,255,255,.2); letter-spacing: .05em; }
.footer-links { display: flex; gap: 28px; }
.footer-links a {
  font-size: 11px;
  color: rgba(255,255,255,.3);
  letter-spacing: .08em;
  text-decoration: none;
  transition: color .2s;
}
.footer-links a:hover { color: #C9A84C; }
@media (max-width:900px) {
  .footer-inner { grid-template-columns: 1fr 1fr; gap:36px; }
  .footer-brand { grid-column: 1 / -1; }
}
@media (max-width:540px) {
  .footer-inner { grid-template-columns: 1fr; }
  .footer-bottom { flex-direction:column; align-items:flex-start; gap:12px; }
}
</style>

<footer class="site-footer">
  <div class="footer-inner">

    <div class="footer-brand">
      <div class="footer-logo">YFW Haven Grand</div>
      <div class="footer-tagline">Step into your future world.<br>Experience luxury &amp; technology.</div>
    </div>

    <div class="footer-col">
      <div class="footer-col-title">Asia Nodes</div>
      <div class="footer-nodes">
        <a class="node-link" href="godmode.php?city=Singapore" target="_blank">Singapore</a>
        <span class="node-dot">•</span>
        <a class="node-link" href="godmode.php?city=Tokyo" target="_blank">Tokyo</a>
        <span class="node-dot">•</span>
        <a class="node-link" href="godmode.php?city=Seoul" target="_blank">Seoul</a>
        <span class="node-dot">•</span>
        <a class="node-link" href="godmode.php?city=Dubai" target="_blank">Dubai</a>
        <span class="node-dot">•</span>
        <a class="node-link" href="godmode.php?city=Jakarta" target="_blank">Jakarta<span class="node-hq">HQ</span></a>
      </div>
    </div>

    <div class="footer-col">
      <div class="footer-col-title">Europe Nodes</div>
      <div class="footer-nodes">
        <a class="node-link" href="godmode.php?city=Paris" target="_blank">Paris</a>
        <span class="node-dot">•</span>
        <a class="node-link" href="godmode.php?city=London" target="_blank">London</a>
        <span class="node-dot">•</span>
        <a class="node-link" href="godmode.php?city=Milan" target="_blank">Milan</a>
      </div>
    </div>

    <div class="footer-newsletter">
      <div class="footer-col-title">Newsletter</div>
      <form class="newsletter-form" onsubmit="handleNewsletter(event)">
        <input type="email" class="newsletter-input" placeholder="Future Mail" required>
        <button type="submit" class="newsletter-btn">Go</button>
      </form>
    </div>

  </div>

  <hr class="footer-divider">

  <div class="footer-bottom">
    <div class="footer-copy">&copy; <?= date('Y') ?> YFW Haven Grand &mdash; Future Experience</div>
    <nav class="footer-links">
      <a href="privacy.php">Privacy</a>
      <a href="terms.php">Terms</a>
      <a href="about.php">About</a>
      <a href="index.php?page=data_center">Dashboard</a>
    </nav>
  </div>
</footer>

<script>
function handleNewsletter(e) {
  e.preventDefault();
  const input = e.target.querySelector('input');
  const btn   = e.target.querySelector('button');
  btn.textContent = '✓';
  btn.style.background = '#27AE60';
  input.value = '';
  input.placeholder = "You're in the future.";
  setTimeout(() => { btn.textContent = 'Go'; btn.style.background = ''; input.placeholder = 'Future Mail'; }, 3000);
}
</script>
</body>
</html>
