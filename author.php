<?php
/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The template for displaying Author Archive pages.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.1
 */

get_header(); ?>

	<section id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>

			<?php
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			 *
			 * We reset this later so we can run the loop
			 * properly with a call to rewind_posts().
			 */
			the_post();
			?>

			<header class="page-header columns twelve">
				<h2 class="quick-note columns twelve">
					<?php esc_html_e( 'Author Archives: ', 'sampression-lite' );
					echo get_the_author(); ?>
				</h2>
			</header>
			<!-- .page-header -->

			<?php
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();
			?>

			<div id="post-listing" class="clearfix">
				<!-- Corner Stamp: It will always remaing to the right top of the page -->
				<section class="corner-stamp post columns three item">
					<header>
						<h3 class="widget-title">
                            <?php esc_html_e( 'Archives', 'sampression-lite' ); ?></h3>
					</header>
					<div class="entry">
						<ul class="categories archives">
							<?php
							// Getting Archive Lists.
							wp_get_archives( '' ); ?>
						</ul>
					</div>
					<header>
						<h3 class="widget-title"><?php esc_html_e( 'Categories', 'sampression-lite' ); ?></h3>
					</header>
					<div class="entry">
						<ul class="categories">
							<?php
							// Getting Categories Lists.
							wp_list_categories( 'title_li' ); ?>
						</ul>
					</div>
				</section>
				<!-- corner-stamp -->
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'loop', 'archive' );
				endwhile;
				?>
				<div class="three columns shuffle__sizer"></div>
			</div>
			<!-- #post-listing -->
			<?php sampression_content_nav( 'nav-below' ); ?>
		<?php else: ?>

			<article id="post-0" class="no-results not-found">
				<header class="entry-header">
					<h2 class="entry-title">
                        <?php esc_html_e( 'Nothing Found', 'sampression-lite' ); ?>
                    </h2>
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
	<!-- #content -->
<?php
get_footer();
