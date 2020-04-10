<?php
/**
 * The template for displaying search forms
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
?>
<form method="get" class="search-form clearfix" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="hidden"><?php esc_html_e( 'Search for:', 'sampression-lite' ); ?></label>
	<input type="text" value="<?php the_search_query(); ?>" name="s" class="search-field text-field" placeholder="<?php esc_html_e( 'Search by Keyword', 'sampression-lite' ); ?>"/>
	<button type="submit" class="search-submit"><span
				class="screen-reader-text"><?php esc_html_x( 'Search', 'submit button', 'sampression-lite' ); ?></span>
	</button>
</form>
