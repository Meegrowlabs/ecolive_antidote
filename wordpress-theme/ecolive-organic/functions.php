<?php
/**
 * EcoLive WaterWise — theme bootstrap.
 *
 * Visual system is Tailwind (CDN) + the inline tailwind.config printed in
 * header.php; this file wires theme supports, menus, helpers and assets.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! defined( 'ECOLIVE_GTM_ID' ) ) {
	define( 'ECOLIVE_GTM_ID', 'GTM-58F3DZWZ' );
}

/* =========================================================
   Theme setup
   ========================================================= */
if ( ! function_exists( 'ecolive_organic_setup' ) ) :
function ecolive_organic_setup() {
	load_theme_textdomain( 'ecolive-organic', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ecolive-organic' ),
		'footer'  => __( 'Footer Menu',  'ecolive-organic' ),
	) );

	add_image_size( 'ecolive-card',     900,  675, true );
	add_image_size( 'ecolive-featured', 1600, 1000, true );
	add_image_size( 'ecolive-hero',     1920, 820,  true );
}
endif;
add_action( 'after_setup_theme', 'ecolive_organic_setup' );

/* =========================================================
   Assets — theme stylesheet + theme.js.
   Tailwind CDN, the inline config, Google Fonts and GTM are
   emitted directly in header.php to guarantee load order.
   ========================================================= */
function ecolive_organic_assets() {
	wp_enqueue_style(
		'ecolive-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_script(
		'ecolive-theme',
		get_template_directory_uri() . '/assets/theme.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ecolive_organic_assets' );

/* =========================================================
   Helpers
   ========================================================= */

/** URL of the blog/posts listing page, with a sensible fallback. */
function ecolive_blog_url() {
	$posts_page = (int) get_option( 'page_for_posts' );
	if ( $posts_page ) {
		return get_permalink( $posts_page );
	}
	return home_url( '/blog/' );
}

/** Permalink of a page by slug, falling back to /{slug}/. */
function ecolive_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . trim( $slug, '/' ) . '/' );
}

/** Reading-time estimate, rounded up. */
function ecolive_organic_reading_time( $post_id = null ) {
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( $content ) );
	$minutes = max( 1, (int) ceil( $words / 220 ) );
	/* translators: %d: minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'ecolive-organic' ), $minutes );
}

/** Primary (first) category name for card chips. */
function ecolive_organic_primary_category() {
	$cats = get_the_category();
	if ( empty( $cats ) ) { return ''; }
	return esc_html( $cats[0]->name );
}

/** Shorter editorial excerpts. */
function ecolive_organic_excerpt_length( $length ) { return 28; }
add_filter( 'excerpt_length', 'ecolive_organic_excerpt_length' );
function ecolive_organic_excerpt_more( $more ) { return ' …'; }
add_filter( 'excerpt_more', 'ecolive_organic_excerpt_more' );

/** Pagination rendered inside the pill UI. */
function ecolive_organic_pagination() {
	$links = paginate_links( array(
		'prev_text' => '&larr;',
		'next_text' => '&rarr;',
		'mid_size'  => 1,
	) );
	if ( ! $links ) { return; }
	echo '<nav class="eco-pagination" aria-label="' . esc_attr__( 'Posts navigation', 'ecolive-organic' ) . '">' . $links . '</nav>';
}

/**
 * Contact form output for the homepage.
 * Paste your Contact Form 7 shortcode into the ECOLIVE_CONTACT_FORM constant
 * (in wp-config.php or a small plugin) to swap the visual placeholder for a
 * working form, e.g. define('ECOLIVE_CONTACT_FORM', '[contact-form-7 id="123"]');
 */
function ecolive_contact_form() {
	if ( defined( 'ECOLIVE_CONTACT_FORM' ) && ECOLIVE_CONTACT_FORM ) {
		echo do_shortcode( ECOLIVE_CONTACT_FORM );
		return;
	}
	get_template_part( 'template-parts/contact-form' );
}
