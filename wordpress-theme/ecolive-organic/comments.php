<?php
/**
 * Comments template.
 *
 * @package ecolive-organic
 */

if ( post_password_required() ) { return; }
?>
<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2><?php
			$count = get_comments_number();
			printf(
				/* translators: %s: comment count */
				esc_html( _n( '%s reply', '%s replies', $count, 'ecolive-organic' ) ),
				esc_html( number_format_i18n( $count ) )
			);
		?></h2>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 48,
			) );
			?>
		</ol>
		<?php
		the_comments_pagination( array(
			'prev_text' => '&larr;',
			'next_text' => '&rarr;',
		) );
		?>
	<?php endif; ?>

	<?php
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		echo '<p style="color:var(--on-surface-variant); margin-top:2rem;">' . esc_html__( 'Comments are closed.', 'ecolive-organic' ) . '</p>';
	endif;

	comment_form( array(
		'title_reply_before' => '<h2>',
		'title_reply_after'  => '</h2>',
		'class_submit'       => 'submit',
		'comment_notes_before' => '',
	) );
	?>
</section>
