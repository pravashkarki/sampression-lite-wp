<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
if ( is_active_sidebar( 'bottom-widget-1' ) || is_active_sidebar( 'bottom-widget-2' ) || is_active_sidebar( 'bottom-widget-3' ) ) : ?>
	<div class="footer-widget">
		<div class="container">
			<aside class="sidebar clearfix">
				<?php dynamic_sidebar( 'bottom-widget-1' ); ?>
				<?php dynamic_sidebar( 'bottom-widget-2' ); ?>
				<?php dynamic_sidebar( 'bottom-widget-3' ); ?>
			</aside><!--#sidebar-->
		</div>
	</div><!-- .footer-widget -->
<?php
endif;
