<?php
/**
 * Archive — categories, tags, authors, dates.
 *
 * @package ecolive-organic
 */
get_header(); ?>

<section class="eco-blog-hero">
	<div class="eco-blog-hero__inner">
		<div>
			<span class="eco-eyebrow"><?php
				if ( is_category() )       { esc_html_e( 'Topic', 'ecolive-organic' ); }
				elseif ( is_tag() )        { esc_html_e( 'Tag', 'ecolive-organic' ); }
				elseif ( is_author() )     { esc_html_e( 'Author', 'ecolive-organic' ); }
				elseif ( is_date() )       { esc_html_e( 'Archive', 'ecolive-organic' ); }
				else                       { esc_html_e( 'Insights', 'ecolive-organic' ); }
			?></span>
			<h1>
				<?php the_archive_title(); ?>
			</h1>
		</div>
		<?php if ( $desc = get_the_archive_description() ) : ?>
		<div style="font-size:1.125rem; color: var(--on-surface-variant); line-height:1.7;">
			<?php echo wp_kses_post( $desc ); ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php if ( have_posts() ) : ?>
<section class="eco-grid" style="padding-top: 2rem;">
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="eco-card" id="post-<?php the_ID(); ?>">
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
				<p class="eco-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<div class="eco-card__byline">
					<div class="eco-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></div>
					<div><strong><?php the_author(); ?></strong> · <?php echo esc_html( get_the_date() ); ?></div>
				</div>
			</a>
		</article>
	<?php endwhile; ?>
</section>

<?php ecolive_organic_pagination(); ?>

<?php else : ?>
<section class="eco-container" style="padding: 6rem 1.5rem; text-align:center;">
	<h2><?php esc_html_e( 'Nothing matches.', 'ecolive-organic' ); ?></h2>
	<p style="color: var(--on-surface-variant); margin-top: 1rem;"><?php esc_html_e( 'Try a different topic or come back soon.', 'ecolive-organic' ); ?></p>
	<?php get_search_form(); ?>
</section>
<?php endif; ?>

<?php get_footer(); ?>
