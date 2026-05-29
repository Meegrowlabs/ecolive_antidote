<?php
/**
 * Search results.
 *
 * @package ecolive-organic
 */
get_header();
?>
<main>
<section class="relative pt-40 pb-12 md:pt-52 md:pb-16 px-6 overflow-hidden">
  <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-secondary-fixed/30 via-surface to-surface"></div>
  <div class="max-w-7xl mx-auto">
    <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4"><?php esc_html_e( 'Search', 'ecolive-organic' ); ?></p>
    <h1 class="font-headline text-4xl md:text-6xl font-extrabold tracking-tighter mb-8">
      <?php /* translators: %s: search query */ printf( esc_html__( 'Results for %s', 'ecolive-organic' ), '<span class="text-gradient">&ldquo;' . esc_html( get_search_query() ) . '&rdquo;</span>' ); ?>
    </h1>
    <div class="max-w-md"><?php get_search_form(); ?></div>
  </div>
</section>

<section class="px-6 pb-24">
  <div class="max-w-7xl mx-auto">
    <?php if ( have_posts() ) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 items-stretch">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/post-card' ); ?>
      <?php endwhile; ?>
    </div>
    <?php ecolive_organic_pagination(); ?>
    <?php else : ?>
    <div class="py-16 text-center">
      <h2 class="font-headline text-3xl font-bold mb-4"><?php esc_html_e( 'Nothing matched.', 'ecolive-organic' ); ?></h2>
      <p class="text-on-surface-variant mb-8"><?php esc_html_e( 'Try a different phrase.', 'ecolive-organic' ); ?></p>
      <div class="max-w-md mx-auto"><?php get_search_form(); ?></div>
    </div>
    <?php endif; ?>
  </div>
</section>
</main>
<?php
get_footer();
