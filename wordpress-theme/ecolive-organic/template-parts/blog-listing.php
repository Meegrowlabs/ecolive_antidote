<?php
/**
 * Blog listing body — editorial hero, category pills, post grid, pagination,
 * newsletter CTA. Shared by home.php and index.php.
 *
 * @package ecolive-organic
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$eco_cats    = get_categories( array( 'hide_empty' => true, 'number' => 12 ) );
$eco_blog    = ecolive_blog_url();
$eco_active  = is_category() ? (int) get_queried_object_id() : 0;
?>
<main>
<!-- Editorial Hero -->
<section class="relative pt-40 pb-16 md:pt-56 md:pb-24 px-6 overflow-hidden">
  <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-secondary-fixed/30 via-surface to-surface"></div>
  <div class="absolute -top-20 -right-20 w-96 h-96 bg-secondary-fixed/30 rounded-full blur-3xl"></div>
  <div class="absolute top-1/2 -left-20 w-64 h-64 bg-tertiary-fixed/30 rounded-full blur-3xl"></div>
  <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-end">
    <div class="lg:col-span-8">
      <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-fixed/40 text-primary rounded-full mb-8 font-semibold text-sm">
        <span class="material-symbols-outlined text-sm">menu_book</span>
        The Living Document
      </div>
      <h1 class="font-headline text-6xl md:text-8xl font-extrabold tracking-tighter text-on-surface max-w-4xl leading-[0.9] mb-6">
        Field <span class="text-gradient">notes</span> from the regenerative economy.
      </h1>
    </div>
    <div class="lg:col-span-4">
      <p class="text-lg md:text-xl text-on-surface-variant leading-relaxed">
        Long reads, technical breakdowns, and case studies from the EcoLive teams working at the intersection of water, waste, energy, and human wellbeing.
      </p>
    </div>
  </div>
</section>

<section class="px-6 pb-24">
  <div class="max-w-7xl mx-auto">
    <?php if ( $eco_cats ) : ?>
    <!-- Category filter bar -->
    <div class="flex flex-wrap gap-3 mb-10">
      <a href="<?php echo esc_url( $eco_blog ); ?>" class="px-5 py-2 rounded-full text-sm font-bold <?php echo $eco_active ? 'border border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary transition-all' : 'bg-primary text-on-primary'; ?>">All</a>
      <?php foreach ( $eco_cats as $eco_c ) : ?>
        <a href="<?php echo esc_url( get_category_link( $eco_c->term_id ) ); ?>" class="px-5 py-2 rounded-full text-sm font-bold <?php echo ( $eco_active === (int) $eco_c->term_id ) ? 'bg-primary text-on-primary' : 'border border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary transition-all'; ?>"><?php echo esc_html( $eco_c->name ); ?></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Post grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 items-stretch">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'template-parts/post-card' ); ?>
        <?php endwhile; ?>
      <?php else : ?>
        <div class="col-span-full py-16 text-center text-on-surface-variant font-semibold">No articles found yet. Check back soon.</div>
      <?php endif; ?>
    </div>

    <?php ecolive_organic_pagination(); ?>
  </div>
</section>

<!-- Newsletter CTA -->
<section class="px-6 pb-24">
  <div class="max-w-7xl mx-auto btn-primary-gradient text-on-primary rounded-xl p-12 md:p-20 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-secondary-fixed/20 rounded-full blur-3xl"></div>
    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div>
        <h2 class="font-headline text-4xl md:text-5xl font-extrabold tracking-tighter mb-6 leading-tight">A monthly note from the field.</h2>
        <p class="text-lg text-primary-fixed/90 leading-relaxed max-w-md">One long-form essay, one project update, one number that surprised us. No promotions. Unsubscribe in a click.</p>
      </div>
      <form class="flex flex-col sm:flex-row gap-3" data-demo-form>
        <input class="flex-1 px-6 py-4 rounded-full bg-primary-container border-transparent text-on-primary placeholder:text-primary-fixed/50 focus:ring-2 focus:ring-secondary-fixed focus:border-transparent" placeholder="you@company.com" type="email" required/>
        <button type="submit" class="px-8 py-4 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold hover:bg-secondary-fixed-dim transition-colors active:scale-95">Subscribe</button>
        <p role="status" aria-live="polite" class="hidden"></p>
      </form>
    </div>
  </div>
</section>
</main>
