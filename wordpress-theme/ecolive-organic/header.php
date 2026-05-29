<?php
/**
 * Site header — head (GTM + Tailwind + fonts) and glass nav.
 *
 * @package ecolive-organic
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_js( ECOLIVE_GTM_ID ); ?>');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdn.tailwindcss.com">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries,typography"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
  tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        colors: {
          "primary": "#045e80", "on-primary": "#ffffff",
          "primary-container": "#034d6b", "on-primary-container": "#ffffff",
          "primary-fixed": "#c9e8f5", "on-primary-fixed": "#04384d",
          "primary-fixed-dim": "#8fcfe6", "on-primary-fixed-variant": "#034d6b",
          "secondary": "#2f7a39", "on-secondary": "#ffffff",
          "secondary-container": "#d3efd6", "on-secondary-container": "#103a16",
          "secondary-fixed": "#b8e6bd", "on-secondary-fixed": "#103a16",
          "secondary-fixed-dim": "#8fd199", "on-secondary-fixed-variant": "#0c2e12",
          "tertiary": "#0077a8", "on-tertiary": "#ffffff",
          "tertiary-container": "#cdeaf7", "on-tertiary-container": "#023049",
          "tertiary-fixed": "#cdeaf7", "on-tertiary-fixed": "#023049",
          "tertiary-fixed-dim": "#a9d8ee", "on-tertiary-fixed-variant": "#034d6b",
          "surface": "#f4f9f8", "surface-bright": "#ffffff", "surface-dim": "#dde6e4",
          "surface-variant": "#e3edeb", "surface-tint": "#0077a8",
          "surface-container-lowest": "#ffffff", "surface-container-low": "#eef5f4",
          "surface-container": "#e8f1ef", "surface-container-high": "#e2ece9",
          "surface-container-highest": "#dce7e4",
          "on-surface": "#14212b", "on-surface-variant": "#5b6872",
          "background": "#f4f9f8", "on-background": "#14212b",
          "inverse-surface": "#25323a", "inverse-on-surface": "#eef5f4",
          "inverse-primary": "#8fcfe6", "outline": "#7a8a92", "outline-variant": "#c2d2d6",
          "error": "#ba1a1a", "on-error": "#ffffff", "error-container": "#ffdad6", "on-error-container": "#410002"
        },
        fontFamily: { "headline": ["Manrope", "sans-serif"], "body": ["Manrope", "sans-serif"], "label": ["Manrope", "sans-serif"] },
        borderRadius: { "DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px" }
      }
    }
  }
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-surface text-on-surface font-body overflow-x-hidden' ); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( ECOLIVE_GTM_ID ); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<a class="screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to content', 'ecolive-organic' ); ?></a>

<?php
$eco_blog_url = ecolive_blog_url();
$eco_on_blog  = ( is_home() && ! is_front_page() ) || is_singular( 'post' ) || is_archive() || is_search();
$eco_nav_link = 'text-on-surface-variant hover:text-primary transition-colors';
?>
<!-- TopAppBar -->
<nav class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl shadow-[0_10px_40px_rgba(24,28,27,0.04)]">
  <div class="flex justify-between items-center max-w-7xl mx-auto px-6 md:px-8 h-20">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2" aria-label="<?php bloginfo( 'name' ); ?> home">
      <?php if ( has_custom_logo() ) {
        the_custom_logo();
      } else { ?>
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/ecolive-logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-8">
      <?php } ?>
    </a>
    <div class="hidden md:flex gap-7 items-center text-sm font-semibold tracking-tight">
      <a class="<?php echo esc_attr( $eco_nav_link ); ?>" href="<?php echo esc_url( home_url( '/#challenge' ) ); ?>">Challenge</a>
      <a class="<?php echo esc_attr( $eco_nav_link ); ?>" href="<?php echo esc_url( home_url( '/#solutions' ) ); ?>">Solutions</a>
      <a class="<?php echo esc_attr( $eco_nav_link ); ?>" href="<?php echo esc_url( home_url( '/#tools' ) ); ?>">Tools</a>
      <a class="<?php echo $eco_on_blog ? 'text-primary border-b-2 border-secondary pb-1' : esc_attr( $eco_nav_link ); ?>" href="<?php echo esc_url( $eco_blog_url ); ?>">Blogs</a>
      <a class="<?php echo esc_attr( $eco_nav_link ); ?>" href="<?php echo esc_url( home_url( '/#method' ) ); ?>">Method</a>
      <a class="<?php echo esc_attr( $eco_nav_link ); ?>" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a>
    </div>
    <button id="mobile-menu-btn" class="md:hidden p-2 text-primary" aria-label="Open menu">
      <span class="material-symbols-outlined text-3xl">menu</span>
    </button>
    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hidden md:inline-block px-6 py-2.5 btn-primary-gradient text-on-primary rounded-full font-bold transition-all active:scale-95 duration-200">Get Started</a>
  </div>
  <div id="mobile-menu" class="hidden md:hidden absolute top-20 left-0 w-full bg-surface/95 backdrop-blur-xl shadow-xl">
    <div class="flex flex-col px-8 py-6 gap-4 text-sm font-semibold">
      <a class="text-on-surface-variant hover:text-primary py-2" href="<?php echo esc_url( home_url( '/#challenge' ) ); ?>">Challenge</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="<?php echo esc_url( home_url( '/#solutions' ) ); ?>">Solutions</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="<?php echo esc_url( home_url( '/#tools' ) ); ?>">Tools</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="<?php echo esc_url( $eco_blog_url ); ?>">Blogs</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="<?php echo esc_url( home_url( '/#method' ) ); ?>">Method</a>
      <a class="text-on-surface-variant hover:text-primary py-2" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a>
      <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn-primary-gradient text-on-primary px-6 py-3 rounded-full font-bold text-center mt-2">Get Started</a>
    </div>
  </div>
</nav>

<?php if ( is_singular( 'post' ) ) : ?>
<div class="fixed top-20 left-0 w-full h-1 bg-surface-container-low z-40">
  <div id="reading-progress" class="h-full btn-primary-gradient transition-all duration-150" style="width:0%"></div>
</div>
<?php endif; ?>

<div id="site-content">
