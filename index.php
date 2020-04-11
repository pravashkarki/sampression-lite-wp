<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sampression-Lite
 */

get_header(); ?>

<section id="content" class="clearfix">

	<?php
	if ( have_posts() ) :
		?>
		<div id="post-listing" class="clearfix ">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'loop', 'index' );

			endwhile;
			?>
			<div class="three columns shuffle__sizer"></div>
		</div>
		<!-- #post-listing -->
		<?php
		sampression_content_nav( 'nav-below' );
	else :
	?>
		<article id="post-0" class="no-results not-found">
			<header class="entry-header">
				<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'sampression-lite' ); ?></h2>
			</header>
			<!-- .entry-header -->
			<div class="entry-content">
				<p><?php esc_html_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'sampression-lite' ); ?></p>
			</div>
			<!-- .entry-content -->
		</article>
		<!-- #post-0 -->
	<?php endif; ?>

</section>
<?php
get_footer();
