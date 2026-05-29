<?php
/**
 * 404 — empty state.
 *
 * @package ecolive-organic
 */
get_header();
?>
<main>
<section class="relative pt-44 pb-16 md:pt-56 px-6 overflow-hidden">
  <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-secondary-fixed/30 via-surface to-surface"></div>
  <div class="max-w-3xl mx-auto text-center">
    <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">404</p>
    <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter mb-6">This page <span class="text-gradient">wandered off.</span></h1>
    <p class="text-lg text-on-surface-variant mb-10">The link is broken, or the page has moved. Try a search, or head back home.</p>
    <div class="max-w-md mx-auto mb-8"><?php get_search_form(); ?></div>
    <a class="inline-block px-8 py-4 btn-primary-gradient text-on-primary rounded-full font-bold" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'ecolive-organic' ); ?></a>
  </div>
</section>
</main>
<?php
get_footer();
