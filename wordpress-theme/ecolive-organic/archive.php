<?php
/**
 * Archive — categories, tags, authors, dates.
 *
 * @package ecolive-organic
 */
get_header();
?>
<main>
<section class="relative pt-40 pb-12 md:pt-52 md:pb-16 px-6 overflow-hidden">
  <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-secondary-fixed/30 via-surface to-surface"></div>
  <div class="max-w-7xl mx-auto">
    <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">
      <?php
      if ( is_category() ) { esc_html_e( 'Topic', 'ecolive-organic' ); }
      elseif ( is_tag() ) { esc_html_e( 'Tag', 'ecolive-organic' ); }
      elseif ( is_author() ) { esc_html_e( 'Author', 'ecolive-organic' ); }
      elseif ( is_date() ) { esc_html_e( 'Archive', 'ecolive-organic' ); }
      else { esc_html_e( 'Blog', 'ecolive-organic' ); }
      ?>
    </p>
    <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter"><?php the_archive_title(); ?></h1>
    <?php if ( $desc = get_the_archive_description() ) : ?>
      <div class="text-lg text-on-surface-variant max-w-2xl mt-6"><?php echo wp_kses_post( $desc ); ?></div>
    <?php endif; ?>
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
      <h2 class="font-headline text-3xl font-bold mb-4"><?php esc_html_e( 'Nothing matches.', 'ecolive-organic' ); ?></h2>
      <p class="text-on-surface-variant mb-8"><?php esc_html_e( 'Try a different topic or come back soon.', 'ecolive-organic' ); ?></p>
      <div class="max-w-md mx-auto"><?php get_search_form(); ?></div>
    </div>
    <?php endif; ?>
  </div>
</section>
</main>
<?php
get_footer();
