<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything until Primary Navigation
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
?>
<!doctype html>
<!--[if IE 6 ]>
<html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>
<html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>
<html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>
<html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
<?php
/**
 * Sampression hooks
 */

// Metas.
do_action( 'sampression_meta' );

// Links.
do_action( 'sampression_links' );

wp_head();
// Custom header styles.
do_action( 'sampression_custom_header_style' );
?>
</head>

<body <?php body_class( 'top' ); ?>>
<header id="header">
	<div class="container">
		<div class="columns five">
			<?php
			if( ( get_theme_mod( 'custom_logo' ) != '' && get_theme_mod('sampression_remove_logo' ) != 1 ) || ( get_theme_mod('sampression_logo', get_option('opt_sam_logo')) != '' && get_theme_mod('sampression_remove_logo') != 1) ) {
				do_action( 'sampression_logo' );
			} else {
				?>
				<div class="logo-txt">
					<h1 class="site-title" id="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php echo bloginfo( 'name' ); ?>
						</a>
					</h1>
					<?php if ( 1 !== get_theme_mod( 'sampression_remove_tagline' ) ) { ?>
						<h2 id="site-description" class="site-description"><?php bloginfo( 'description' ); ?>
						</h2>
					<?php } ?>
				</div>
				<?php
			}
			?>
		</div>
		<div class="columns seven">
			<nav id="top-nav">
				<?php
				// Check if the Custom Navigation is available.
				if ( has_nav_menu( 'top-menu' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'top-menu',
						'container'      => '',
						'menu_class'     => 'top-menu clearfix',
						'depth'          => 0, // set to 1 to disable dropdowns.
						'fallback_cb'    => false,
					) );
				} else {
					// Otherwise list the Pages.
					?>
					<ul class="top-menu clearfix">
						<?php wp_list_pages( 'title_li=&depth=0' ); ?>
					</ul>
					<?php
				}
				?>
			</nav><!-- #top-nav-->
			<div id="top-nav-mobile">
			</div>
			<!-- #top-nav-mobile-->
			<div id="interaction-sec" class="clearfix">
				<ul class="sm-top">
					<?php
					// Being Social.
					// Facebook.
					$fb_icon = '';
					if ( get_option( 'opt_get_facebook' ) ) {
						$fb_icon = get_option( 'opt_get_facebook' );
					}

					if ( get_theme_mod( 'sampression_socials_facebook', $fb_icon ) ) {
						?>
						<li class="sm-top-fb">
							<a class="genericon-facebook-alt" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_facebook', $fb_icon ) ); ?>" target="_blank">
							</a>
						</li>
					<?php
					}
					// Twitter.
					$tw_icon = '';
					if ( get_option( 'opt_get_twitter' ) ) {
						$tw_icon = get_option( 'opt_get_twitter' );
					}

					if ( get_theme_mod( 'sampression_socials_twitter', $tw_icon ) ) {
						?>
						<li class="sm-top-tw">
							<a class="genericon-twitter" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_twitter', $tw_icon ) ); ?>" target="_blank">
							</a>
						</li>
					<?php
					}
					// Google plus.
					$gp_icon = '';
					if ( get_option( 'opt_get_gplus' ) ) {
						$gp_icon = get_option( 'opt_get_gplus' );
					}

					if ( get_theme_mod( 'sampression_socials_googleplus', $gp_icon ) ) {
						?>
						<li class="sm-top-gplus">
							<a class="genericon-googleplus" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_googleplus', $gp_icon ) ); ?>" target="_blank">
							</a>
						</li>
					<?php
					}
					// Youtube.
					$yt_icon = '';
					if ( get_option( 'opt_get_youtube' ) ) {
						$yt_icon = get_option( 'opt_get_youtube' );
					}

					if ( get_theme_mod( 'sampression_socials_youtube', $yt_icon ) ) {
						?>
						<li class="sm-top-youtube">
							<a class="genericon-youtube" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_youtube', $yt_icon ) ); ?>" target="_blank">
							</a>
						</li>
					<?php
					}
					// Tumblr.
					if ( get_theme_mod( 'sampression_socials_tumblr' ) ) {
						?>
						<li class="sm-top-tumblr">
							<a class="genericon-tumblr" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_tumblr' ) ); ?>" target="_blank">
							</a>
						</li>
						<?php
					}
					// Pinterest.
					if ( get_theme_mod( 'sampression_socials_pinterest' ) ) {
						?>
						<li class="sm-top-pinterest">
							<a class="genericon-pinterest" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_pinterest' ) ); ?>" target="_blank">
							</a>
						</li>
						<?php
					}
					// Linkedin.
					if ( get_theme_mod( 'sampression_socials_linkedin' ) ) {
						?>
						<li class="sm-top-linkedin">
							<a class="genericon-linkedin" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_linkedin' ) ); ?>" target="_blank">
							</a>
						</li>
						<?php
					}
					// Github.
					if ( get_theme_mod( 'sampression_socials_github' ) ) {
						?>
						<li class="sm-top-github">
							<a class="genericon-github" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_github' ) ); ?>" target="_blank">
							</a>
						</li>
						<?php
					}
					// Instagram.
					if ( get_theme_mod( 'sampression_socials_instagram' ) ) {
						?>
						<li class="sm-top-instagram">
							<a class="genericon-instagram" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_instagram' ) ); ?>" target="_blank">
							</a>
						</li>
						<?php
					}
					// Flickr.
					if ( get_theme_mod( 'sampression_socials_flickr' ) ) {
						?>
						<li class="sm-top-flickr">
							<a class="genericon-flickr" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_flickr' ) ); ?>" target="_blank">
							</a>
						</li>
						<?php
					}
					// Vimeo.
					if ( get_theme_mod( 'sampression_socials_vimeo' ) ) {
						?>
						<li class="sm-top-vimeo">
							<a class="genericon-vimeo" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_vimeo' ) ); ?>" target="_blank">
							</a>
						</li>
						<?php
					}
					?>
				</ul>
				<!-- .sm-top -->
				<?php
				if ( '1' !== get_theme_mod( 'sampression_remove_search' ) ) {
					get_search_form();
				}
				?>
			</div>
			<!-- #interaction-sec -->
		</div>
		<?php
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) :
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt=""/>
			</a>
		<?php endif; ?>
	</div>
</header>
<!-- #header -->
<?php
if ( is_home() ) :
	?>
	<span id="primary-nav-scroll"></span>
	<nav id="primary-nav">
		<div class="container">
			<a href="#" id="btn-nav-opt">
				<i class="genericon-collapse"></i>
				<i class="genericon-expand"></i>
			</a>
			<div class="columns twelve">
				<div class="nav-label"><?php esc_html_e( 'Filter By:', 'sampression-lite' ); ?></div>

				<ul class="nav-listing clearfix" id="filter">
					<li>
						<a href="#" class="active selected" data-filter="*" data-group="all">
							<span>
							</span>
							<?php echo esc_html__( 'Show All', 'sampression-lite' ); ?>
						</a>
					</li>
					<?php
					/*to exclude some categories */
					$args       = array( 'hide_empty' => 1 );
					$categories = get_categories( $args );
					foreach ( $categories as $category ) :
						?>
						<li>
							<a href="#" data-filter=".<?php echo esc_attr( $category->slug ); ?>" data-group="<?php echo esc_attr( $category->slug ); ?>" id="<?php echo esc_attr( $category->slug ); ?>">
								<span></span>
								<?php echo esc_html( $category->name ); ?>
							</a>
						</li>
					<?php
					endforeach;
					?>
				</ul>

				<!-- Check Viewport: If the normal design couldn't fit with viewport, the Categories will appear via CSS with Select Menu form -->

				<?php
				$iPod   = stripos( $_SERVER['HTTP_USER_AGENT'], "iPod" );
				$iPhone = stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" );
				$iPad   = stripos( $_SERVER['HTTP_USER_AGENT'], "iPad" );
				if ( $iPod || $iPhone || $iPad ) {
					?>

					<select id="get-cat-ios">
						<option value="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Show All', 'sampression-lite' ); ?></option>
						<?php
						foreach ( $categories as $category ) :
							?>
							<option value=".<?php echo esc_attr( get_term_link( $category->slug, 'category' ) ); ?>"><?php echo esc_html( $category->name, 'sampression-lite' ); ?></option>
						<?php
						endforeach;
						?>
					</select>
					<?php
				} else {

					?>
					<select name="get-cats" id="get-cats">
						<option value="all">Show all</option>
						<?php
						foreach ( $categories as $category ) :
							?>
							<option value=".<?php echo esc_attr( $category->slug ); ?>">
								<?php echo esc_html( $category->name ); ?>
							</option>
						<?php
						endforeach;
						?>
					</select>
				<?php } ?>
			</div>
		</div>
	</nav>
	<!-- #primary-nav -->
<?php endif; ?>
<div id="content-wrapper">
	<div class="container">