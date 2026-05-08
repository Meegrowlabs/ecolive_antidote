<?php
/**
 * Single post — editorial layout with reading-progress bar, author card, and
 * "keep reading" related grid.
 *
 * @package ecolive-organic
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="eco-single__header">
		<div class="eco-prose">
			<a class="eco-single__back" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/' ) ); ?>">
				<span class="material-symbols-outlined" aria-hidden="true" style="font-size:1rem;">arrow_back</span>
				<?php esc_html_e( 'Back to Insights', 'ecolive-organic' ); ?>
			</a>

			<div class="eco-card__meta" style="margin-bottom: 2rem;">
				<span class="eco-cat" style="padding: 0.4rem 0.75rem; background: rgba(151, 250, 133, 0.4); color: var(--primary); border-radius: 9999px; letter-spacing: 0.1em;">
					<?php echo ecolive_organic_primary_category(); ?>
				</span>
				<span><?php echo esc_html( ecolive_organic_reading_time() ); ?></span>
				<span><?php echo esc_html( get_the_date() ); ?></span>
			</div>

			<h1 class="eco-single__title"><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="eco-single__lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>

			<div class="eco-single__byline" style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:1.5rem;align-items:center;">
				<div style="display:flex;align-items:center;gap:1rem;">
					<div class="eco-avatar" style="width:3.5rem;height:3.5rem;"><?php echo get_avatar( get_the_author_meta( 'ID' ), 56 ); ?></div>
					<div>
						<strong style="display:block;color:var(--on-surface);"><?php the_author(); ?></strong>
						<span style="font-size:0.875rem;color:var(--on-surface-variant);"><?php echo esc_html( get_the_author_meta( 'description' ) ?: __( 'Ecolive Editorial', 'ecolive-organic' ) ); ?></span>
					</div>
				</div>
				<div style="display:flex;gap:0.5rem;">
					<a class="eco-btn-secondary" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'ecolive-organic' ); ?>" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( get_permalink() ); ?>" style="padding:0.6rem;">
						<span class="material-symbols-outlined" aria-hidden="true">share</span>
					</a>
					<a class="eco-btn-secondary" aria-label="<?php esc_attr_e( 'Copy link', 'ecolive-organic' ); ?>" data-copy="<?php echo esc_attr( get_permalink() ); ?>" href="#" style="padding:0.6rem;">
						<span class="material-symbols-outlined" aria-hidden="true">link</span>
					</a>
				</div>
			</div>
		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
	<figure class="eco-single__hero">
		<div class="eco-single__hero-img"><?php the_post_thumbnail( 'ecolive-hero', array( 'alt' => get_the_title() ) ); ?></div>
		<?php $caption = get_the_post_thumbnail_caption(); if ( $caption ) : ?>
			<figcaption class="eco-single__caption"><?php echo esc_html( $caption ); ?></figcaption>
		<?php endif; ?>
	</figure>
	<?php endif; ?>

	<div class="eco-article-body">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="post-page-links" style="margin-top:2rem;">' . esc_html__( 'Pages:', 'ecolive-organic' ),
			'after'  => '</div>',
		) );
		?>
	</div>

	<?php if ( get_the_tag_list() ) : ?>
	<div class="eco-prose" style="padding: 0 1.5rem 4rem; display:flex;flex-wrap:wrap;gap:0.5rem;">
		<?php
		$tags = get_the_tags();
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				echo '<a class="eco-pill" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">#' . esc_html( $tag->name ) . '</a>';
			}
		}
		?>
	</div>
	<?php endif; ?>

	<?php if ( get_the_author_meta( 'description' ) ) : ?>
	<aside class="eco-author-card">
		<div class="eco-author-card__inner">
			<div class="eco-author-card__avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?></div>
			<div style="flex:1;">
				<p style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.1em;font-weight:700;color:var(--outline);margin-bottom:0.5rem;"><?php esc_html_e( 'Written by', 'ecolive-organic' ); ?></p>
				<h3 style="font-size:1.5rem;margin-bottom:0.5rem;"><?php the_author(); ?></h3>
				<p style="color:var(--on-surface-variant);line-height:1.7;margin-bottom:1.5rem;"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
				<a class="eco-btn-secondary" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php esc_html_e( 'All articles by this author →', 'ecolive-organic' ); ?></a>
			</div>
		</div>
	</aside>
	<?php endif; ?>

	<?php
	if ( comments_open() || get_comments_number() ) :
		echo '<div class="eco-comments">';
		comments_template();
		echo '</div>';
	endif;
	?>

</article>

<?php
// Related posts — same primary category, exclude current.
$cats = get_the_category();
if ( ! empty( $cats ) ) :
	$related = new WP_Query( array(
		'category__in'        => array( $cats[0]->term_id ),
		'post__not_in'        => array( get_the_ID() ),
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => 1,
	) );
	if ( $related->have_posts() ) : ?>
<section style="background: var(--surface-container-low); padding: 6rem 0;">
	<div class="eco-container" style="max-width: var(--max-w);">
		<div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:1.5rem;align-items:flex-end;margin-bottom:3rem;">
			<h2 style="font-size: clamp(2rem,4vw,3rem);"><?php esc_html_e( 'Keep reading.', 'ecolive-organic' ); ?></h2>
			<a class="eco-btn-tertiary" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/' ) ); ?>"><?php esc_html_e( 'All articles', 'ecolive-organic' ); ?> &rarr;</a>
		</div>
		<div class="eco-grid" style="padding: 0;">
			<?php while ( $related->have_posts() ) : $related->the_post(); ?>
				<article class="eco-card">
					<a href="<?php the_permalink(); ?>">
						<div class="eco-card__media">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'ecolive-card', array( 'alt' => get_the_title() ) );
							} ?>
						</div>
						<div class="eco-card__meta">
							<span class="eco-cat"><?php echo ecolive_organic_primary_category(); ?></span>
							<span><?php echo esc_html( ecolive_organic_reading_time() ); ?></span>
						</div>
						<h3 class="eco-card__title"><?php the_title(); ?></h3>
					</a>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php
	endif;
	wp_reset_postdata();
endif;
?>

<?php endwhile; ?>

<?php get_footer(); ?>
