<?php
/**
 * Search results.
 *
 * @package ecolive-organic
 */
get_header(); ?>

<section class="eco-blog-hero">
	<div class="eco-blog-hero__inner">
		<div>
			<span class="eco-eyebrow"><?php esc_html_e( 'Search', 'ecolive-organic' ); ?></span>
			<h1>
				<?php
				/* translators: %s: search query */
				printf( esc_html__( 'Results for %s', 'ecolive-organic' ), '<span class="eco-text-gradient">&ldquo;' . esc_html( get_search_query() ) . '&rdquo;</span>' );
				?>
			</h1>
		</div>
		<?php get_search_form(); ?>
	</div>
</section>

<?php if ( have_posts() ) : ?>
<section class="eco-grid">
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="eco-card" id="post-<?php the_ID(); ?>">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="eco-card__media">
					<?php the_post_thumbnail( 'ecolive-card', array( 'alt' => get_the_title() ) ); ?>
				</div>
				<?php endif; ?>
				<div class="eco-card__meta">
					<span class="eco-cat"><?php echo ecolive_organic_primary_category(); ?></span>
					<span><?php echo esc_html( get_the_date() ); ?></span>
				</div>
				<h3 class="eco-card__title"><?php the_title(); ?></h3>
				<p class="eco-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
			</a>
		</article>
	<?php endwhile; ?>
</section>
<?php ecolive_organic_pagination(); ?>
<?php else : ?>
<section class="eco-container" style="padding: 6rem 1.5rem; text-align:center;">
	<h2><?php esc_html_e( 'Nothing matched.', 'ecolive-organic' ); ?></h2>
	<p style="color: var(--on-surface-variant); margin: 1rem 0 2rem;"><?php esc_html_e( 'Try a different phrase.', 'ecolive-organic' ); ?></p>
	<?php get_search_form(); ?>
</section>
<?php endif; ?>

<?php get_footer(); ?>
