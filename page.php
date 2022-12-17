<<<<<<< HEAD
<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */

get_header(); ?>

<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();
	?>
	<section id="content" class="columns nine" role="main">
		<article <?php post_class( 'post' ); ?> id="post-<?php the_ID(); ?>">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="featured-img">
					<?php the_post_thumbnail( 'featured' ); ?>
				</div>
				<!-- .featured-img -->
			<?php } ?>
			<header class="post-header">
				<h2 class="post-title">
					<?php the_title(); ?>
				</h2>

			</header>

			<div class="entry clearfix">
				<?php the_content(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression-lite' ) . '</span>',
						'after'  => '</div>',
					)
				);
				?>

				<?php if ( current_user_can( 'edit_post', get_the_ID() ) ) { ?>
					<div class="meta">
						<div class="edit genericon-edit"><?php edit_post_link( __( 'Edit', 'sampression-lite' ) ); ?> </div>
					</div>
				<?php } ?>
			</div>
			<?php comments_template( '', true ); ?>
		</article>

	</section>
	<!-- #content -->

<?php
	endwhile;
endif;
?>
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>
=======
<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */

get_header(); ?>

<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();
	?>
	<section id="content" class="columns nine" role="main">
		<article <?php post_class( 'post' ); ?> id="post-<?php the_ID(); ?>">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="featured-img">
					<?php the_post_thumbnail( 'featured' ); ?>
				</div>
				<!-- .featured-img -->
			<?php } ?>
			<header class="post-header">
				<h2 class="post-title">
					<?php the_title(); ?>
				</h2>

			</header>

			<div class="entry clearfix">
				<?php the_content(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression-lite' ) . '</span>',
						'after'  => '</div>',
					)
				);
				?>

				<?php if ( current_user_can( 'edit_post', get_the_ID() ) ) { ?>
					<div class="meta">
						<div class="edit genericon-edit"><?php edit_post_link( __( 'Edit', 'sampression-lite' ) ); ?> </div>
					</div>
				<?php } ?>
			</div>
			<?php comments_template( '', true ); ?>
		</article>

	</section>
	<!-- #content -->

<?php
	endwhile;
endif;
?>
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>
>>>>>>> 9d5791e6521e6c57602ccba0ab38f9f6fb037a5d
