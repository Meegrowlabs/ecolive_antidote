<?php
/**
 * Search form — pill-shaped, ghost border, focus-state on the secondary green.
 *
 * @package ecolive-organic
 */
?>
<form role="search" method="get" class="eco-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:flex;gap:0.5rem;max-width:480px;margin-inline:auto;">
	<label class="eco-sr-only" for="eco-search-input"><?php esc_html_e( 'Search for:', 'ecolive-organic' ); ?></label>
	<input
		id="eco-search-input"
		type="search"
		class="eco-search-form__input"
		name="s"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		placeholder="<?php esc_attr_e( 'Search insights…', 'ecolive-organic' ); ?>"
		style="flex:1;padding:0.875rem 1.5rem;border-radius:9999px;background:var(--surface-container-low);border:1px solid rgba(192, 200, 195, 0.2);font-family:inherit;font-size:1rem;color:var(--on-surface);"
	/>
	<button type="submit" class="eco-btn-primary" style="padding:0.75rem 1.25rem;">
		<span class="material-symbols-outlined" aria-hidden="true">search</span>
	</button>
</form>
