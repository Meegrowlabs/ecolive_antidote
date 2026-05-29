<?php
/**
 * Template Name: Water Balance Optimiser
 *
 * WaterWise water-balance optimiser (ported from tools/water-balance-optimiser).
 * Its original CSS uses bare element selectors, so every rule is scoped under
 * .wbo to avoid clashing with the theme header/footer and Tailwind.
 * Create a Page (e.g. slug "water-balance-optimiser") and assign this template.
 *
 * @package ecolive-organic
 */
get_header();
$tpl = get_template_directory_uri();
?>
<style>
  .wbo {
    --ink:#14231f; --muted:#60716c; --line:#d7e1de; --paper:#ffffff; --panel:#f7faf9;
    --wash:#eef7f5; --soft-blue:#e9f4ff; --blue:#1976c9; --soft-green:#e4f6ea; --green:#078a43;
    --soft-red:#fde8e8; --red:#d62020; --input:#fff3c8; --teal:#226d63; --leaf:#6aae35; --sky:#42a5d8;
    --shadow:0 18px 48px rgba(20,35,31,0.1);
    color:var(--ink); font-family:Arial, Helvetica, sans-serif;
    background:
      linear-gradient(180deg, rgba(226,243,239,0.95), rgba(245,250,248,0.95)),
      radial-gradient(circle at top left, rgba(66,165,216,0.18), transparent 34%);
    padding-top:5rem;
  }
  .wbo *, .wbo *::before, .wbo *::after { box-sizing:border-box; }
  .wbo .wbo-main { width:100%; max-width:1180px; margin:0 auto; padding:24px; }
  .wbo .shell { background:var(--paper); border:1px solid var(--line); box-shadow:var(--shadow); overflow:hidden; }
  .wbo .brandbar { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:14px 20px; border-bottom:1px solid var(--line); background:#fff; }
  .wbo .logo { display:inline-flex; align-items:center; gap:10px; min-width:250px; }
  .wbo .logo-img { display:block; width:245px; max-width:44vw; height:auto; }
  .wbo .brand-note { max-width:560px; color:var(--muted); font-size:13px; line-height:1.35; text-align:right; }
  .wbo header { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:18px 20px 16px; background:linear-gradient(135deg,#1d635b,#257c73); color:#fff; }
  .wbo h1 { margin:0; font-size:24px; line-height:1.2; font-weight:700; letter-spacing:0; }
  .wbo .subhead { margin-top:4px; color:rgba(255,255,255,0.86); font-size:13px; }
  .wbo .toolbar { display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end; }
  .wbo button, .wbo .button-link { border:1px solid rgba(255,255,255,0.35); background:rgba(255,255,255,0.14); color:#fff; font:inherit; font-weight:700; padding:8px 12px; cursor:pointer; display:inline-flex; align-items:center; text-decoration:none; }
  .wbo button:hover, .wbo .button-link:hover { background:rgba(255,255,255,0.22); }
  .wbo .content { padding:20px; display:grid; gap:20px; }
  .wbo .visual-panel { border:1px solid var(--line); background:linear-gradient(180deg,#fff,#f0fbff 52%,var(--wash)); }
  .wbo .visual-head { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:14px 16px 0; }
  .wbo .visual-head h2 { margin:0; font-size:20px; line-height:1.2; color:var(--teal); }
  .wbo .visual-head p { margin:4px 0 0; color:var(--muted); font-size:13px; }
  .wbo .pill { flex:0 0 auto; padding:7px 10px; border:1px solid rgba(7,138,67,0.24); background:var(--soft-green); color:var(--green); font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.04em; }
  .wbo .four-r-map { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:12px; padding:16px; align-items:stretch; }
  .wbo .banner-wrap { padding:14px 16px 4px; overflow:hidden; }
  .wbo .four-r-banner { display:block; max-width:100%; width:100%; height:auto; max-height:330px; object-fit:contain; background:#fff; border:1px solid var(--line); }
  .wbo .visual-caption { margin:12px 16px 0; padding:11px 14px; border-left:4px solid #16c3e9; background:rgba(255,255,255,0.72); color:var(--muted); font-size:13px; line-height:1.4; }
  .wbo .r-node { position:relative; min-height:132px; padding:15px 14px; border:1px solid var(--line); background:#fff; overflow:hidden; }
  .wbo .r-node::after { content:""; position:absolute; right:-18px; bottom:-24px; width:88px; height:88px; border-radius:50%; background:rgba(34,109,99,0.08); }
  .wbo .r-number { display:inline-grid; place-items:center; width:38px; height:38px; border-radius:50%; background:var(--teal); color:#fff; font-weight:800; margin-bottom:10px; }
  .wbo .r-node h3 { position:relative; margin:0; color:var(--ink); font-size:18px; line-height:1.1; }
  .wbo .r-node p { position:relative; margin:7px 0 0; color:var(--muted); font-size:13px; line-height:1.35; }
  .wbo .flow-strip { display:grid; grid-template-columns:1fr auto 1fr auto 1fr; gap:10px; align-items:center; padding:0 16px 16px; }
  .wbo .flow-box { min-height:64px; display:grid; align-content:center; gap:3px; border:1px solid var(--line); background:#fff; padding:10px 12px; text-align:center; font-weight:700; }
  .wbo .flow-box span { color:var(--muted); font-size:12px; font-weight:400; }
  .wbo .arrow { width:34px; height:2px; background:var(--teal); position:relative; }
  .wbo .arrow::after { content:""; position:absolute; right:-1px; top:-5px; border-left:9px solid var(--teal); border-top:6px solid transparent; border-bottom:6px solid transparent; }
  .wbo .grid { display:grid; grid-template-columns:minmax(0,1.1fr) minmax(320px,0.9fr); gap:20px; align-items:start; }
  .wbo section { min-width:0; border:1px solid var(--line); background:var(--paper); }
  .wbo .section-title { padding:11px 14px; background:var(--soft-blue); color:var(--blue); border-bottom:1px solid var(--line); font-weight:700; }
  .wbo table { width:100%; border-collapse:collapse; table-layout:fixed; }
  .wbo th, .wbo td { border:1px solid var(--line); padding:9px 10px; vertical-align:middle; font-size:14px; line-height:1.25; }
  .wbo th { color:var(--blue); background:var(--soft-blue); font-weight:700; text-align:center; }
  .wbo td:first-child { font-weight:700; }
  .wbo .unit, .wbo .note { color:var(--muted); font-size:13px; }
  .wbo .number { text-align:right; font-variant-numeric:tabular-nums; }
  .wbo input { width:100%; min-height:36px; padding:7px 8px; border:1px solid #d8c06b; background:var(--input); color:var(--ink); font:inherit; font-weight:700; text-align:right; }
  .wbo input:focus { outline:2px solid rgba(25,118,201,0.28); border-color:var(--blue); }
  .wbo .result { background:var(--panel); font-weight:700; text-align:right; font-variant-numeric:tabular-nums; }
  .wbo .balance-cell.deficit, .wbo .status.deficit { background:var(--soft-red); color:var(--red); }
  .wbo .balance-cell.positive, .wbo .status.positive { background:var(--soft-green); color:var(--green); }
  .wbo .summary-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px; padding:14px; }
  .wbo .metric { border:1px solid var(--line); background:var(--panel); padding:12px; min-height:82px; }
  .wbo .metric label { display:block; color:var(--muted); font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.04em; }
  .wbo .metric strong { display:block; margin-top:8px; font-size:23px; line-height:1.1; font-variant-numeric:tabular-nums; }
  .wbo .metric span { display:block; margin-top:5px; color:var(--muted); font-size:12px; }
  .wbo .bars { padding:14px; display:grid; gap:14px; }
  .wbo .bar-row { display:grid; gap:7px; }
  .wbo .bar-label { display:flex; justify-content:space-between; gap:12px; color:var(--muted); font-size:13px; }
  .wbo .track { height:18px; background:#e7edeb; border:1px solid var(--line); overflow:hidden; }
  .wbo .bar { height:100%; width:0; background:var(--blue); transition:width 160ms ease; }
  .wbo .bar.green { background:var(--green); }
  .wbo .bar.red { background:var(--red); }
  .wbo .interventions { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:12px; padding:14px; }
  .wbo .lever { border:1px solid var(--line); padding:12px; background:var(--panel); }
  .wbo .lever h3 { margin:0 0 6px; color:var(--teal); font-size:15px; line-height:1.2; }
  .wbo .lever p { margin:0; color:var(--muted); font-size:13px; line-height:1.35; }
  .wbo .small { font-size:12px; color:var(--muted); }
  .wbo .locbar { border:1px solid var(--line); background:var(--panel); padding:14px 16px; }
  .wbo .locbar-label { display:block; font-weight:700; font-size:13px; color:var(--teal); margin-bottom:6px; }
  .wbo .combo { position:relative; max-width:440px; }
  .wbo .combo input { width:100%; min-height:40px; padding:8px 10px; border:1px solid var(--line); background:#fff; color:var(--ink); font:inherit; font-weight:400; text-align:left; }
  .wbo .combo input:focus { outline:2px solid rgba(25,118,201,0.28); border-color:var(--blue); }
  .wbo .combo-list { position:absolute; z-index:30; top:100%; left:0; right:0; margin:4px 0 0; padding:0; list-style:none; background:#fff; border:1px solid var(--line); max-height:260px; overflow:auto; box-shadow:var(--shadow); }
  .wbo .combo-list li { padding:9px 12px; cursor:pointer; font-size:13px; border-bottom:1px solid var(--line); }
  .wbo .combo-list li:last-child { border-bottom:0; }
  .wbo .combo-list li:hover { background:var(--wash); }
  .wbo .loc-status { margin:8px 0 0; font-size:12px; line-height:1.4; color:var(--muted); }
  @media (max-width:900px){
    .wbo .wbo-main { padding:12px; }
    .wbo header { align-items:flex-start; flex-direction:column; }
    .wbo .brandbar { align-items:flex-start; flex-direction:column; }
    .wbo .brand-note { text-align:left; }
    .wbo .grid, .wbo .interventions, .wbo .four-r-map { grid-template-columns:1fr; }
    .wbo .flow-strip { grid-template-columns:1fr; }
    .wbo .arrow { width:2px; height:28px; justify-self:center; }
    .wbo .arrow::after { right:-5px; top:auto; bottom:-1px; border-top:9px solid var(--teal); border-left:6px solid transparent; border-right:6px solid transparent; border-bottom:0; }
    .wbo .summary-grid { grid-template-columns:1fr; }
    .wbo table { min-width:620px; }
    .wbo .four-r-banner { width:auto; max-width:100%; max-height:220px; margin:0 auto; }
    .wbo .table-wrap { max-width:100%; overflow-x:auto; }
  }
</style>

<div class="wbo">
  <div class="wbo-main">
    <div class="shell">
      <div class="brandbar">
        <div class="logo" aria-label="EcoLive">
          <img class="logo-img" src="<?php echo esc_url( $tpl . '/assets/ecolive_logo_web.png' ); ?>" alt="EcoLive">
        </div>
        <div class="brand-note">EcoLive Water Balance Optimiser for estimating water balance and exploring 4R interventions.</div>
      </div>

      <header>
        <div>
          <h1>EcoLive Water Balance Optimiser</h1>
          <div class="subhead">Change the yellow inputs to compare Existing and Post 4R water balance instantly.</div>
        </div>
        <div class="toolbar">
          <a class="button-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to EcoLive</a>
          <button type="button" id="sampleBtn">Sample values</button>
          <button type="button" id="resetBtn">Clear scenario</button>
        </div>
      </header>

      <div class="content">
        <div class="locbar">
          <label class="locbar-label" for="locSearch">Autofill by location (open data)</label>
          <div class="combo">
            <input id="locSearch" type="text" placeholder="Search any city, e.g. Jaipur" autocomplete="off">
            <ul id="locResults" class="combo-list" hidden></ul>
          </div>
          <p class="loc-status" id="locStatus">Select a location to auto-fill rainfall, area and population from open data. Post-4R consumption and recharge efficiency stay manual.</p>
        </div>

        <section class="visual-panel" aria-label="4R simulation visual">
          <div class="visual-head">
            <div>
              <h2>4R Based Simulation Tool</h2>
              <p>Model how demand reduction and improved recharge move a site from deficit toward water positivity.</p>
            </div>
            <div class="pill">Live Scenario</div>
          </div>
          <div class="banner-wrap" aria-label="4R Reduce Reuse Recycle Recharge banner">
            <img class="four-r-banner" src="<?php echo esc_url( $tpl . '/assets/4r_recharge_banner.png' ); ?>" alt="Reduce Reuse Recycle Recharge water-themed 4R visual">
          </div>
          <div class="visual-caption">
            Use this visual as the 4R reference: reduce demand, reuse water, recycle treated water, and recharge through rainwater harvesting.
          </div>
          <div class="four-r-map">
            <div class="r-node"><div class="r-number">R1</div><h3>Reduce</h3><p>Lower per-person consumption through efficiency and leak control.</p></div>
            <div class="r-node"><div class="r-number">R2</div><h3>Reuse</h3><p>Shift suitable non-potable demand to greywater and treated water.</p></div>
            <div class="r-node"><div class="r-number">R3</div><h3>Recycle</h3><p>Recover process or STP water for repeated use on the premises.</p></div>
            <div class="r-node"><div class="r-number">R4</div><h3>Recharge</h3><p>Improve rainwater capture, infiltration, and groundwater recharge.</p></div>
          </div>
          <div class="flow-strip" aria-label="Water balance flow">
            <div class="flow-box">Rainfall + Area <span>Potential supply</span></div>
            <div class="arrow" aria-hidden="true"></div>
            <div class="flow-box">4R Levers <span>Reduce demand, increase credit</span></div>
            <div class="arrow" aria-hidden="true"></div>
            <div class="flow-box">Water Balance <span>Deficit or positive status</span></div>
          </div>
        </section>

        <div class="grid">
          <section>
            <div class="section-title">Existing vs Post 4R Inputs and Water Balance</div>
            <div class="table-wrap">
              <table aria-label="Water balance simulator">
                <colgroup>
                  <col style="width:28%"><col style="width:18%"><col style="width:18%"><col style="width:14%"><col style="width:22%">
                </colgroup>
                <thead>
                  <tr><th>Parameter</th><th>Existing</th><th>Post 4R</th><th>Unit</th><th>Purpose</th></tr>
                </thead>
                <tbody>
                  <tr><td>Rainfall</td><td><input id="rainExisting" type="number" min="0" step="1" value="550" aria-label="Existing rainfall"></td><td><input id="rainPost" type="number" min="0" step="1" value="550" aria-label="Post 4R rainfall"></td><td class="unit">mm/yr</td><td class="note">Annual average rainfall</td></tr>
                  <tr><td>Area</td><td><input id="areaExisting" type="number" min="0" step="0.01" value="467" aria-label="Existing area"></td><td><input id="areaPost" type="number" min="0" step="0.01" value="467" aria-label="Post 4R area"></td><td class="unit">Sq Km</td><td class="note">Premises / catchment area</td></tr>
                  <tr><td>Population</td><td><input id="popExisting" type="number" min="1" step="1" value="4000000" aria-label="Existing population"></td><td><input id="popPost" type="number" min="1" step="1" value="4000000" aria-label="Post 4R population"></td><td class="unit">Person</td><td class="note">Dependent population</td></tr>
                  <tr><td>Water consumption</td><td><input id="lpdExisting" type="number" min="0" step="1" value="135" aria-label="Existing water consumption"></td><td><input id="lpdPost" type="number" min="0" step="1" value="90" aria-label="Post 4R water consumption"></td><td class="unit">LPD</td><td class="note">Reduce litres/person/day</td></tr>
                  <tr><td>Recharge efficiency</td><td><input id="effExisting" type="number" min="0" max="100" step="1" value="15" aria-label="Existing recharge efficiency"></td><td><input id="effPost" type="number" min="0" max="100" step="1" value="70" aria-label="Post 4R recharge efficiency"></td><td class="unit">%</td><td class="note">Harvesting / recharge efficiency</td></tr>
                  <tr><td>Rainwater Harvested</td><td class="result" id="harvestExisting">0</td><td class="result" id="harvestPost">0</td><td class="unit">Litres pp/yr</td><td class="note">Harvested per person per year</td></tr>
                  <tr><td>Water Consumed</td><td class="result" id="consumedExisting">0</td><td class="result" id="consumedPost">0</td><td class="unit">Litres pp/yr</td><td class="note">Consumed per person per year</td></tr>
                  <tr><td>Water Balance</td><td class="result balance-cell" id="balanceExisting">0</td><td class="result balance-cell" id="balancePost">0</td><td class="unit">Litres pp/yr</td><td class="note">Red = deficit, green = surplus</td></tr>
                  <tr><td>Status</td><td class="result status" id="statusExisting">-</td><td class="result status" id="statusPost">-</td><td class="unit"></td><td class="note">Water positive when harvested is higher than consumed</td></tr>
                </tbody>
              </table>
            </div>
          </section>

          <section>
            <div class="section-title">Scenario Snapshot</div>
            <div class="summary-grid">
              <div class="metric"><label>Existing Balance</label><strong id="existingGap">0</strong><span id="existingGapText">Litres pp/yr</span></div>
              <div class="metric"><label>Post 4R Balance</label><strong id="postGap">0</strong><span id="postGapText">Litres pp/yr</span></div>
              <div class="metric"><label>Balance Improvement</label><strong id="improvement">0</strong><span>Litres pp/yr</span></div>
              <div class="metric"><label>Post 4R Ratio</label><strong id="postRatio">0%</strong><span>Harvested / consumed</span></div>
            </div>
            <div class="bars" aria-label="Comparison bars">
              <div class="bar-row"><div class="bar-label"><span>Existing harvested</span><strong id="barHarvestExistingText">0</strong></div><div class="track"><div class="bar" id="barHarvestExisting"></div></div></div>
              <div class="bar-row"><div class="bar-label"><span>Existing consumed</span><strong id="barConsumedExistingText">0</strong></div><div class="track"><div class="bar red" id="barConsumedExisting"></div></div></div>
              <div class="bar-row"><div class="bar-label"><span>Post 4R harvested</span><strong id="barHarvestPostText">0</strong></div><div class="track"><div class="bar green" id="barHarvestPost"></div></div></div>
              <div class="bar-row"><div class="bar-label"><span>Post 4R consumed</span><strong id="barConsumedPostText">0</strong></div><div class="track"><div class="bar red" id="barConsumedPost"></div></div></div>
            </div>
          </section>
        </div>

        <section>
          <div class="section-title">4R Intervention Guidance</div>
          <div class="interventions">
            <div class="lever"><h3>Reduce</h3><p>Lower LPD through efficient fixtures, leak control, metering, and behaviour change.</p></div>
            <div class="lever"><h3>Reuse</h3><p>Use greywater or treated water for flushing, gardening, washing, and non-potable demand.</p></div>
            <div class="lever"><h3>Recycle</h3><p>Recycle STP or process water to offset freshwater consumption wherever quality permits.</p></div>
            <div class="lever"><h3>Recharge</h3><p>Improve recharge efficiency with rainwater harvesting, recharge pits, trenches, and wells.</p></div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo esc_url( $tpl . '/assets/location-data.js' ); ?>"></script>
<script>
  const sample = { rainExisting:550, rainPost:550, areaExisting:467, areaPost:467, popExisting:4000000, popPost:4000000, lpdExisting:135, lpdPost:90, effExisting:15, effPost:70 };
  const blankScenario = { rainExisting:0, rainPost:0, areaExisting:0, areaPost:0, popExisting:1, popPost:1, lpdExisting:0, lpdPost:0, effExisting:0, effPost:0 };
  const ids = Object.keys(sample);
  const numberFormatter = new Intl.NumberFormat("en-IN", { maximumFractionDigits: 0 });
  const ratioFormatter = new Intl.NumberFormat("en-IN", { style: "percent", maximumFractionDigits: 0 });

  function value(id) { const v = Number(document.getElementById(id).value); return Number.isFinite(v) ? v : 0; }
  function setText(id, text) { document.getElementById(id).textContent = text; }
  function formatNumber(value) { return numberFormatter.format(Math.round(Math.abs(value))); }

  function calculateScenario(prefix) {
    const rain = value(`rain${prefix}`);
    const area = value(`area${prefix}`);
    const population = Math.max(value(`pop${prefix}`), 1);
    const lpd = value(`lpd${prefix}`);
    const efficiency = value(`eff${prefix}`) / 100;
    const harvested = (rain / 1000) * area * 1000000 * 1000 * efficiency / population;
    const consumed = lpd * 365;
    const net = harvested - consumed;
    const gap = Math.abs(net);
    const ratio = consumed > 0 ? harvested / consumed : 0;
    return { harvested, consumed, net, gap, ratio };
  }

  function setStatus(cellId, net) {
    const cell = document.getElementById(cellId);
    const isPositive = net >= 0;
    cell.textContent = isPositive ? "Water Positive" : "Water Deficit";
    cell.classList.toggle("positive", isPositive);
    cell.classList.toggle("deficit", !isPositive);
  }
  function setBalance(cellId, scenario) {
    const cell = document.getElementById(cellId);
    const isPositive = scenario.net >= 0;
    cell.textContent = formatNumber(scenario.gap);
    cell.classList.toggle("positive", isPositive);
    cell.classList.toggle("deficit", !isPositive);
  }
  function setBar(id, value, max) {
    const width = max > 0 ? Math.min((value / max) * 100, 100) : 0;
    document.getElementById(id).style.width = `${width}%`;
  }

  function calculate() {
    const existing = calculateScenario("Existing");
    const post = calculateScenario("Post");
    const maxBar = Math.max(existing.harvested, existing.consumed, post.harvested, post.consumed, 1);
    setText("harvestExisting", formatNumber(existing.harvested));
    setText("harvestPost", formatNumber(post.harvested));
    setText("consumedExisting", formatNumber(existing.consumed));
    setText("consumedPost", formatNumber(post.consumed));
    setBalance("balanceExisting", existing);
    setBalance("balancePost", post);
    setStatus("statusExisting", existing.net);
    setStatus("statusPost", post.net);
    setText("existingGap", formatNumber(existing.gap));
    setText("existingGapText", existing.net >= 0 ? "Surplus litres pp/yr" : "Deficit litres pp/yr");
    setText("postGap", formatNumber(post.gap));
    setText("postGapText", post.net >= 0 ? "Surplus litres pp/yr" : "Deficit litres pp/yr");
    setText("improvement", formatNumber(post.net - existing.net));
    setText("postRatio", ratioFormatter.format(post.ratio));
    setText("barHarvestExistingText", formatNumber(existing.harvested));
    setText("barConsumedExistingText", formatNumber(existing.consumed));
    setText("barHarvestPostText", formatNumber(post.harvested));
    setText("barConsumedPostText", formatNumber(post.consumed));
    setBar("barHarvestExisting", existing.harvested, maxBar);
    setBar("barConsumedExisting", existing.consumed, maxBar);
    setBar("barHarvestPost", post.harvested, maxBar);
    setBar("barConsumedPost", post.consumed, maxBar);
  }

  function loadValues(values) { ids.forEach((id) => { document.getElementById(id).value = values[id]; }); calculate(); }
  ids.forEach((id) => { document.getElementById(id).addEventListener("input", calculate); });
  document.getElementById("sampleBtn").addEventListener("click", () => loadValues(sample));
  document.getElementById("resetBtn").addEventListener("click", () => loadValues(blankScenario));

  let locList = [];
  function renderLocResults(list) {
    const box = document.getElementById("locResults");
    locList = list;
    if (!list.length) { box.hidden = true; box.innerHTML = ""; return; }
    box.innerHTML = list.map((r, i) => `<li data-i="${i}">${r.name}${r.admin1 ? ", " + r.admin1 : ""}, ${r.country}</li>`).join("");
    box.hidden = false;
  }
  function setupLocation() {
    const input = document.getElementById("locSearch");
    const box = document.getElementById("locResults");
    const status = document.getElementById("locStatus");
    let timer;
    input.addEventListener("input", () => {
      clearTimeout(timer);
      const query = input.value;
      timer = setTimeout(async () => {
        try { renderLocResults(await ecoliveLocation.search(query)); }
        catch { box.hidden = true; }
      }, 300);
    });
    box.addEventListener("click", async (event) => {
      const li = event.target.closest("li");
      if (!li) return;
      const place = locList[Number(li.dataset.i)];
      input.value = `${place.name}, ${place.country}`;
      box.hidden = true;
      status.textContent = `Fetching open data for ${place.name}…`;
      try {
        const [rain, wd] = await Promise.all([
          ecoliveLocation.annualRainfall(place.latitude, place.longitude).catch(() => null),
          ecoliveLocation.cityAreaPopulation(place.id).catch(() => ({ areaKm2: null, population: null }))
        ]);
        const population = wd.population || place.population || null;
        const filled = [];
        if (rain) { document.getElementById("rainExisting").value = rain; document.getElementById("rainPost").value = rain; filled.push(`rainfall ≈ ${rain} mm/yr`); }
        if (wd.areaKm2) { document.getElementById("areaExisting").value = wd.areaKm2; document.getElementById("areaPost").value = wd.areaKm2; filled.push(`area ${wd.areaKm2} km²`); }
        if (population) { document.getElementById("popExisting").value = population; document.getElementById("popPost").value = population; filled.push(`population ${population.toLocaleString("en-IN")}`); }
        document.getElementById("lpdExisting").value = 135;
        calculate();
        const head = filled.length ? `Filled ${filled.join(", ")} for ${place.name}. ` : `No open data found for ${place.name}. `;
        status.textContent = head + "Existing consumption set to 135 LPCD (CPHEEO benchmark). Post-4R consumption and recharge efficiency stay manual — verify all values before design.";
      } catch {
        status.textContent = "Could not fetch location data. Please enter values manually.";
      }
    });
    document.addEventListener("click", (event) => { if (!event.target.closest(".combo")) box.hidden = true; });
  }

  setupLocation();
  calculate();
</script>
<?php
get_footer();
