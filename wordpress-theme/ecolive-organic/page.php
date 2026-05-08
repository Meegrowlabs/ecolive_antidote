<?php
/**
 * Static page template — uses the same editorial body styles.
 *
 * @package ecolive-organic
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="eco-single__header">
		<div class="eco-prose">
			<h1 class="eco-single__title"><?php the_title(); ?></h1>
		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
	<figure class="eco-single__hero">
		<div class="eco-single__hero-img"><?php the_post_thumbnail( 'ecolive-hero', array( 'alt' => get_the_title() ) ); ?></div>
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

	<?php
	if ( comments_open() || get_comments_number() ) :
		echo '<div class="eco-comments">';
		comments_template();
		echo '</div>';
	endif;
	?>
</article>
<?php endwhile; ?>

<?php get_footer(); ?>
