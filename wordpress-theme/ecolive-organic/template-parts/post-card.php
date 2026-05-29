<?php
/**
 * One post card — used in the blog listing, archives and search.
 * Expects to run inside The Loop.
 *
 * @package ecolive-organic
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$eco_cat = ecolive_organic_primary_category();
?>
<article class="group flex flex-col h-full">
  <a href="<?php the_permalink(); ?>" class="block h-full flex flex-col">
    <div class="aspect-[4/3] rounded-xl overflow-hidden mb-6 bg-surface-container flex items-center justify-center flex-shrink-0">
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'ecolive-card', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700' ) ); ?>
      <?php else : ?>
        <span class="material-symbols-outlined text-6xl text-outline">eco</span>
      <?php endif; ?>
    </div>
    <div class="flex items-center gap-3 mb-3">
      <?php if ( $eco_cat ) : ?><span class="text-[11px] uppercase tracking-widest font-bold text-secondary"><?php echo esc_html( $eco_cat ); ?></span><?php endif; ?>
      <span class="text-[11px] uppercase tracking-widest font-bold text-outline"><?php echo esc_html( ecolive_organic_reading_time() ); ?></span>
      <span class="text-[11px] uppercase tracking-widest font-bold text-outline"><?php echo esc_html( get_the_date() ); ?></span>
    </div>
    <h3 class="font-headline text-xl font-bold mb-3 leading-snug group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
    <p class="text-sm text-on-surface-variant leading-relaxed flex-1"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
  </a>
</article>
