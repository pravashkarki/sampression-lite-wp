<?php
/**
 *  Exit if accessed directly.
 *
 *  @package sampression-lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
get_header(); ?>
	<section id="content" class="clearfix">
		<div class="columns twelve offset-by-two">
			<div id="page-not-found-message">
				<h2><?php esc_html_e( 'Oops! Page not found.', 'sampression-lite' ); ?></h2>
				<h3 class="separator"><?php esc_html_e( 'Sorry but the page you looking for cannot be found.', 'sampression-lite' ); ?></h3>
				<h3><?php esc_html_e( 'Better to go', 'sampression-lite' ); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'home', 'sampression-lite' ); ?></a>
				</h3>
			</div>
			<!-- #page-not-found-message  -->
		</div>
	</section>
	<!-- #content -->

<?php
get_footer();
