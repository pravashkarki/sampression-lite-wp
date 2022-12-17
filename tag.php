<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.1.1
 */
get_header(); ?>

	<section id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>

			<header class="page-header columns twelve">
				<h2 class="page-title quick-note">
					<?php printf( __( 'Tag Archives: %s', 'sampression-lite' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
				</h2>

				<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) ) {
					echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
				}
				?>
			</header>
			<!-- .page-header -->

			<div id="post-listing" class="clearfix">
				<!-- Corner Stamp: It will always remaing to the right top of the page -->
				<section class="corner-stamp post columns four item">
					<header><h3><?php esc_html_e( 'Categories', 'sampression-lite' ); ?></h3></header>
					<div class="entry">
						<ul class="categories">
							<?php wp_list_categories( 'title_li' ); ?>
						</ul>
					</div>

					<header><h3><?php esc_html_e( 'Archive', 'sampression-lite' ); ?></h3></header>
					<div class="entry">
						<ul class="categories archives">
							<?php wp_get_archives( '' ); ?>
						</ul>
					</div>
				</section>
				<!-- .corner-stamp -->

				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'loop', 'category' );
				endwhile;
				?>

			</div>
			<!-- #post-listing -->
			<?php
			// Getting Pagination
			sampression_content_nav( 'nav-below' );
			?>
		<?php else: ?>
			<article id="post-0" class="no-results not-found">
				<header class="entry-header">
					<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'sampression-lite' ); ?></h2>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php esc_html_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'sampression-lite' ); ?></p>
				</div><!-- .entry-content -->
			</article><!-- .no-results -->
		<?php endif; ?>

	</section>
	<!-- #content -->
<?php
// Getting Bottom Sidebar.
get_sidebar(); ?>

<?php
get_footer();
