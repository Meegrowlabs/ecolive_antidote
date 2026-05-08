<?php
/**
 * Site header — glass nav + reading-progress bar (single posts only).
 *
 * @package ecolive-organic
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<a class="eco-sr-only" href="#site-content"><?php esc_html_e( 'Skip to content', 'ecolive-organic' ); ?></a>

<header class="eco-site-header">
	<div class="eco-site-header__inner">
		<a class="eco-site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?>">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				echo esc_html( get_bloginfo( 'name' ) );
			}
			?>
		</a>

		<nav class="eco-nav" aria-label="<?php esc_attr_e( 'Primary', 'ecolive-organic' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'depth'          => 1,
				'fallback_cb'    => function() {
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'ecolive-organic' ) . '</a>';
					echo '<a href="' . esc_url( home_url( '/blog' ) ) . '" class="is-active">' . esc_html__( 'Insights', 'ecolive-organic' ) . '</a>';
				},
			) );
			?>
		</nav>

		<button class="eco-mobile-toggle" aria-expanded="false" aria-controls="eco-mobile-menu" id="eco-mobile-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'ecolive-organic' ); ?>">
			<span class="material-symbols-outlined" aria-hidden="true">menu</span>
		</button>
	</div>

	<div class="eco-mobile-menu" id="eco-mobile-menu">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s',
			'depth'          => 1,
			'fallback_cb'    => '__return_empty_string',
		) );
		?>
	</div>
</header>

<?php if ( is_singular( 'post' ) ) : ?>
<div class="eco-progress" aria-hidden="true"><div class="eco-progress__bar" id="eco-progress-bar"></div></div>
<?php endif; ?>

<main id="site-content" class="eco-site-main">
