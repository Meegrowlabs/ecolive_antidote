<?php
/**
 * Single post — editorial layout (ported from blog-post.html).
 *
 * @package ecolive-organic
 */
get_header();
$eco_blog = ecolive_blog_url();

while ( have_posts() ) : the_post();
	$eco_cat = ecolive_organic_primary_category();
?>
<main>
<article>
  <header class="pt-32 md:pt-40 pb-16 px-6">
    <div class="max-w-3xl mx-auto">
      <a href="<?php echo esc_url( $eco_blog ); ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors mb-10">
        <span class="material-symbols-outlined text-base">arrow_back</span> Back to Blog
      </a>
      <div class="flex flex-wrap items-center gap-3 mb-8">
        <?php if ( $eco_cat ) : ?><span class="px-3 py-1 bg-secondary-fixed/40 text-primary text-xs font-bold tracking-widest uppercase rounded-full"><?php echo esc_html( $eco_cat ); ?></span><?php endif; ?>
        <span class="text-xs uppercase tracking-widest font-bold text-outline"><?php echo esc_html( ecolive_organic_reading_time() ); ?></span>
        <span class="text-xs uppercase tracking-widest font-bold text-outline"><?php echo esc_html( get_the_date() ); ?></span>
      </div>
      <h1 class="font-headline text-4xl md:text-6xl font-extrabold tracking-tighter leading-[1.05] mb-10"><?php the_title(); ?></h1>
      <?php if ( has_excerpt() ) : ?>
        <p class="text-xl md:text-2xl text-on-surface-variant leading-relaxed mb-12"><?php echo esc_html( get_the_excerpt() ); ?></p>
      <?php endif; ?>
      <div class="flex items-center justify-between flex-wrap gap-6">
        <div class="flex items-center gap-4">
          <div class="w-14 h-14 rounded-full overflow-hidden bg-surface-variant"><?php echo get_avatar( get_the_author_meta( 'ID' ), 56, '', '', array( 'class' => 'w-full h-full object-cover' ) ); ?></div>
          <div>
            <p class="font-bold text-on-surface"><?php the_author(); ?></p>
            <p class="text-sm text-on-surface-variant">EcoLive Ventures</p>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener" class="w-11 h-11 rounded-full bg-surface-container-lowest ghost-border flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" aria-label="Share"><span class="material-symbols-outlined text-base">share</span></a>
          <a href="#" data-copy="<?php echo esc_attr( get_permalink() ); ?>" class="w-11 h-11 rounded-full bg-surface-container-lowest ghost-border flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors" aria-label="Copy link"><span class="material-symbols-outlined text-base">link</span></a>
        </div>
      </div>
    </div>
  </header>

  <?php if ( has_post_thumbnail() ) : ?>
  <figure class="px-6 mb-20">
    <div class="max-w-6xl mx-auto aspect-[21/9] rounded-xl overflow-hidden">
      <?php the_post_thumbnail( 'ecolive-hero', array( 'class' => 'w-full h-full object-cover' ) ); ?>
    </div>
    <?php $eco_caption = get_the_post_thumbnail_caption(); if ( $eco_caption ) : ?>
      <figcaption class="text-center text-sm text-outline mt-3 max-w-3xl mx-auto"><?php echo esc_html( $eco_caption ); ?></figcaption>
    <?php endif; ?>
  </figure>
  <?php endif; ?>

  <div class="px-6 pb-24">
    <div class="max-w-3xl mx-auto article-body drop-cap">
      <?php the_content(); ?>
      <?php wp_link_pages( array( 'before' => '<div class="post-page-links mt-8 font-bold">' . esc_html__( 'Pages:', 'ecolive-organic' ) . ' ', 'after' => '</div>' ) ); ?>
    </div>

    <?php if ( get_the_tag_list() ) : ?>
    <div class="max-w-3xl mx-auto mt-10 flex flex-wrap gap-2">
      <?php foreach ( (array) get_the_tags() as $eco_tag ) : ?>
        <a class="px-4 py-2 rounded-full text-sm font-semibold border border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary transition-all" href="<?php echo esc_url( get_tag_link( $eco_tag->term_id ) ); ?>">#<?php echo esc_html( $eco_tag->name ); ?></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</article>

<?php if ( get_the_author_meta( 'description' ) ) : ?>
<section class="px-6 pb-24">
  <div class="max-w-3xl mx-auto bg-surface-container-lowest rounded-xl p-10 flex flex-col md:flex-row items-start gap-8">
    <div class="w-20 h-20 rounded-full overflow-hidden bg-surface-variant flex-shrink-0"><?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'w-full h-full object-cover' ) ); ?></div>
    <div class="flex-1">
      <p class="text-xs uppercase tracking-widest font-bold text-outline mb-2">Written by</p>
      <h3 class="font-headline text-2xl font-bold mb-2"><?php the_author(); ?></h3>
      <p class="text-on-surface-variant leading-relaxed mb-6"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
      <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="px-5 py-2 rounded-full ghost-border text-sm font-bold text-on-surface-variant hover:text-primary transition-colors">All articles →</a>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
if ( comments_open() || get_comments_number() ) {
	echo '<div class="eco-comments max-w-3xl mx-auto px-6 pb-24">';
	comments_template();
	echo '</div>';
}

// Related posts — same primary category, exclude current.
$eco_cats = get_the_category();
if ( ! empty( $eco_cats ) ) :
	$eco_related = new WP_Query( array(
		'category__in'        => array( $eco_cats[0]->term_id ),
		'post__not_in'        => array( get_the_ID() ),
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => true,
	) );
	if ( $eco_related->have_posts() ) : ?>
<section class="px-6 pb-24 bg-surface-container-low pt-24">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-end justify-between flex-wrap gap-6 mb-12">
      <h2 class="font-headline text-3xl md:text-5xl font-extrabold tracking-tighter">Keep reading.</h2>
      <a href="<?php echo esc_url( $eco_blog ); ?>" class="text-secondary font-bold flex items-center gap-2 hover:gap-4 transition-all">All articles <span class="material-symbols-outlined">arrow_forward</span></a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      <?php while ( $eco_related->have_posts() ) : $eco_related->the_post(); ?>
        <?php get_template_part( 'template-parts/post-card' ); ?>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php
	endif;
	wp_reset_postdata();
endif;
?>
</main>
<?php
endwhile;
get_footer();
