<?php
/**
 * The Sidebar containing the Right widget area.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
?>
<aside class="columns three sidebar sidebar-right">
	<?php
	// Showing Default Widgets until User put any widget in "Right Sidebar".
	if ( ! dynamic_sidebar( 'right-sidebar' ) ) :
		?>
		<section class="widget">
			<h3 class="widget-title">
				<?php esc_html_e( 'Most Popular', 'sampression-lite' ); ?></h3>
			<div class="widget-entry">
				<?php
				$args = array(
					'posts_per_page' => 5,
					'orderby'        => 'comment_count',
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) :
					?>
					<ul class="widget-popular-posts">
						<?php
						while ( $query->have_posts() ) : $query->the_post();
						?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php
				endif;
				wp_reset_postdata();
				?>
			</div>
		</section><!--.widget-->

		<section class="widget">
			<h3 class="widget-title">
				<?php esc_html_e( 'Categories', 'sampression-lite' ); ?>
			</h3>
			<div class="widget-entry">

				<ul class="widget-categories">
					<?php wp_list_categories( 'title_li' ); ?>
				</ul>
			</div>
		</section><!--.widget -->

		<section class="widget">
			<h3 class="widget-title">
				<?php esc_html_e( 'Archive', 'sampression-lite' ); ?>
			</h3>
			<div class="widget-entry">
				<ul class="widget-categories">
					<?php wp_get_archives(); ?>
				</ul>
			</div>
		</section><!--.widget -->

	<?php
	endif;
	// end of home-widget-1.
	?>
</aside>
<!--#sideba-->