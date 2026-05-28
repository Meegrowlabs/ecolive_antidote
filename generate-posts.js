#!/usr/bin/env node
/**
 * Ecolive static post generator
 * Runs at Netlify build time. Fetches all posts from WordPress REST API
 * and writes a fully-rendered HTML file to posts/[slug].html for each.
 *
 * To run locally:   node generate-posts.js
 * After Hostinger migration, update WP_API env var:
 *   WP_API=https://your-hostinger-url/wp-json/wp/v2 node generate-posts.js
 */

const fs   = require('fs');
const path = require('path');

const WP_API = process.env.WP_API || 'https://ecolive.in/wp-json/wp/v2';

/* ── helpers ── */
function fmt(iso) {
  return new Date(iso).toLocaleDateString('en-IN', { day: 'numeric', month: 'long', year: 'numeric' });
}
function readTime(html) {
  const n = (html || '').replace(/<[^>]+>/g, '').split(/\s+/).filter(Boolean).length;
  return Math.max(1, Math.round(n / 200)) + ' min read';
}
function strip(html) { return (html || '').replace(/<[^>]+>/g, ''); }

/* ── fetch every post (handles pagination) ── */
async function fetchAllPosts() {
  let page = 1, all = [];
  while (true) {
    const res  = await fetch(`${WP_API}/posts?per_page=100&page=${page}&_embed`);
    const data = await res.json();
    if (!Array.isArray(data) || !data.length) break;
    all = all.concat(data);
    const total = parseInt(res.headers.get('X-WP-TotalPages') || '1', 10);
    if (page >= total) break;
    page++;
  }
  return all;
}

/* ── shared nav / footer / style (keeps parity with rest of site) ── */
const NAV = `
<nav class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl shadow-[0_10px_40px_rgba(24,28,27,0.04)]">
  <div class="flex justify-between items-center max-w-7xl mx-auto px-6 md:px-8 h-20">
    <a href="/" class="flex items-center gap-2" aria-label="EcoLive Ventures home"><img src="/assets/ecolive-logo.png" alt="EcoLive" class="h-8"></a>
    <div class="hidden md:flex gap-7 items-center text-sm font-semibold tracking-tight">
      <a class="text-on-surface-variant hover:text-primary transition-colors" href="/#challenge">Challenge</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors" href="/#solutions">Solutions</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors" href="/#tools">Tools</a>
      <a class="text-primary border-b-2 border-secondary pb-1" href="/blog">Blogs</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors" href="/#method">Method</a>
      <a class="text-on-surface-variant hover:text-primary transition-colors" href="/#contact">Contact</a>
    </div>
    <button id="mobile-menu-btn" class="md:hidden p-2 text-primary" aria-label="Open menu"><span class="material-symbols-outlined text-3xl">menu</span></button>
    <a href="/#contact" class="hidden md:inline-block px-6 py-2.5 btn-primary-gradient text-on-primary rounded-full font-bold transition-all active:scale-95">Get Started</a>
  </div>
  <div id="mobile-menu" class="hidden md:hidden absolute top-20 left-0 w-full bg-surface/95 backdrop-blur-xl shadow-xl">
    <div class="flex flex-col px-8 py-6 gap-4 text-sm font-semibold">
      <a class="text-on-surface-variant hover:text-primary py-2" href="/#challenge">Challenge</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="/#solutions">Solutions</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="/#tools">Tools</a>
      <a class="text-primary py-2" href="/blog">Blogs</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="/#method">Method</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="/#contact">Contact</a>
    </div>
  </div>
</nav>`;

const FOOTER = `
<footer class="w-full rounded-t-[3rem] mt-20 bg-primary text-on-primary">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-12 max-w-7xl mx-auto px-8 py-16">
    <div>
      <a href="/" class="mb-6 block"><img src="/assets/ecolive-logo.png" alt="EcoLive" class="h-7 brightness-0 invert"></a>
      <p class="font-manrope text-sm leading-relaxed text-primary-fixed/80">EcoLive Ventures Pvt. Ltd. — Wellness of Nature &amp; Nature for Wellness.</p>
    </div>
    <div>
      <h4 class="font-bold text-secondary-fixed mb-6">Blogs</h4>
      <div class="flex flex-col gap-4 font-manrope text-sm">
        <a class="text-primary-fixed/70 hover:text-secondary-fixed" href="/blog">All Articles</a>
      </div>
    </div>
    <div>
      <h4 class="font-bold text-secondary-fixed mb-6">Company</h4>
      <div class="flex flex-col gap-4 font-manrope text-sm">
        <a class="text-primary-fixed/70 hover:text-secondary-fixed" href="/#method">Method</a>
        <a class="text-primary-fixed/70 hover:text-secondary-fixed" href="/#contact">Contact</a>
      </div>
    </div>
    <div>
      <h4 class="font-bold text-secondary-fixed mb-6">Newsletter</h4>
      <p class="text-sm text-primary-fixed/70 mb-4">A monthly note from the field.</p>
      <div class="flex">
        <input class="bg-primary-container border-none rounded-l-full px-4 py-2 text-sm w-full text-on-primary placeholder:text-primary-fixed/50" placeholder="Email address" type="email"/>
        <button class="bg-secondary text-on-secondary px-4 py-2 rounded-r-full"><span class="material-symbols-outlined text-sm">send</span></button>
      </div>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-8 py-8 bg-primary-container/50 rounded-t-3xl text-center">
    <p class="font-manrope text-sm text-primary-fixed/70">© 2025 Ecolive Ventures Pvt. Ltd. All rights reserved.</p>
  </div>
</footer>`;

const HEAD_STYLES = `
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries,typography"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        colors: {
          "primary":"#045e80","on-primary":"#ffffff","primary-container":"#034d6b",
          "primary-fixed":"#c9e8f5","on-primary-fixed":"#04384d","primary-fixed-dim":"#8fcfe6",
          "secondary":"#2f7a39","on-secondary":"#ffffff","secondary-container":"#d3efd6",
          "secondary-fixed":"#b8e6bd","on-secondary-fixed":"#103a16","secondary-fixed-dim":"#8fd199",
          "tertiary":"#0077a8","on-tertiary":"#ffffff",
          "surface":"#f4f9f8","surface-dim":"#dde6e4","surface-variant":"#e3edeb",
          "surface-container-lowest":"#ffffff","surface-container-low":"#eef5f4",
          "surface-container":"#e8f1ef","surface-container-high":"#e2ece9",
          "on-surface":"#14212b","on-surface-variant":"#5b6872",
          "outline":"#7a8a92","outline-variant":"#c2d2d6",
        },
        fontFamily:{"headline":["Manrope","sans-serif"],"body":["Manrope","sans-serif"]},
        borderRadius:{"DEFAULT":"1rem","lg":"2rem","xl":"3rem","full":"9999px"},
      },
    },
  }
<\/script>
<style>
  .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24}
  .btn-primary-gradient{background:linear-gradient(135deg,#045e80 0%,#0077a8 100%)}
  .ghost-border{border:1px solid rgba(192,200,195,0.2)}
  body{font-family:'Manrope',sans-serif;letter-spacing:-0.01em}
  h1,h2,h3,h4{letter-spacing:-0.02em}
  .article-body{font-size:1.125rem;line-height:1.8;color:#181c1b}
  .article-body>*+*{margin-top:1.5rem}
  .article-body h2{font-size:2.25rem;font-weight:800;margin-top:4rem;margin-bottom:1.5rem;line-height:1.15;letter-spacing:-0.02em}
  .article-body h3{font-size:1.625rem;font-weight:700;margin-top:3rem;margin-bottom:1rem;letter-spacing:-0.02em}
  .article-body p{color:#3f4844}
  .article-body a{color:#045e80;text-decoration:underline;text-decoration-color:rgba(4,94,128,.3);text-underline-offset:4px}
  .article-body strong{color:#181c1b;font-weight:700}
  .article-body blockquote{font-size:1.5rem;line-height:1.5;font-weight:600;color:#045e80;padding:2rem 2.5rem;background:#eef5f4;border-radius:1rem;font-style:italic}
  .article-body ul,.article-body ol{padding-left:1.5rem;color:#3f4844}
  .article-body ul li{list-style:disc;margin-bottom:.5rem}
  .article-body ol li{list-style:decimal;margin-bottom:.5rem}
  .article-body img,.article-body figure{border-radius:1rem;overflow:hidden;max-width:100%}
  .article-body hr{border:0;height:1px;background:linear-gradient(to right,transparent,#c0c8c3,transparent);margin:3rem 0}
  .drop-cap>p:first-child::first-letter{font-size:4.5rem;font-weight:800;float:left;line-height:.85;padding:.4rem .75rem 0 0;color:#045e80}
</style>`;

const PAGE_SCRIPT = `
<script>
  const btn = document.getElementById('mobile-menu-btn');
  const menu = document.getElementById('mobile-menu');
  btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
    btn.querySelector('.material-symbols-outlined').textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
  });
  window.addEventListener('scroll', () => {
    const h = document.documentElement;
    const pct = (h.scrollTop / (h.scrollHeight - h.clientHeight)) * 100;
    document.getElementById('reading-progress').style.width = pct + '%';
    document.querySelector('nav').classList.toggle('shadow-xl', window.scrollY > 50);
  });
<\/script>`;

/* ── render one related-post card ── */
function relCard(p) {
  const img = p._embedded?.['wp:featuredmedia']?.[0]?.source_url || '';
  const cat = (p._embedded?.['wp:term']?.[0] || [{ name: 'Insights' }])[0];
  return `
  <article class="group">
    <a href="/blog/${p.slug}/" class="block">
      <div class="aspect-[4/3] rounded-xl overflow-hidden mb-6 bg-surface-container">
        ${img
          ? `<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="${img}" alt="" loading="lazy"/>`
          : `<div class="w-full h-full bg-surface-container flex items-center justify-center"><span class="material-symbols-outlined text-6xl text-outline">eco</span></div>`}
      </div>
      <div class="flex items-center gap-3 mb-3">
        <span class="text-[11px] uppercase tracking-widest font-bold text-secondary">${cat.name}</span>
      </div>
      <h3 class="font-headline text-2xl font-bold mb-3 leading-snug group-hover:text-primary transition-colors">${p.title.rendered}</h3>
    </a>
  </article>`;
}

/* ── generate one full HTML page ── */
function generatePostPage(post, related) {
  const featImg = post._embedded?.['wp:featuredmedia']?.[0]?.source_url || '';
  const cats    = post._embedded?.['wp:term']?.[0] || [];
  const cat     = cats[0] || { name: 'Insights' };
  const author  = post._embedded?.author?.[0] || { name: 'Ecolive Team', description: '' };
  const avatar  = author.avatar_urls?.['96'] || '';
  const title   = strip(post.title.rendered);
  const excerpt = strip(post.excerpt.rendered).trim();
  const rt      = readTime(post.content.rendered);
  const date    = fmt(post.date);
  const relHtml = related.map(relCard).join('');

  return `<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-58F3DZWZ');<\/script>
<!-- End Google Tag Manager -->
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>${title} | EcoLive Blog</title>
<meta name="description" content="${excerpt.substring(0, 160)}"/>
<meta property="og:title" content="${title}"/>
<meta property="og:description" content="${excerpt.substring(0, 160)}"/>
<meta property="og:type" content="article"/>
${featImg ? `<meta property="og:image" content="${featImg}"/>` : ''}
<link rel="canonical" href="https://ecolive.in/blog/${post.slug}/"/>
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
${HEAD_STYLES}
</head>
<body class="bg-surface text-on-surface font-body overflow-x-hidden">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58F3DZWZ" height="0" width="0" style="display:none;visibility:hidden"><\/iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

${NAV}

<div class="fixed top-20 left-0 w-full h-1 bg-surface-container-low z-40">
  <div id="reading-progress" class="h-full btn-primary-gradient transition-all duration-150" style="width:0%"></div>
</div>

<main>
  <article>
    <header class="pt-32 md:pt-40 pb-16 px-6">
      <div class="max-w-3xl mx-auto">
        <a href="/blog" class="inline-flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors mb-10">
          <span class="material-symbols-outlined text-base">arrow_back</span> Back to Blog
        </a>
        <div class="flex flex-wrap items-center gap-3 mb-8">
          <span class="px-3 py-1 bg-secondary-fixed/40 text-primary text-xs font-bold tracking-widest uppercase rounded-full">${cat.name}</span>
          <span class="text-xs uppercase tracking-widest font-bold text-outline">${rt}</span>
          <span class="text-xs uppercase tracking-widest font-bold text-outline">${date}</span>
        </div>
        <h1 class="font-headline text-4xl md:text-6xl font-extrabold tracking-tighter leading-[1.05] mb-10">${post.title.rendered}</h1>
        <p class="text-xl md:text-2xl text-on-surface-variant leading-relaxed mb-12">${excerpt}</p>
        <div class="flex items-center justify-between flex-wrap gap-6">
          <div class="flex items-center gap-4">
            ${avatar
              ? `<div class="w-14 h-14 rounded-full overflow-hidden bg-surface-variant"><img alt="${author.name}" class="w-full h-full object-cover" src="${avatar}"/></div>`
              : `<div class="w-14 h-14 rounded-full bg-surface-container flex items-center justify-center"><span class="material-symbols-outlined">person</span></div>`}
            <div>
              <p class="font-bold text-on-surface">${author.name}</p>
              <p class="text-sm text-on-surface-variant">Ecolive Ventures</p>
            </div>
          </div>
          <div class="flex items-center gap-3">
            <button onclick="(navigator.share?navigator.share({title:document.title,url:location.href}):navigator.clipboard.writeText(location.href))" class="w-11 h-11 rounded-full bg-surface-container-lowest ghost-border flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Share"><span class="material-symbols-outlined text-base">share</span></button>
            <button onclick="navigator.clipboard.writeText(location.href)" class="w-11 h-11 rounded-full bg-surface-container-lowest ghost-border flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" title="Copy link"><span class="material-symbols-outlined text-base">link</span></button>
          </div>
        </div>
      </div>
    </header>

    ${featImg ? `
    <figure class="px-6 mb-20">
      <div class="max-w-6xl mx-auto aspect-[21/9] rounded-xl overflow-hidden">
        <img class="w-full h-full object-cover" alt="${title}" src="${featImg}"/>
      </div>
    </figure>` : ''}

    <div class="px-6 pb-24">
      <div class="max-w-3xl mx-auto article-body drop-cap">
        ${post.content.rendered}
      </div>
    </div>
  </article>

  <section class="px-6 pb-24">
    <div class="max-w-3xl mx-auto bg-surface-container-lowest rounded-xl p-10 flex flex-col md:flex-row items-start gap-8">
      ${avatar
        ? `<div class="w-20 h-20 rounded-full overflow-hidden bg-surface-variant flex-shrink-0"><img alt="${author.name}" class="w-full h-full object-cover" src="${avatar}"/></div>`
        : `<div class="w-20 h-20 rounded-full bg-surface-container flex-shrink-0 flex items-center justify-center"><span class="material-symbols-outlined text-3xl">person</span></div>`}
      <div class="flex-1">
        <p class="text-xs uppercase tracking-widest font-bold text-outline mb-2">Written by</p>
        <h3 class="font-headline text-2xl font-bold mb-2">${author.name}</h3>
        <p class="text-on-surface-variant leading-relaxed mb-6">${author.description || 'Ecolive Ventures Pvt. Ltd. — working at the intersection of water, waste, energy, and human wellbeing.'}</p>
        <a href="/blog" class="px-5 py-2 rounded-full ghost-border text-sm font-bold text-on-surface-variant hover:text-primary transition-colors">All articles →</a>
      </div>
    </div>
  </section>

  ${relHtml ? `
  <section class="px-6 pb-24 bg-surface-container-low pt-24 -mt-24">
    <div class="max-w-7xl mx-auto">
      <div class="flex items-end justify-between flex-wrap gap-6 mb-12">
        <h2 class="font-headline text-3xl md:text-5xl font-extrabold tracking-tighter">Keep reading.</h2>
        <a href="/blog" class="text-secondary font-bold flex items-center gap-2 hover:gap-4 transition-all">All articles <span class="material-symbols-outlined">arrow_forward</span></a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">${relHtml}</div>
    </div>
  </section>` : ''}
</main>

${FOOTER}

${PAGE_SCRIPT}
</body>
</html>`;
}

/* ── main ── */
async function main() {
  console.log(`\n📡  Fetching posts from ${WP_API} …`);

  let posts;
  try {
    posts = await fetchAllPosts();
  } catch (err) {
    console.error('⚠️  Could not reach WordPress API:', err.message);
    console.error('    Skipping post generation — site will still deploy with dynamic fallback.');
    process.exit(0);
  }

  console.log(`✅  Found ${posts.length} post(s)\n`);

  const postsDir = path.join(__dirname, 'posts');
  if (!fs.existsSync(postsDir)) fs.mkdirSync(postsDir);

  for (const post of posts) {
    const related = posts.filter(p => p.id !== post.id).slice(0, 3);
    const html    = generatePostPage(post, related);
    const outPath = path.join(postsDir, `${post.slug}.html`);
    fs.writeFileSync(outPath, html, 'utf-8');
    console.log(`  ✓  posts/${post.slug}.html`);
  }

  console.log(`\n🚀  Done — ${posts.length} static page(s) written to /posts/\n`);
}

main();
