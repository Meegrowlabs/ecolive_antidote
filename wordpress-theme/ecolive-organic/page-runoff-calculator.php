<?php
/**
 * Template Name: Runoff Calculator
 *
 * WaterWise runoff calculator (ported from tools/runoff-calculator).
 * Create a Page (e.g. slug "runoff-calculator") and assign this template.
 *
 * @package ecolive-organic
 */
get_header();
$tpl = get_template_directory_uri();
?>
<main>
  <!-- Hero -->
  <section class="relative pt-32 pb-16 md:pt-44 md:pb-24 px-6 overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-secondary-fixed/30 via-surface to-surface"></div>
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-secondary-fixed/30 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 -left-20 w-64 h-64 bg-tertiary-fixed/30 rounded-full blur-3xl"></div>
    <div class="max-w-7xl mx-auto">
      <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-fixed/40 text-primary rounded-full mb-8 font-semibold text-sm">
        <span class="material-symbols-outlined text-sm">rainy</span>
        WaterWise tool
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_360px] gap-10 lg:gap-16 items-end">
        <div>
          <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-on-surface max-w-3xl leading-[0.95] mb-8">
            Runoff <span class="text-gradient">Calculator.</span>
          </h1>
          <p class="text-lg md:text-xl text-on-surface-variant max-w-2xl leading-relaxed mb-10">
            Convert rainfall into a water opportunity estimate. Search a location to auto-fill annual rainfall from open climate data, then adjust site areas and runoff coefficients. This is a planning tool; final RWH/GWR design needs site survey, soil/percolation assessment, filtration design and local compliance review.
          </p>
          <div class="flex flex-wrap gap-4">
            <a class="px-7 py-3.5 bg-surface/70 backdrop-blur-md ghost-border rounded-full font-bold text-primary hover:bg-surface-container-low transition-all inline-flex items-center gap-2" href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <span class="material-symbols-outlined">arrow_back</span> Back to EcoLive
            </a>
            <button type="button" id="sampleBtn" class="px-7 py-3.5 btn-primary-gradient text-on-primary rounded-full font-bold shadow-[0_10px_40px_rgba(24,28,27,0.12)] hover:opacity-95 transition-all">Sample values</button>
            <button type="button" id="resetBtn" class="px-7 py-3.5 bg-surface-container text-on-surface-variant rounded-full font-bold hover:bg-surface-container-high transition-all">Clear</button>
          </div>
        </div>
        <div class="btn-primary-gradient text-on-primary rounded-xl p-8 shadow-[0_20px_50px_rgba(24,28,27,0.12)]">
          <strong id="heroRunoff" class="block font-headline text-5xl md:text-6xl font-extrabold tracking-tighter leading-none mb-2">0 L</strong>
          <span class="text-secondary-fixed font-semibold">annual gross runoff estimate</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Inputs + Snapshot -->
  <section class="pb-16 md:pb-20 px-6 bg-surface">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[minmax(0,1.05fr)_minmax(0,0.95fr)] gap-8 items-stretch">
      <div class="bg-surface-container-lowest rounded-xl shadow-[0_10px_40px_rgba(24,28,27,0.04)] overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-outline-variant/40">
          <h2 class="font-headline text-2xl font-bold">Inputs</h2>
          <p class="text-on-surface-variant text-sm mt-1">Highlighted fields can be edited — results update instantly.</p>
        </div>
        <div class="p-8 grid gap-6 flex-1">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <label class="grid gap-2 text-sm font-bold">City / location baseline
              <div class="combo font-normal">
                <input id="locSearch" type="text" placeholder="Search any city, e.g. Jaipur" autocomplete="off" class="tool-input">
                <ul id="locResults" class="combo-list" hidden></ul>
              </div>
            </label>
            <label class="grid gap-2 text-sm font-bold">Premise preset
              <select id="preset" class="tool-input font-normal">
                <option value="medium-factory" selected>Medium factory</option>
                <option value="small-factory">Small factory</option>
                <option value="large-factory">Large factory</option>
                <option value="warehouse">Warehouse</option>
                <option value="rwa">RWA / township</option>
                <option value="school">School / institution</option>
                <option value="hotel">Hotel / commercial</option>
                <option value="home">Home / villa</option>
              </select>
            </label>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <label class="grid gap-2 text-sm font-bold">Annual rainfall (mm)
              <input id="annualRainfall" type="number" min="0" step="1" value="505" class="tool-input font-normal">
            </label>
            <label class="grid gap-2 text-sm font-bold">Design storm / event rainfall (mm)
              <input id="eventRainfall" type="number" min="0" step="1" value="50" class="tool-input font-normal">
            </label>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <label class="grid gap-2 text-sm font-bold">Collection efficiency (%)
              <input id="collectionEfficiency" type="number" min="0" max="100" step="1" value="85" class="tool-input font-normal">
            </label>
            <label class="grid gap-2 text-sm font-bold">First flush / filtration loss (%)
              <input id="lossPercent" type="number" min="0" max="100" step="1" value="10" class="tool-input font-normal">
            </label>
          </div>
          <p class="text-sm text-on-surface-variant leading-relaxed" id="sourceNote"></p>
        </div>
      </div>

      <div class="bg-surface-container-lowest rounded-xl shadow-[0_10px_40px_rgba(24,28,27,0.04)] overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-outline-variant/40">
          <h2 class="font-headline text-2xl font-bold">Scenario Snapshot</h2>
          <p class="text-on-surface-variant text-sm mt-1">Gross and net runoff estimates update instantly.</p>
        </div>
        <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-5 flex-1 content-start">
          <div class="bg-surface-container-low rounded-lg p-5">
            <span class="text-xs uppercase tracking-widest font-bold text-on-surface-variant">Annual gross runoff</span>
            <strong id="annualGross" class="block font-headline text-3xl font-extrabold tracking-tighter text-primary mt-2">0</strong>
            <span class="block text-xs text-on-surface-variant mt-1">Litres/year</span>
          </div>
          <div class="bg-surface-container-low rounded-lg p-5">
            <span class="text-xs uppercase tracking-widest font-bold text-on-surface-variant">Annual net usable</span>
            <strong id="annualNet" class="block font-headline text-3xl font-extrabold tracking-tighter text-primary mt-2">0</strong>
            <span class="block text-xs text-on-surface-variant mt-1">After efficiency and losses</span>
          </div>
          <div class="bg-surface-container-low rounded-lg p-5">
            <span class="text-xs uppercase tracking-widest font-bold text-on-surface-variant">Design event runoff</span>
            <strong id="eventGross" class="block font-headline text-3xl font-extrabold tracking-tighter text-primary mt-2">0</strong>
            <span class="block text-xs text-on-surface-variant mt-1">Litres/event</span>
          </div>
          <div class="bg-surface-container-low rounded-lg p-5">
            <span class="text-xs uppercase tracking-widest font-bold text-on-surface-variant">Indicative storage</span>
            <strong id="storage" class="block font-headline text-3xl font-extrabold tracking-tighter text-primary mt-2">0</strong>
            <span class="block text-xs text-on-surface-variant mt-1">KL for 25% of event net</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Surface table -->
  <section class="pb-16 md:pb-20 px-6 bg-surface">
    <div class="max-w-7xl mx-auto bg-surface-container-lowest rounded-xl shadow-[0_10px_40px_rgba(24,28,27,0.04)] overflow-hidden">
      <div class="px-8 py-6 border-b border-outline-variant/40">
        <h2 class="font-headline text-2xl font-bold">Surface Area and Runoff Coefficients</h2>
        <p class="text-on-surface-variant text-sm mt-1">Enter actual measured areas where available. Coefficients are planning assumptions.</p>
      </div>
      <div class="p-8 overflow-x-auto">
        <table class="tool-table" aria-label="Runoff by surface">
          <thead>
            <tr>
              <th>Surface</th>
              <th>Area (sqm)</th>
              <th>Runoff coefficient</th>
              <th>Annual runoff (L)</th>
              <th>Event runoff (L)</th>
            </tr>
          </thead>
          <tbody id="surfaceRows"></tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- Interpretation -->
  <section class="pb-24 md:pb-32 px-6 bg-surface">
    <div class="max-w-7xl mx-auto">
      <div class="mb-12 max-w-3xl">
        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">EcoLive interpretation</p>
        <h2 class="font-headline text-3xl md:text-4xl font-bold tracking-tight mb-4">How to read the output.</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col border-l-4 border-primary">
          <div class="w-14 h-14 bg-tertiary-fixed/40 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">water_drop</span></div>
          <h3 class="text-xl font-bold mb-3">High hard-surface runoff</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Prioritize filtration, first-flush control and recharge points before the runoff becomes urban flooding or wasted drainage.</p>
        </div>
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col border-l-4 border-secondary">
          <div class="w-14 h-14 bg-secondary-fixed/40 text-secondary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">grass</span></div>
          <h3 class="text-xl font-bold mb-3">Low green/soil runoff</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Protect natural infiltration; avoid over-paving and use landscape depressions, trenches or recharge beds where suitable.</p>
        </div>
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col border-l-4 border-tertiary">
          <div class="w-14 h-14 bg-surface-variant text-tertiary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">water</span></div>
          <h3 class="text-xl font-bold mb-3">Storage vs recharge</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Storage is useful for reuse, but large monsoon volumes usually need distributed recharge and overflow routing.</p>
        </div>
      </div>
      <p class="text-sm text-outline max-w-3xl mt-10">Tool data method: this tool uses editable baseline data and planning assumptions. Values must be verified against latest IMD, municipal, CGWB and project-site records before engineering decisions.</p>
    </div>
  </section>
</main>

<script src="<?php echo esc_url( $tpl . '/assets/location-data.js' ); ?>"></script>
<script>
  const ECOLIVE_BASELINES_URL = <?php echo wp_json_encode( $tpl . '/assets/water-city-baselines.json' ); ?>;
  const rows = [
    { key: "roof", label: "Roof / terrace", area: 4000, coefficient: 0.85 },
    { key: "paved", label: "Paved / concrete", area: 3000, coefficient: 0.75 },
    { key: "road", label: "Internal roads", area: 1500, coefficient: 0.70 },
    { key: "soil", label: "Open soil", area: 1000, coefficient: 0.20 },
    { key: "green", label: "Green / landscaped", area: 500, coefficient: 0.10 }
  ];

  const numberFormatter = new Intl.NumberFormat("en-IN", { maximumFractionDigits: 0 });
  let baselineData = null;

  function format(value) { return numberFormatter.format(Math.round(value)); }

  function buildRows() {
    const tbody = document.getElementById("surfaceRows");
    tbody.innerHTML = rows.map((row, index) => `
      <tr>
        <td>${row.label}</td>
        <td><input data-row="${index}" data-field="area" type="number" min="0" step="1" value="${row.area}" aria-label="${row.label} area"></td>
        <td><input data-row="${index}" data-field="coefficient" type="number" min="0" max="1" step="0.01" value="${row.coefficient}" aria-label="${row.label} coefficient"></td>
        <td class="result" id="annual-${index}">0</td>
        <td class="result" id="event-${index}">0</td>
      </tr>
    `).join("");
    tbody.querySelectorAll("input").forEach((input) => {
      input.addEventListener("input", () => {
        const row = rows[Number(input.dataset.row)];
        row[input.dataset.field] = Number(input.value) || 0;
        calculate();
      });
    });
  }

  function applyPreset() {
    const preset = document.getElementById("preset").value;
    const total = baselineData?.siteAreaPresetsSqm?.[preset] || 10000;
    rows[0].area = Math.round(total * 0.40);
    rows[1].area = Math.round(total * 0.30);
    rows[2].area = Math.round(total * 0.15);
    rows[3].area = Math.round(total * 0.10);
    rows[4].area = Math.round(total * 0.05);
    buildRows();
    calculate();
  }

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
    const note = document.getElementById("sourceNote");
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
      note.textContent = `Fetching rainfall for ${place.name}…`;
      try {
        const rain = await ecoliveLocation.annualRainfall(place.latitude, place.longitude);
        if (rain) {
          document.getElementById("annualRainfall").value = rain;
          calculate();
          note.textContent = `Annual rainfall ≈ ${rain} mm/yr for ${place.name} (Open-Meteo, 10-year average). Editable — verify against IMD before design.`;
        } else {
          note.textContent = `No rainfall data found for ${place.name}. Enter the value manually.`;
        }
      } catch {
        note.textContent = "Could not fetch rainfall automatically. Enter the value manually.";
      }
    });
    document.addEventListener("click", (event) => {
      if (!event.target.closest(".combo")) box.hidden = true;
    });
  }

  function calculate() {
    const annualRainfall = Number(document.getElementById("annualRainfall").value) || 0;
    const eventRainfall = Number(document.getElementById("eventRainfall").value) || 0;
    const efficiency = (Number(document.getElementById("collectionEfficiency").value) || 0) / 100;
    const loss = (Number(document.getElementById("lossPercent").value) || 0) / 100;
    let annualGross = 0;
    let eventGross = 0;

    rows.forEach((row, index) => {
      const annual = row.area * annualRainfall * row.coefficient;
      const event = row.area * eventRainfall * row.coefficient;
      annualGross += annual;
      eventGross += event;
      document.getElementById(`annual-${index}`).textContent = format(annual);
      document.getElementById(`event-${index}`).textContent = format(event);
    });

    const netFactor = Math.max(0, efficiency * (1 - loss));
    const annualNet = annualGross * netFactor;
    const eventNet = eventGross * netFactor;
    document.getElementById("heroRunoff").textContent = `${format(annualGross)} L`;
    document.getElementById("annualGross").textContent = format(annualGross);
    document.getElementById("annualNet").textContent = format(annualNet);
    document.getElementById("eventGross").textContent = format(eventGross);
    document.getElementById("storage").textContent = `${format(eventNet * 0.25 / 1000)} KL`;
  }

  async function init() {
    buildRows();
    baselineData = await fetch(ECOLIVE_BASELINES_URL).then((response) => response.json()).catch(() => null);
    setupLocation();
    document.getElementById("preset").addEventListener("change", applyPreset);
    ["annualRainfall", "eventRainfall", "collectionEfficiency", "lossPercent"].forEach((id) => {
      document.getElementById(id).addEventListener("input", calculate);
    });
    document.getElementById("sampleBtn").addEventListener("click", () => {
      document.getElementById("preset").value = "medium-factory";
      document.getElementById("annualRainfall").value = 505;
      document.getElementById("eventRainfall").value = 50;
      document.getElementById("collectionEfficiency").value = 85;
      document.getElementById("lossPercent").value = 10;
      applyPreset();
      calculate();
    });
    document.getElementById("resetBtn").addEventListener("click", () => {
      rows.forEach((row) => { row.area = 0; });
      buildRows();
      calculate();
    });
    applyPreset();
  }

  init();
</script>
<?php
get_footer();
