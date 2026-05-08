<?php
/**
 * 404 — Editorial empty state.
 *
 * @package ecolive-organic
 */
get_header(); ?>

<section class="eco-blog-hero" style="padding-bottom:4rem;">
	<div class="eco-blog-hero__inner">
		<div>
			<span class="eco-eyebrow"><?php esc_html_e( '404', 'ecolive-organic' ); ?></span>
			<h1><?php esc_html_e( 'This page', 'ecolive-organic' ); ?> <span class="eco-text-gradient"><?php esc_html_e( 'wandered off.', 'ecolive-organic' ); ?></span></h1>
		</div>
		<p style="font-size:1.125rem; line-height:1.7; color: var(--on-surface-variant);">
			<?php esc_html_e( "The link is broken, or the page has moved. Try a search, or head back to the latest writing.", 'ecolive-organic' ); ?>
		</p>
	</div>
</section>

<section class="eco-container" style="padding: 0 1.5rem 6rem; max-width: 720px;">
	<?php get_search_form(); ?>
	<div style="margin-top: 3rem; text-align:center;">
		<a class="eco-btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'ecolive-organic' ); ?></a>
	</div>
</section>

<?php get_footer(); ?>
