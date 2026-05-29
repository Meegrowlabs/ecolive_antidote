<?php
/**
 * Static page template — editorial body styles.
 *
 * @package ecolive-organic
 */
get_header();

while ( have_posts() ) : the_post();
?>
<main>
<article>
  <header class="pt-32 md:pt-44 pb-10 px-6">
    <div class="max-w-3xl mx-auto">
      <h1 class="font-headline text-4xl md:text-6xl font-extrabold tracking-tighter leading-[1.05]"><?php the_title(); ?></h1>
    </div>
  </header>

  <?php if ( has_post_thumbnail() ) : ?>
  <figure class="px-6 mb-16">
    <div class="max-w-6xl mx-auto aspect-[21/9] rounded-xl overflow-hidden">
      <?php the_post_thumbnail( 'ecolive-hero', array( 'class' => 'w-full h-full object-cover' ) ); ?>
    </div>
  </figure>
  <?php endif; ?>

  <div class="px-6 pb-24">
    <div class="max-w-3xl mx-auto article-body">
      <?php the_content(); ?>
      <?php wp_link_pages( array( 'before' => '<div class="post-page-links mt-8 font-bold">' . esc_html__( 'Pages:', 'ecolive-organic' ) . ' ', 'after' => '</div>' ) ); ?>
    </div>

    <?php
    if ( comments_open() || get_comments_number() ) {
      echo '<div class="eco-comments max-w-3xl mx-auto mt-12">';
      comments_template();
      echo '</div>';
    }
    ?>
  </div>
</article>
</main>
<?php
endwhile;
get_footer();
