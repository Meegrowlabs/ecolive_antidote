<?php
/**
 * Default index — blog listing (used when no posts page is set, and as the
 * fallback for archives).
 *
 * @package ecolive-organic
 */
get_header(); ?>

<section class="eco-blog-hero">
	<div class="eco-blog-hero__inner">
		<div>
			<span class="eco-eyebrow">
				<span class="material-symbols-outlined" aria-hidden="true" style="font-size:1rem;">menu_book</span>
				<?php esc_html_e( 'The Living Document', 'ecolive-organic' ); ?>
			</span>
			<h1>
				<?php esc_html_e( 'Field', 'ecolive-organic' ); ?>
				<span class="eco-text-gradient"><?php esc_html_e( 'notes', 'ecolive-organic' ); ?></span>
				<?php esc_html_e( 'from the regenerative economy.', 'ecolive-organic' ); ?>
			</h1>
		</div>
		<p style="font-size:1.125rem; line-height:1.7; color: var(--on-surface-variant);">
			<?php echo esc_html( get_bloginfo( 'description' ) ?: __( 'Long reads, technical breakdowns, and case studies from the teams working at the intersection of water, waste, energy, and human wellbeing.', 'ecolive-organic' ) ); ?>
		</p>
	</div>
</section>

<?php
$first_query = is_paged() ? false : new WP_Query( array(
	'posts_per_page' => 1,
	'ignore_sticky_posts' => 1,
) );

if ( $first_query && $first_query->have_posts() ) :
	$first_query->the_post();
?>
<section class="eco-featured">
	<a class="eco-featured__card" href="<?php the_permalink(); ?>">
		<div class="eco-featured__media">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'ecolive-featured', array( 'alt' => get_the_title() ) );
			} ?>
		</div>
		<div class="eco-featured__body">
			<div>
				<div class="eco-card__meta" style="margin-bottom:1.5rem;">
					<span class="eco-cat" style="padding: 0.4rem 0.75rem; background: rgba(151, 250, 133, 0.4); color: var(--primary); border-radius: 9999px; letter-spacing: 0.1em;"><?php esc_html_e( 'Featured', 'ecolive-organic' ); ?></span>
					<span><?php echo ecolive_organic_primary_category(); ?></span>
				</div>
				<h2 style="font-size: clamp(1.75rem, 3vw, 3rem); margin-bottom: 1.5rem;"><?php the_title(); ?></h2>
				<p style="color: var(--on-surface-variant); font-size: 1.125rem; line-height: 1.7;"><?php echo esc_html( get_the_excerpt() ); ?></p>
			</div>
			<div class="eco-card__byline">
				<div class="eco-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?></div>
				<div>
					<strong><?php the_author(); ?></strong> · <?php echo esc_html( ecolive_organic_reading_time() ); ?> · <?php echo esc_html( get_the_date() ); ?>
				</div>
			</div>
		</div>
	</a>
</section>
<?php
	wp_reset_postdata();
endif;
?>

<?php
$cats = get_categories( array( 'hide_empty' => true, 'number' => 7 ) );
if ( $cats ) : ?>
<nav class="eco-topics" aria-label="<?php esc_attr_e( 'Topics', 'ecolive-organic' ); ?>">
	<a class="eco-pill <?php echo ! is_category() ? 'is-active' : ''; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/blog' ) ); ?>"><?php esc_html_e( 'All', 'ecolive-organic' ); ?></a>
	<?php foreach ( $cats as $cat ) : ?>
		<a class="eco-pill <?php echo is_category( $cat->term_id ) ? 'is-active' : ''; ?>" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
			<?php echo esc_html( $cat->name ); ?>
		</a>
	<?php endforeach; ?>
</nav>
<?php endif; ?>

<?php
// Skip the first post in the grid only on page 1 (since it's the featured slot).
$paged   = max( 1, get_query_var( 'paged' ) );
$offset  = ( 1 === $paged ) ? 1 : 0;
$grid    = new WP_Query( array(
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged'          => $paged,
	'offset'         => ( 1 === $paged ) ? 1 : ( ( $paged - 1 ) * get_option( 'posts_per_page' ) ),
	'no_found_rows'  => false,
) );
?>

<?php if ( $grid->have_posts() ) : ?>
<section class="eco-grid">
	<?php while ( $grid->have_posts() ) : $grid->the_post(); ?>
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

<?php
// Render pagination using the custom-query result count.
echo '<nav class="eco-pagination" aria-label="' . esc_attr__( 'Posts', 'ecolive-organic' ) . '">';
echo paginate_links( array(
	'total'   => $grid->max_num_pages,
	'current' => $paged,
	'mid_size' => 1,
	'prev_text' => '&larr;',
	'next_text' => '&rarr;',
) );
echo '</nav>';

wp_reset_postdata();
?>

<?php else : ?>
<section class="eco-container" style="padding: 6rem 1.5rem; text-align:center;">
	<h2><?php esc_html_e( 'Nothing here yet.', 'ecolive-organic' ); ?></h2>
	<p style="color: var(--on-surface-variant); margin-top: 1rem;"><?php esc_html_e( 'The first long-form piece is on its way.', 'ecolive-organic' ); ?></p>
</section>
<?php endif; ?>

<section class="eco-newsletter">
	<div class="eco-newsletter__inner">
		<div>
			<h2 style="font-size: clamp(1.75rem, 3vw, 3rem); margin-bottom: 1rem;"><?php esc_html_e( 'A monthly note from the field.', 'ecolive-organic' ); ?></h2>
			<p style="color: rgba(151, 250, 133, 0.9); font-size: 1.05rem; line-height: 1.7;"><?php esc_html_e( "One long-form essay, one project update, one number that surprised us. No promotions. Unsubscribe in a click.", 'ecolive-organic' ); ?></p>
		</div>
		<form class="eco-newsletter__form" action="#" method="post" onsubmit="event.preventDefault();">
			<label class="eco-sr-only" for="eco-news-email"><?php esc_html_e( 'Your email', 'ecolive-organic' ); ?></label>
			<input id="eco-news-email" type="email" name="email" placeholder="you@company.com" required />
			<button type="submit"><?php esc_html_e( 'Subscribe', 'ecolive-organic' ); ?></button>
		</form>
	</div>
</section>

<?php get_footer(); ?>
