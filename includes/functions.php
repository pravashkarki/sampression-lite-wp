<?php
/**
 * Sampression Lite functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, sampression_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 650;
}

/*=======================================================================
 * Fire up the engines to start theme setup.
 *=======================================================================*/

add_action( 'after_setup_theme', 'sampression_setup' );

if ( ! function_exists( 'sampression_setup' ) ):

	function sampression_setup() {

		/**
		 * Sampression is now available for translations.
		 */
		load_theme_textdomain( 'sampression-lite', get_template_directory() . '/languages' );

		/**
		 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
		 * @see https://codex.wordpress.org/Function_Reference/add_editor_style
		 */
		add_editor_style( 'lib/css/editor-style.css' );

		/**
		 * This feature enables post and comment RSS feed links to head.
		 * @see https://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * This feature enables post-thumbnail support for a theme.
		 * @see https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		// Custom image sizes
		add_image_size( 'featured', 700, 400, true ); // Set the size of Featured Image
		add_image_size( 'featured-thumbnail', 220 ); // Set the size of Featured Image Thumbnail

		/**
		 * This feature enables custom background color and image support for a theme
		 */
		add_theme_support( 'custom-background', array(
			'default-color'    => 'F3F7F6',
			'default-image'    => '',
			'wp-head-callback' => 'sampression_custom_background_cb'
		) );

		/**
		 * This feature enables custom header color and image support for a theme
		 */
		add_theme_support( 'custom-header', array(
			// Text color and image (empty to use none).
			'default-text-color' => 'FE6E41',
			'default-image'      => '',

			// Set height and width, with a maximum value for the width.
			'height'             => 152,
			'width'              => 960,
			'max-width'          => 2000,

			// Support flexible height and width.
			'flex-height'        => true,
			'flex-width'         => true,
			'header-text'        => false
		) );

		/*
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 120,
			'width'       => 220,
			'flex-height' => true,
		) );

		/**
		 * This feature enables custom-menus support for a theme.
		 * @see https://codex.wordpress.org/Function_Reference/register_nav_menus
		 */
		register_nav_menus( array(
				'top-menu' => __( 'Top Menu', 'sampression-lite' )
			)
		);

	}

endif;

/**
 * Sampression theme background image css callback
 */
if ( ! function_exists( 'sampression_custom_background_cb' ) ):

	function sampression_custom_background_cb() {
		$background = get_background_image();
		$color      = get_background_color();

		if ( ! $background && ! $color ) {
			return;
		}

		$style = $color ? "background-color: #$color;" : '';

		if ( $background ) {
			$image = " background-image: url('$background');";

			$repeat = get_theme_mod( 'background_repeat', 'repeat' );

			if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) ) {
				$repeat = 'repeat';
			}

			$repeat = " background-repeat: $repeat;";

			$position = get_theme_mod( 'background_position_x', 'left' );

			if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) ) {
				$position = 'left';
			}

			$position = " background-position: top $position;";

			$attachment = get_theme_mod( 'background_attachment', 'scroll' );

			if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) ) {
				$attachment = 'scroll';
			}

			$attachment = " background-attachment: $attachment;";

			$cover = '';
			if ( get_theme_mod( 'sampression_background_cover' ) ) {
				$cover = ' background-size: cover;';
			}

			$style .= $image . $repeat . $position . $attachment . $cover;
		}
		?>
        <style type="text/css">
            #content-wrapper {
            <?php echo trim( $style ); ?>
            }
        </style>
		<?php
	}

endif;
/*=======================================================================
 * Shows footer credits
 *=======================================================================*/

if ( ! function_exists( 'sampression_footer' ) ) {
	function sampression_footer() {
		?>
        <div class="alignleft powered-wp">
			<?php
			if ( get_theme_mod( 'sampression_remove_copyright_text' ) != 1 ) {
				if ( get_theme_mod( 'sampression_copyright_text' ) ) {
					echo wp_kses_post( get_theme_mod( 'sampression_copyright_text' ) ) . ' ';
				} else {
					?>
                    <div class="alignleft copyright"><?php bloginfo( 'name' ); ?> &copy; <?php echo date( 'Y' ); ?>. All
                        Rights Reserved.
                    </div>
					<?php
					esc_html_e( 'Proudly powered by', 'sampression-lite' ); ?> <a
                            href="<?php echo esc_url( __( 'https://wordpress.org/', 'sampression-lite' ) ); ?>"
                            title="<?php esc_attr_e( 'WordPress', 'sampression-lite' ); ?>"
                            target="_blank"><?php esc_html_e( 'WordPress', 'sampression-lite' ); ?></a>
					<?php
				}
			}
			?>
        </div>
        <div class="alignright credit">
			<?php esc_html_e( 'A theme by', 'sampression-lite' ); ?> <a
                    href="<?php echo esc_url( __( 'https://www.sampression.com/', 'sampression-lite' ) ); ?>"
                    target="_blank"
                    title="<?php esc_attr_e( 'Sampression', 'sampression-lite' ); ?>"><?php esc_html_e( 'Sampression', 'sampression-lite' ); ?></a>
        </div>
		<?php
	}
}
add_filter( 'sampression_credits', 'sampression_footer' );

/*=======================================================================
 * A safe way of adding JavaScripts to a WordPress generated page.
 *=======================================================================*/

if ( ! function_exists( 'sampression_js' ) ) {

	function sampression_js() {
		// JS at the bottom for fast page loading.
		wp_enqueue_script( 'sampression-modernizer', get_template_directory_uri() . '/lib/js/modernizr.custom.min.js', '', '2.6.2', false );
		wp_enqueue_script( 'sampression-script', get_template_directory_uri() . '/lib/js/scripts.js', array( 'jquery' ), '1.1', true );
		wp_enqueue_script( 'jquery-script', get_template_directory_uri() . '/lib/js/jquery.3.3.1.js', '', '3.3.1', false );
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/lib/js/isotope.pkgd.min.js', '', '', false );
		wp_enqueue_script( 'isotope-init', get_template_directory_uri() . '/lib/js/isotope.js', '', '', false );

	}

}
add_action( 'wp_enqueue_scripts', 'sampression_js' );

/*=======================================================================
 * Comment Reply
 *=======================================================================*/
function sampression_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'sampression_enqueue_comment_reply' );

/*=======================================================================
 * Remove rel attribute from the category list
 *=======================================================================*/
function sampression_remove_category_list_rel( $output ) {
	$output = str_replace( ' rel="category"', '', $output );

	return $output;
}

add_filter( 'wp_list_categories', 'sampression_remove_category_list_rel' );
add_filter( 'the_category', 'sampression_remove_category_list_rel' );


/*=======================================================================
 * Display navigation to next/previous pages when applicable
 *=======================================================================*/

if ( ! function_exists( 'sampression_content_nav' ) ) :

	function sampression_content_nav( $nav_id ) {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
            <nav id="<?php echo $nav_id; ?>" class="post-navigation clearfix">
				<?php
				// Enable the Page Navigation features for wp-pagenavi plugin
				if ( function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi();
				} else {
					?>
                    <div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sampression-lite' ) ); ?></div>
                    <div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sampression-lite' ) ); ?></div>
					<?php
				}
				?>
            </nav>
		<?php endif;
	}
endif;

/**
 * wp_list_comments() Pings Callback
 *
 * wp_list_comments() Callback function for
 * Pings (Trackbacks/Pingbacks)
 */
function sampression_comment_list_pings( $comment ) {
	// $GLOBALS['comment'] = $comment;
	?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }


/*=======================================================================
 * Sets the post excerpt length to 40 characters.
 * Next few lines are adopted from Coraline
 *=======================================================================*/
if ( ! function_exists( 'sampression_excerpt_length' ) ):
	function sampression_excerpt_length( $length ) {
		return 40;
	}
endif;

add_filter( 'excerpt_length', 'sampression_excerpt_length' );

/**
 * Returns a "Read more" link for excerpts
 */
function sampression_read_more() {
	return ' <span class="read-more"><a href="' . get_permalink() . '">' . __( 'Read more &#8250;', 'sampression-lite' ) . '</a></span>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and sampression_read_more_link().
 */
if ( ! function_exists( 'sampression_auto_excerpt_more' ) ):
	function sampression_auto_excerpt_more( $more ) {
		return '<span class="ellipsis">&hellip;</span>' . sampression_read_more();
	}
endif;
add_filter( 'excerpt_more', 'sampression_auto_excerpt_more' );

/**
 * Adds a pretty "Read more" link to custom post excerpts.
 */
if ( ! function_exists( 'sampression_custom_excerpt_more' ) ):
	function sampression_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= sampression_read_more();
		}

		return $output;
	}
endif;
add_filter( 'get_the_excerpt', 'sampression_custom_excerpt_more' );

/*=======================================================================
 * Get Category Slugs
 *=======================================================================*/
if ( ! function_exists( 'sampression_cat_slug' ) ) {
	function sampression_cat_slug() {
		$cats = array();
		foreach ( ( get_the_category() ) as $category ) {
			$cats[] = $category->slug;
		}
		$slug = implode( ' ', $cats );

		return $slug;
	}
}

if ( ! function_exists( 'sampression_cat_slugs' ) ) {
	function sampression_cat_slugs() {
		$cats = array();
		foreach ( ( get_the_category() ) as $category ) {
			$cats[] = $category->slug;
		}
		$slug = implode( ', ', $cats );

		return $slug;
	}

}

if ( ! function_exists( 'sampression_cat_count' ) ) {
	function sampression_cat_count() {
		$cats  = array();
		$count = 0;
		foreach ( ( get_the_category() ) as $category ) {
			$count = $count + 1;
		}

		return $count;
	}

}

/*=======================================================================
 * Run function during a themes initialization. It clear all widgets
 *=======================================================================*/

function sampression_widget_reset() {
	if ( isset( $_GET['activated'] ) ) {
		add_filter( 'sidebars_widgets', 'disable_all_widgets' );
		function disable_all_widgets( $sidebars_widgets ) {
			$sidebars_widgets = array( false );

			return $sidebars_widgets;
		}
	}
}

add_action( 'setup_theme', 'sampression_widget_reset' );

/*=======================================================================
 * WordPress Widgets start right here.
 *=======================================================================*/
if ( ! function_exists( 'sampression_widgets_init' ) ) :
	function sampression_widgets_init() {

		register_sidebar( array(
			'name'          => __( 'Bottom Widget One', 'sampression-lite' ),
			'description'   => __( 'Appears on bottom of the Page - First Widget - Please insert only one widget for better appearance.', 'sampression-lite' ),
			'id'            => 'bottom-widget-1',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'before_widget' => '<section id="%1$s" class="column one-third widget %2$s">',
			'after_widget'  => '</section>'
		) );

		register_sidebar( array(
			'name'          => __( 'Bottom Widget Two', 'sampression-lite' ),
			'description'   => __( 'Appears on bottom of the Page - Second Widget - Please insert only one widget for better appearance.', 'sampression-lite' ),
			'id'            => 'bottom-widget-2',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'before_widget' => '<section id="%1$s" class="column one-third widget %2$s">',
			'after_widget'  => '</section>'
		) );

		register_sidebar( array(
			'name'          => __( 'Bottom Widget Three', 'sampression-lite' ),
			'description'   => __( 'Appears on bottom of the Page - Third Widget - Please insert only one widget for better appearance.', 'sampression-lite' ),
			'id'            => 'bottom-widget-3',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'before_widget' => '<section id="%1$s" class="column one-third widget %2$s">',
			'after_widget'  => '</section>'
		) );

		register_sidebar( array(
			'name'          => __( 'Inner Sidebar', 'sampression-lite' ),
			'description'   => __( 'Appears on right of the Interior Pages - Can use as much widgets as you wish.', 'sampression-lite' ),
			'id'            => 'right-sidebar',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget'  => '</section>'
		) );
	}
endif;
add_action( 'widgets_init', 'sampression_widgets_init' );

function sampression_default_widgets() {
	$sidebars_widgets = get_option( 'sidebars_widgets' );
	if ( ! get_option( 'samp_auto_widget_installed', false ) ) {

		if ( empty( $sidebars_widgets['bottom-widget-3'] ) ) {    //if there are no widgets on the 'bottom-widget-3'

			$id                                  = count( $sidebars_widgets ) + 1;
			$sidebars_widgets['bottom-widget-3'] = array( "text-" . $id );

			$ops        = get_option( 'widget_text' );
			$ops[ $id ] = array(
				'title' => 'About me automatic widget',
				'text'  => 'This is an automatic widget added on Third Bottom Widget box (Bottom Widget 3). To edit please go to Appearance > Widgets and choose 3rd widget from the top in area second called Bottom Widget 3. Title is also manageable from widgets as well.',
			);
			update_option( 'widget_text', $ops );
			update_option( 'sidebars_widgets', $sidebars_widgets );
		}
		update_option( 'samp_auto_widget_installed', true );

	}
}

add_action( 'widgets_init', 'sampression_default_widgets', 11 );

/*=======================================================================
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sampression_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *=======================================================================*/

if ( ! function_exists( 'sampression_comment' ) ) :

	function sampression_comment( $comment, $args, $depth ) {
		// $GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
                <li class="post pingback">
                <p><?php _e( 'Pingback:', 'sampression-lite' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'sampression-lite' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default :
				?>
                <li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment">
                    <div class="avatar-wrapper">
                        <span class="pointer"></span>
                        <div class="avatar">
							<?php // Get Avatar
							$avatar_size = 80;
							if ( '0' != $comment->comment_parent ) {
								$avatar_size = 80;
							}

							echo get_avatar( $comment, $avatar_size );
							?>
                        </div>
                        <!-- .avatar -->
                    </div>
                    <!-- .col-2 -->
                    <div class="comment-wrapper">
                        <div class="comment-entry">
                            <header class="comment-meta clearfix">
                                <div class="comment-author">
									<?php

									/* translators: 1: comment author, 2: date and time */
									printf( __( '%1$s on %2$s', 'sampression-lite' ),
										sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
										sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
											esc_url( get_comment_link( $comment->comment_ID ) ),
											get_comment_time( 'c' ),
											/* translators: 1: date, 2: time */
											sprintf( __( '<span class="date-details">%1$s</span>', 'sampression-lite' ), get_comment_date(), get_comment_time() )
										)
									);
									?>

									<?php edit_comment_link( __( 'Edit', 'sampression-lite' ), '<span class="edit-link">', '</span>' ); ?>
                                </div><!-- .comment-author  -->

                                <div class="reply">
									<?php comment_reply_link( array_merge( $args, array(
										'reply_text' => __( 'Reply <span>&darr;</span>', 'sampression-lite' ),
										'depth'      => $depth,
										'max_depth'  => $args['max_depth']
									) ) ); ?>
                                </div><!-- .reply -->


                            </header>

							<?php if ( $comment->comment_approved == '0' ) : ?>
                                <div class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'sampression-lite' ); ?></div>
							<?php endif; ?>


                            <div class="comment-content"><?php comment_text(); ?></div>
                        </div>
                    </div>
                    <!-- .col-2 -->


                </article><!-- #comment-## -->

				<?php
				break;
		endswitch;
	}
endif; // ends check for sampression_comment()

/*=======================================================================
 * Function to get default logo by Sampression theme
 *=======================================================================*/
add_action( 'sampression_logo', 'sampression_show_logo' );
function sampression_show_logo() {
	if ( function_exists( 'the_custom_logo' ) && get_custom_logo() ) {
		the_custom_logo();
	} elseif ( get_theme_mod( 'sampression_logo', get_option( 'opt_sam_logo' ) ) ) {
		$logo = get_theme_mod( 'sampression_logo', get_option( 'opt_sam_logo' ) )
		?>
        <a href="<?php echo home_url( '/' ); ?>"
           title="<?php echo esc_attr( ucwords( get_bloginfo( 'name', 'display' ) ) ); ?>" rel="home" id="logo-area">
            <img class="logo-img" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
		<?php
	}
	if ( get_theme_mod( 'sampression_remove_tagline' ) != 1 ) { ?>
        <h2 id="site-description" class="site-description"><?php bloginfo( 'description' ); ?></h2>
		<?php
	}
}


/*=======================================================================
* declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
*=======================================================================*/

add_action( 'wp_ajax_nopriv_filter-cat-data', 'sampression_filter_cat_callback' );
add_action( 'wp_ajax_filter-cat-data', 'sampression_filter_cat_callback' );

function sampression_filter_cat_callback() {
	$slug    = $_POST['category'];
	$exc     = $_POST['exclude'];
	$exclude = explode( '~', $exc );
	query_posts( array( 'category_name' => $slug, 'post__not_in' => $exclude, 'post_status' => 'publish' ) );
	while ( have_posts() ) : the_post();
		?>
        <article id="post-<?php the_ID(); ?>" class="post item columns four <?php echo sampression_cat_slug(); ?> ">
            <h3 class="post-title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ); ?>"
                                      rel="bookmark"><?php the_title(); ?></a></h3>

			<?php if ( has_post_thumbnail() ) { ?>
                <div class="featured-img">
                    <a href="<?php the_permalink(); ?>"
                       title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
                </div>
                <!-- .featured-img -->
			<?php } ?>

            <div class="entry">
				<?php the_excerpt(); ?>
            </div>
            <!-- .entry -->

            <div class="meta clearfix">
				<?php
				printf( __( '%3$s <time class="col" datetime="2011-09-28"><span class="ico">Published on</span>%2$s</time> ', 'sampression-lite' ), 'meta-prep meta-prep-author',
					sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
						get_permalink(),
						esc_attr( get_the_time() ),
						get_the_date( 'd M Y' )
					),
					sprintf( '<div class="post-author col"><span class="ico hello">Author</span><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></div>',
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						sprintf( esc_attr__( 'View all posts by %s', 'sampression-lite' ), get_the_author() ),
						get_the_author()
					)
				);
				?>

				<?php if ( comments_open() ) : ?>
                    <span class="col count-comment">
            <span class="pointer"></span>
						<?php comments_popup_link( __( '0', 'sampression-lite' ), __( '1', 'sampression-lite' ), __( '%', 'sampression-lite' ) ); ?>
            </span>
				<?php endif; ?>


            </div>
            <div class="meta">
                <div class="cats"><?php printf( __( '<span class="ico">Categories</span><div class="overflow-hidden cat-listing">%s</div>', 'sampression-lite' ), get_the_category_list( ', ' ) ); ?></div>
            </div>
        </article>
	<?php
	endwhile;
	wp_reset_query();
	die();
}

/**
 * Add meta tags.
 */
add_action( 'sampression_meta', 'sampression_add_meta' );

function sampression_add_meta() {
	?>
    <!-- Charset -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- Mobile Specific Metas  -->
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
	<?php
}

/**
 * Add google fonts, pingback url, etc.
 */
add_action( 'sampression_links', 'sampression_add_links' );

function sampression_add_links() {
	?>
    <!-- Pingback Url -->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
}

function sampression_create_font_url( $family ) {
	$family = explode( '=', $family );

	return $family[0];
}

function sampression_fonts_url() {
	$fonts_url = '';
	$fonts     = array();

	$fonts[] = sampression_create_font_url( get_theme_mod( 'title_font', 'Roboto+Slab:400,700=serif' ) );
	$fonts[] = sampression_create_font_url( get_theme_mod( 'body_font', 'Roboto:400,400italic,700,700italic=sans-serif' ) );

	$fonts = array_unique( $fonts );

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => implode( '|', $fonts )
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

if ( ! function_exists( 'sampression_enqueue_styles' ) ):
	function sampression_enqueue_styles() {
		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'sampression-fonts', sampression_fonts_url(), array(), null );
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', false, false, 'screen' );
		wp_enqueue_style( 'sampression-style', get_stylesheet_uri(), false, '1.4' );

		// Load selectivizr.js
		wp_enqueue_script( 'sampression-selectivizr', get_template_directory_uri() . '/lib/js/selectivizr.js', array(), '1.0.2', true );
		wp_script_add_data( 'sampression-selectivizr', 'conditional', 'lt IE 9' );

	}
endif;
add_action( 'wp_enqueue_scripts', 'sampression_enqueue_styles' );

function sampression_custom_header_style() {
	?>

    <style type="text/css">
        <?php
        if ( $text_color = get_theme_mod('title_textcolor') ) {
        ?>
        #site-title a, article.post .post-title a, body.single article.post .post-title, body.page article.post .post-title, h1, h2, h3, h4, h5, h6 {
            color: <?php echo esc_attr( $text_color ); ?>;
        }

        #site-title a:hover,
        article.post .post-title a:hover,
        .meta a:hover,
        #top-nav ul a:link,
        .overflow-hidden.cat-listing > a:hover, .url.fn.n:hover, .col > a:hover {
            color: <?php echo esc_attr(get_theme_mod('body_textcolor') ) ?>;
        }

        <?php
        }
        if(get_theme_mod('title_font')) {
            $title_font = get_theme_mod('title_font');
            $title_family = sampression_font_family($title_font);
            ?>
        #site-title a, article.post .post-title a, body.single article.post .post-title, body.page article.post .post-title, h1, h2, h3, h4, h5, h6 {
            font-family: <?php echo $title_family ?>;
        }

        <?php
	}
	if(get_theme_mod('body_font')) {
		$body_font = get_theme_mod('body_font');
		$body_family = sampression_font_family($body_font);
		?>
        p, #site-description {
            font-family: <?php echo $body_family ?>;
        }

        <?php
	}

	if(get_theme_mod('body_textcolor')) {
	?>
        body, #site-description {
            color: <?php echo esc_attr( get_theme_mod('body_textcolor') ); ?>;
        }

        <?php
        }
        if(get_theme_mod('link_color')) {
        ?>
        a:link, a:visited,
        .meta, .meta a,
        #top-nav ul a:link, #top-nav ul a:visited,
        #primary-nav ul.nav-listing li a {
            color: <?php echo esc_attr( get_theme_mod('link_color') ); ?>;
        }

        .button, button, input[type="submit"],
        input[type="reset"], input[type="button"] {
            background-color: <?php echo esc_attr( get_theme_mod('link_color') ); ?>;
        }

        .button:hover, button:hover, input[type="submit"]:hover,
        input[type="reset"]:hover, input[type="button"]:hover {
            background-color: <?php echo esc_attr( get_theme_mod('body_textcolor') ); ?>;
        }

        #primary-nav ul.nav-listing li a span {
            background-color: <?php echo esc_attr( get_theme_mod('link_color') ); ?>;
        }

        a:hover {
            color: <?php echo esc_attr( get_theme_mod('body_textcolor') ); ?>;
        }

        #top-nav ul li li a,
        #top-nav ul li.current-menu-item li a,
        #top-nav ul li.current-menu-parent li a,
        #top-nav ul li.current-menu-ancestor li a,
        #top-nav ul li li.current-menu-item li a,
        #top-nav ul li li.current-menu-parent li a,
        #top-nav ul li li.current-menu-parent li.current-menu-item a,
        #top-nav .sub-menu li a,
        #top-nav .sub-menu .sub-menu li a,
        #top-nav .sub-menu li:last-child > .sub-menu li a,
        #top-nav .sub-menu li:last-child > .sub-menu li:last-child > .sub-menu li a,
        #top-nav .sub-menu li:last-child > .sub-menu li:last-child > .sub-menu li:last-child > .sub-menu li a {
            color: <?php echo esc_attr( get_theme_mod('link_color') ); ?>;
        }

        <?php
        }
        ?>
    </style>
	<?php
}

add_action( 'sampression_custom_header_style', 'sampression_custom_header_style' );

function sampression_font_family( $family ) {
	if ( strpos( $family, ':' ) === false ) {
		$font_ = explode( '=', $family );
		$font  = str_replace( '+', ' ', $font_[0] );
		$style = $font_[1];
	} else {
		$font_  = explode( ':', $family );
		$font   = str_replace( '+', ' ', $font_[0] );
		$style_ = explode( '=', $font_[1] );
		$style  = $style_[1];
	}

	return '"' . $font . '", ' . $style;
}


/**
 * Recommended plugins
 */
function sampression_register_required_plugins() {

	$plugins = array(

		array(
			'name' => esc_html__( 'Contact Form 7', 'sampression-lite' ),
			'slug' => 'contact-form-7',
		),

		array(
			'name' => esc_html__( 'One click demo import', 'sampression-lite' ),
			'slug' => 'one-click-demo-import',
		),
	);
	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'sampression_register_required_plugins' );

function hide_edit_icon(){

	if ( is_customize_preview() ) {
		?>
        <script>
            jQuery('.genericon-edit').parent().hide();
        </script>
	<?php }
}
add_action('wp_footer','hide_edit_icon');

/**
 * Demo class
 */
require_once trailingslashit( get_template_directory() ) . '/demo/class-sampression-demo-import.php';

/**
 * Demo configuration.
 */
require_once trailingslashit( get_template_directory() ) . '/demo/demo.php';

/**
 * Customizer Theme Info
 */
require_once trailingslashit( get_template_directory() ) . '/includes/customizer-theme-info.php';


if ( ! function_exists( 'sampression_admin_enqueue_styles' ) ):
	function sampression_admin_enqueue_styles() {
		// Add custom styles for customizer.
		wp_enqueue_style( 'sampression-customizer-style', get_template_directory_uri() . '/lib/css/admin-style.css', array(), null);
	}
endif;
add_action( 'admin_enqueue_scripts', 'sampression_admin_enqueue_styles' );


