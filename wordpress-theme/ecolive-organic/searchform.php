<?php
/**
 * Search form — pill-shaped.
 *
 * @package ecolive-organic
 */
?>
<form role="search" method="get" class="flex gap-2 w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label class="screen-reader-text" for="eco-search-input"><?php esc_html_e( 'Search for:', 'ecolive-organic' ); ?></label>
  <input id="eco-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>"
    placeholder="<?php esc_attr_e( 'Search the blog…', 'ecolive-organic' ); ?>"
    class="flex-1 px-6 py-3.5 rounded-full bg-surface-container-low border border-outline-variant/30 focus:border-secondary focus:ring-0 text-on-surface" />
  <button type="submit" class="px-5 py-3.5 btn-primary-gradient text-on-primary rounded-full font-bold inline-flex items-center" aria-label="<?php esc_attr_e( 'Search', 'ecolive-organic' ); ?>">
    <span class="material-symbols-outlined">search</span>
  </button>
</form>
