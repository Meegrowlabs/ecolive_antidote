# Ecolive Organic Precision — WordPress theme

An editorial blog theme implementing the **Organic Precision** design system from `website/design.md`. Manrope typography, deep-forest palette, glass header, no-line surface hierarchy, and rounded data primitives. Built for long-form ESG and sustainability writing.

## Theme entry file

**`style.css`** is the theme's identity file — WordPress reads its header to register the theme. The folder name (`ecolive-organic`) is the theme slug.

## File layout

```
wordpress-theme/
└── ecolive-organic/
    ├── style.css          ← theme metadata + complete design-system CSS
    ├── functions.php      ← theme setup, asset loading, helpers
    ├── header.php         ← glass nav + reading-progress bar
    ├── footer.php         ← deep-forest panel + widget area
    ├── index.php          ← blog listing (hero + featured + grid + pagination)
    ├── single.php         ← single post (editorial body, author card, related)
    ├── archive.php        ← category / tag / author / date archives
    ├── page.php           ← static pages
    ├── search.php         ← search results
    ├── searchform.php     ← reusable pill-shaped search form
    ├── comments.php       ← threaded comments + form
    ├── 404.php            ← editorial empty state
    └── assets/
        └── theme.js       ← mobile menu, reading progress, copy-link
```

## Install

1. **Zip the folder** — `ecolive-organic/`. The zip's top-level entry must be the folder, not the files inside.
2. In WordPress admin, go to **Appearance → Themes → Add New → Upload Theme**, pick the zip, and click **Install Now**, then **Activate**.
3. Set up:
   - **Settings → Reading**: choose a static page for the homepage (optional) and a Posts page (this is where the blog listing renders via `index.php`).
   - **Appearance → Menus**: create a menu and assign it to the **Primary Menu** location. Add at minimum: Home, Programs, ESG Impact, **Insights** (your posts page), About, Contact.
   - **Appearance → Customize → Site Identity**: upload your logo and tagline.
4. Add **Categories** that match the design's topic pills: `Water`, `Waste`, `Energy`, `Wellness`, `CSR`, `ESG`. The first category attached to a post becomes its chip label.

## Authoring tips (for the design to land)

- **Use the Featured Image** on every post. The listing's hero card and the single-post hero both rely on it. Recommended size: 1600×1000 or larger.
- **Write a custom Excerpt** (Document → Excerpt panel). The lede paragraph and listing summaries pull from it; falling back to auto-excerpts works but reads less editorial.
- **Drop cap**: in the Gutenberg paragraph block, toggle Typography → Drop cap on the first paragraph.
- **Block quotes** are styled into the design's italic, oversize blockquote — use the standard Quote block.
- **Wide / Full-width** image and group blocks honour `align-wide` and `align-full`.
- **Code blocks** invert to deep-forest with `secondary-fixed` text — useful for technical posts.

## Design tokens (CSS variables)

All Organic Precision tokens live as CSS custom properties on `:root` in `style.css`. To recolour or tweak, edit there — every component reads through `var(--token)`.

```
--primary             #00261b   Deep Forest (anchors)
--primary-container   #0b3d2e   used in CTA gradient
--secondary           #006e09   Vibrant Growth (links, focus state)
--secondary-fixed     #97fa85   accent green
--tertiary-fixed      #c2e8ff   sky blue (water/wellness chips)
--surface             #f7faf8   Level 0 base
--surface-container-low #f1f4f2 Level 1 (sections)
--surface-container-lowest #ffffff Level 2 (cards)
--on-surface          #181c1b   body text
--outline-variant     #c0c8c3   ghost border
```

## What it does NOT bundle

- **No external blocks plugin.** Uses core Gutenberg blocks; no ACF or custom CPTs needed.
- **No analytics.** Add via Site Kit, GA4, or your preferred plugin.
- **No newsletter integration.** The footer / CTA forms are visual placeholders; wire them to Mailchimp / ConvertKit / native plugin of your choice.
- **No translation files** — strings are gettext-ready; drop a `.po`/`.mo` into `languages/` to localize.

## Pairing with the static site

The theme matches `website/blog.html` (listing) and `website/blog-post.html` (single) one-to-one — same nav, same hero, same card layout, same article-body typography. Two ways to use them together:

1. **WordPress as the blog only.** Host WP at `blog.ecolive.in` (or `/blog`), keep the static marketing pages (`index.html`, `Water_ESG.html`, etc.) on the apex domain, and link "Insights" in the nav at the WordPress URL. The `blog.html` / `blog-post.html` files then serve as design references that should be deleted from production.
2. **Full WordPress.** Recreate the static marketing pages as WP pages using the page template (`page.php`) and reusable patterns. The `Insights` nav link becomes the WP posts page.
