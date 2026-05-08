<?php
/**
 * Site footer — Deep Forest panel with widget area.
 *
 * @package ecolive-organic
 */
?>
</main><!-- #site-content -->

<footer class="eco-site-footer">
	<div class="eco-site-footer__grid">
		<div>
			<a class="eco-site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</a>
			<p style="margin-top: 1.5rem; color: rgba(151, 250, 133, 0.8); font-size: 0.875rem; line-height: 1.6;">
				<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
			</p>
		</div>

		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<?php dynamic_sidebar( 'footer-1' ); ?>
		<?php else : ?>
			<div>
				<h4><?php esc_html_e( 'Insights', 'ecolive-organic' ); ?></h4>
				<?php
				wp_list_categories( array(
					'title_li' => '',
					'number'   => 5,
				) );
				?>
			</div>
			<div>
				<h4><?php esc_html_e( 'Browse', 'ecolive-organic' ); ?></h4>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'depth'          => 1,
					'fallback_cb'    => '__return_empty_string',
				) );
				?>
			</div>
			<div>
				<h4><?php esc_html_e( 'Newsletter', 'ecolive-organic' ); ?></h4>
				<p style="font-size: 0.875rem; color: rgba(151, 250, 133, 0.7); margin-bottom: 1rem;"><?php esc_html_e( 'A monthly note from the field.', 'ecolive-organic' ); ?></p>
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" style="display:flex;">
					<label class="eco-sr-only" for="eco-footer-email"><?php esc_html_e( 'Email address', 'ecolive-organic' ); ?></label>
					<input id="eco-footer-email" type="email" name="email" placeholder="<?php esc_attr_e( 'Email address', 'ecolive-organic' ); ?>" style="flex:1;border:0;background: var(--primary-container);color:var(--on-primary);padding:0.6rem 1rem;border-radius:9999px 0 0 9999px;" />
					<button type="submit" style="background:var(--secondary);color:var(--on-secondary);border:0;padding:0.6rem 1rem;border-radius:0 9999px 9999px 0;font-weight:700;">→</button>
				</form>
			</div>
		<?php endif; ?>
	</div>

	<div class="eco-site-footer__bottom">
		<span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'ecolive-organic' ); ?></span>
		<span><?php esc_html_e( 'Powered by Ecolive', 'ecolive-organic' ); ?></span>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
