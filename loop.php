<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The loop that displays posts.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
?>

<article id="post-<?php the_ID(); ?>"
		 class="post three columns item <?php echo sampression_cat_slug(); ?> <?php if ( is_sticky() && is_home() ) {
			 echo 'sticky corner-stamp';
		 } else {
			 echo 'three';
		 } ?>" data-category='["all", <?php $count = sampression_cat_count();
$i                                                 = 1;
foreach ( ( get_the_category() ) as $category ) {
	if ( $i < $count ) {
		$item = ', ';
	} else {
		$item = '';
	}
	echo "\"" . $category->slug . "\"" . $item;
	$i ++;
} ?>]'>

	<h3 class="post-title">
		<a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ); ?>"
		   rel="bookmark"><?php the_title(); ?>
		</a>
	</h3>

	<?php if ( has_post_thumbnail() ) {
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured-thumbnail' );
		?>
		<div class="featured-img" style="height: <?php echo $thumbnail[2] ?>px;">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
				<?php the_post_thumbnail( 'featured-thumbnail', '', true ); ?>
			</a>
		</div>
		<!-- .featured-img -->
	<?php } ?>
	<div class="entry clearfix">
		<?php the_excerpt(); ?>
		<?php wp_link_pages( array(
				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression-lite' ) . '</span>',
				'after'  => '</div>',
			)
		);
		?>
	</div>
	<!-- .entry -->

	<div class="meta clearfix">
		<?php
		printf( __( '<time class="col posted-on genericon-day" datetime="2011-09-28">%2$s</time> ', 'sampression-lite' ), 'meta-prep meta-prep-author',
			sprintf( '<a href="%4$s" title="%2$s" rel="bookmark">%3$s</a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				get_the_date( 'M d, Y' ),
				esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) )
			) );
		?>
		<?php if ( comments_open() && get_comments_number() > 0 ) : ?>
			<span class="col count-comment genericon-comment">
			<?php comments_popup_link( __( 'No comments yet', 'sampression-lite' ), __( '1 Comment', 'sampression-lite' ), __( '% Comments', 'sampression-lite' ) ); ?>
			</span>
		<?php endif; ?>
	</div>
	<div class="meta clearfix">
		<?php printf( '<div class="post-author genericon-user col"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></div>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'sampression-lite' ), get_the_author() ),
			get_the_author()
		); ?>
	</div>
	<?php if ( get_post_type() == 'post' ) { ?>
		<div class="meta">
			<div class="cats genericon-category"><?php printf( __( '<div class="overflow-hidden cat-listing">%s</div>', 'sampression-lite' ), get_the_category_list( ', ' ) ); ?></div>
		</div>

	<?php }
	if ( has_tag() ) { ?>
		<div class="meta">
			<div class="tags genericon-tag">
				<div class="overflow-hidden tag-listing"><?php the_tags( ' ', ', ', '<br />' ); ?></div>
			</div>
		</div>
	<?php } ?>

	<?php if ( is_user_logged_in() ) { ?>
		<div class="meta">
			<div class="edit genericon-edit"><?php edit_post_link( __( 'Edit this post', 'sampression-lite' ) ); ?> </div>
		</div>
	<?php } ?>

</article>
<!--.post-->
