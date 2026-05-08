<?php
/**
 * Ecolive Organic Precision — theme bootstrap.
 *
 * Wires up theme supports, menus, and asset loading. The visual system
 * lives in style.css (Organic Precision design tokens).
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'ecolive_organic_setup' ) ) :
function ecolive_organic_setup() {
	load_theme_textdomain( 'ecolive-organic', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 32,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );

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

/**
 * Enqueue Manrope, Material Symbols, and the theme stylesheet.
 */
function ecolive_organic_assets() {
	wp_enqueue_style(
		'ecolive-fonts',
		'https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'ecolive-icons',
		'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'ecolive-organic',
		get_stylesheet_uri(),
		array( 'ecolive-fonts' ),
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_script(
		'ecolive-organic',
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

/**
 * Sidebars / widget areas.
 */
function ecolive_organic_widgets() {
	register_sidebar( array(
		'name'          => __( 'Footer Column', 'ecolive-organic' ),
		'id'            => 'footer-1',
		'before_widget' => '<section class="eco-footer-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'ecolive_organic_widgets' );

/**
 * Reading-time estimate, rounded up. Used in card meta and single-post header.
 */
function ecolive_organic_reading_time( $post_id = null ) {
	$content = get_post_field( 'post_content', $post_id );
	$words   = str_word_count( wp_strip_all_tags( $content ) );
	$minutes = max( 1, (int) ceil( $words / 220 ) );
	/* translators: %d: minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'ecolive-organic' ), $minutes );
}

/**
 * Get a primary category name for card chips, falling back to the first term.
 */
function ecolive_organic_primary_category() {
	$cats = get_the_category();
	if ( empty( $cats ) ) { return ''; }
	return esc_html( $cats[0]->name );
}

/**
 * Editorial excerpt — slightly shorter than core, with an em-dash continuation.
 */
function ecolive_organic_excerpt_length( $length ) { return 28; }
add_filter( 'excerpt_length', 'ecolive_organic_excerpt_length' );

function ecolive_organic_excerpt_more( $more ) { return ' …'; }
add_filter( 'excerpt_more', 'ecolive_organic_excerpt_more' );

/**
 * Adds an "is-active" class helper for nav links.
 */
function ecolive_organic_nav_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', (array) $classes, true ) ) {
		$classes[] = 'is-active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'ecolive_organic_nav_class', 10, 2 );

/**
 * Pagination — render WP's paginate_links inside our pill UI.
 */
function ecolive_organic_pagination() {
	$args = array(
		'prev_text' => '&larr;',
		'next_text' => '&rarr;',
		'mid_size'  => 1,
	);
	$links = paginate_links( $args );
	if ( ! $links ) { return; }
	echo '<nav class="eco-pagination" aria-label="' . esc_attr__( 'Posts', 'ecolive-organic' ) . '">' . $links . '</nav>';
}
