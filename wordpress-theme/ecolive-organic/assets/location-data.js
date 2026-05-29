// Shared location data helpers for EcoLive tools.
// Uses free, key-less, CORS-enabled open APIs:
//   - Open-Meteo Geocoding  : city search -> lat/lon, population, GeoNames id
//   - Open-Meteo Archive     : daily precipitation -> annual average rainfall
//   - Wikidata SPARQL        : city area (P2046) + population (P1082) via GeoNames id (P1566)
(function (global) {
  const GEOCODE = "https://geocoding-api.open-meteo.com/v1/search";
  const ARCHIVE = "https://archive-api.open-meteo.com/v1/archive";
  const WIKIDATA = "https://query.wikidata.org/sparql";

  async function search(query) {
    const q = (query || "").trim();
    if (q.length < 2) return [];
    const url = `${GEOCODE}?name=${encodeURIComponent(q)}&count=6&language=en&format=json`;
    const res = await fetch(url);
    if (!res.ok) throw new Error("geocoding request failed");
    const data = await res.json();
    return (data.results || []).map((r) => ({
      id: r.id,
      name: r.name,
      admin1: r.admin1 || "",
      country: r.country || "",
      latitude: r.latitude,
      longitude: r.longitude,
      population: r.population || null
    }));
  }

  // Average annual precipitation (mm/yr) over the last 10 full calendar years.
  async function annualRainfall(latitude, longitude) {
    const endYear = new Date().getUTCFullYear() - 1;
    const startYear = endYear - 9;
    const url = `${ARCHIVE}?latitude=${latitude}&longitude=${longitude}` +
      `&start_date=${startYear}-01-01&end_date=${endYear}-12-31` +
      `&daily=precipitation_sum&timezone=auto`;
    const res = await fetch(url);
    if (!res.ok) throw new Error("rainfall request failed");
    const data = await res.json();
    const daily = (data.daily && data.daily.precipitation_sum) || [];
    const values = daily.filter((v) => v != null);
    if (!values.length) return null;
    const total = values.reduce((sum, v) => sum + v, 0);
    const years = endYear - startYear + 1;
    return Math.round(total / years);
  }

  // City area (km2) and population from Wikidata, matched by GeoNames id.
  async function cityAreaPopulation(geonameId) {
    const sparql =
      `SELECT ?area ?population WHERE { ` +
      `?item wdt:P1566 "${geonameId}". ` +
      `OPTIONAL { ?item wdt:P2046 ?area } ` +
      `OPTIONAL { ?item wdt:P1082 ?population } } LIMIT 1`;
    const url = `${WIKIDATA}?format=json&query=${encodeURIComponent(sparql)}`;
    const res = await fetch(url, { headers: { Accept: "application/sparql-results+json" } });
    if (!res.ok) throw new Error("wikidata request failed");
    const data = await res.json();
    const binding = data.results && data.results.bindings && data.results.bindings[0];
    if (!binding) return { areaKm2: null, population: null };
    return {
      areaKm2: binding.area ? Math.round(Number(binding.area.value) * 100) / 100 : null,
      population: binding.population ? Math.round(Number(binding.population.value)) : null
    };
  }

  global.ecoliveLocation = { search, annualRainfall, cityAreaPopulation };
})(window);
