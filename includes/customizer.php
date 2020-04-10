<?php
/**
 * Sampression Theme Customizer
 *
 * @package sampresion-lite
 * @since version 2.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sampression_customize_register( $wp_customize ) {

	class Sampression_Theme_Support extends WP_Customize_Control {

		protected function render_content() {
			switch ( $this->type ) {
				case 'textarea':
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
						<textarea rows="20" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
					</label>
					<?php
					break;
				case 'description' :
					echo '<p class="description">' . $this->description . '</p>';
					break;
			}
		}
	}


	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	/**
	 * Default Sections
	 * ------------------------------------
	 * title_tagline - Site Title & Tagline
	 * colors - Colors
	 * header_image - Header Image
	 * background_image - Background Image
	 * nav - Navigation
	 * static_front_page - Static Front Page
	 */
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );

	/*********************************************************************
	 * General Setting - Panel
	 *********************************************************************/

	$wp_customize->add_panel( 'sampression_general_setting_panel', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html( 'General Settings', 'sampression-lite' ),
		'description'    => esc_html( "You can customize general settings of your site like the site's name, tagline, logo, site icon, copyright text, background image, colour, choice of font face and color here.", 'sampression-lite' ),
	) );

	/**
	 * Site Title, Tagline, Site Icon - Section
	 */
	$wp_customize->add_section(
		'title_tagline',
		array(
			'title'    => __( 'Site Identity', 'sampression-lite' ),
			'priority' => 1,
			'panel'    => 'sampression_general_setting_panel',
		)
	);

	if ( ! function_exists( 'the_custom_logo' ) ) {

		$wp_customize->add_setting(
			'sampression_logo',
			array(
				'sanitize_callback' => 'esc_url_raw',
				'default'           => get_option( 'opt_sam_logo' ),
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'sam_theme_logo',
				array(
					'label'       => __( 'Logo', 'sampression-lite' ),
					'section'     => 'title_tagline',
					'settings'    => 'sampression_logo',
					'priority'    => 60,
					'description' => __( 'We recommend logo sizes within 220px x 120px.', 'sampression-lite' ),
				)
			)
		);

	}

	/**
	 * Remove Logo - Setting
	 */
	$wp_customize->add_setting( 'sampression_remove_logo', array( 'sanitize_callback' => 'sampression_sanitize_text' ) );
	$wp_customize->add_control(
		'sampression_remove_logo',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Remove Logo?', 'sampression-lite' ),
			'section'  => 'title_tagline',
			'priority' => 61,
		)
	);

	/**
	 * Remove Tagline - Setting
	 */
	$wp_customize->add_setting( 'sampression_remove_tagline', array( 'sanitize_callback' => 'sampression_sanitize_text' ) );
	$wp_customize->add_control(
		'sampression_remove_tagline',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Remove Tagline?', 'sampression-lite' ),
			'section'  => 'title_tagline',
			'priority' => 62,
		)
	);

	/*
	 * Copyright text Setting
	 */
	$wp_customize->add_setting( 'sampression_copyright_text', array( 'sanitize_callback' => 'sampression_sanitize_text' ) );
	$wp_customize->add_control(
		'sampression_copyright_text',
		array(
			'label'    => __( 'Copyright Text', 'sampression-lite' ),
			'section'  => 'title_tagline',
			'priority' => 63,
			'type'     => 'textarea',
		)
	);

	/*
	 * Remove Copyright Text Setting
	 */
	$wp_customize->add_setting( 'sampression_remove_copyright_text', array( 'sanitize_callback' => 'sampression_sanitize_text' ) );
	$wp_customize->add_control(
		'sampression_remove_copyright_text',
		array(
			'label'    => __( 'Remove Copyright Text?', 'sampression-lite' ),
			'section'  => 'title_tagline',
			'priority' => 64,
			'type'     => 'checkbox',
		)
	);

	/**
	 * Background - Section
	 */
	$wp_customize->add_section( 'background_image',
		array(
			'title'    => __( 'Background Image', 'sampression-lite' ),
			'priority' => 2,
			'panel'    => 'sampression_general_setting_panel',
		)
	);

	/**
	 * Background Image Cover
	 */
	$wp_customize->add_setting( 'sampression_background_cover',
		array(
			'sanitize_callback' => 'sampression_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'sampression_background_cover',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Use Background as Cover', 'sampression-lite' ),
			'section'  => 'background_image',
			'settings' => 'sampression_background_cover',
			'priority' => 10,
		)
	);

	$google_fonts = array(
		'Roboto+Slab:400,700=serif'                              => 'Roboto Slab - Default Header',
		'Roboto:400,400italic,700,700italic=sans-serif'          => 'Roboto - Default Body',
		'Playfair+Display:400,700,400italic,700italic=serif'     => 'Playfair Display',
		'Work+Sans:400,700=sans-serif'                           => 'Work Sans',
		'Alegreya:400,400italic,700,700italic=serif'             => 'Alegreya',
		'Alegreya+Sans:400,400italic,700,700italic=sans-serif'   => 'Alegreya Sans',
		'Fira+Sans:400,400italic,700,700italic=sans-serif'       => 'Fira Sans',
		'Droid+Sans:400,700=sans-serif'                          => 'Droid Sans',
		'Source+Sans+Pro:400,400italic,700,700italic=sans-serif' => 'Source Sans Pro',
		'Source+Serif+Pro:400,700=serif'                         => 'Source Serif Pro',
		'Lora:400,700=serif'                                     => 'Lora',
		'Neuton:400,700=serif'                                   => 'Neuton',
		'Poppins:400,700=sans-serif'                             => 'Poppins',
		'Karla:400,700=sans-serif'                               => 'Karla',
		'Merriweather:400,400italic,700,700italic=serif'         => 'Merriweather',
		'Open+Sans:400,400italic,700,700italic=sans-serif'       => 'Open Sans',
		'Lato:400,400italic,700,700italic=sans-serif'            => 'Lato',
		'Droid+Serif:400,400italic,700,700italic=serif'          => 'Droid Serif',
		'Archivo+Narrow:400,400italic,700,700italic=sans-serif'  => 'Archivo Narrow',
		'Libre+Baskerville:400,700,400italic=serif'              => 'Libre Baskerville',
		'Crimson+Text:400,400italic,700,700italic=serif'         => 'Crimson Text',
		'Montserrat:400,700=sans-serif'                          => 'Montserrat',
		'Chivo:400,400italic=sans-serif'                         => 'Chivo',
		'Old+Standard+TT:400,400italic,700=serif'                => 'Old Standard TT',
		'Domine:400,700=serif'                                   => 'Domine',
		'Varela+Round=sans-serif'                                => 'Varela Round',
		'Bitter:400,700=serif'                                   => 'Bitter',
		'Cardo:400,700,400italic=serif'                          => 'Cardo',
		'Arvo:400,400italic,700,700italic=serif'                 => 'Arvo',
		'PT+Serif:400,400italic,700,700italic=serif'             => 'PT Serif',
	);
	/**
	 * Typography - Section
	 */
	$wp_customize->add_section(
		'sampression_typography_section',
		array(
			'title'    => __( 'Typography', 'sampression-lite' ),
			'priority' => 11,
			'panel'    => 'sampression_general_setting_panel',
		)
	);

	/**
	 * Header Text Font - Setting
	 */
	$wp_customize->add_setting(
		'title_font',
		array(
			'sanitize_callback' => 'sampression_sanitize_fonts',
			'default'           => 'Roboto+Slab:400,700=serif',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'title_font',
		array(
			'type'        => 'select',
			'priority'    => '1',
			'description' => __( 'Select your desired font for the Title.', 'sampression-lite' ),
			'section'     => 'sampression_typography_section',
			'choices'     => $google_fonts,
			'settings'    => 'title_font',
			'label'       => __( 'Header Text Font', 'sampression-lite' ),
		)
	);

	/**
	 * Header text color setting
	 */
	$wp_customize->add_setting( 'title_textcolor',
		array(
			'default'           => '#FE6E41',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'title_textcolor',
			array(
				'label'    => __( 'Header Text Color', 'sampression-lite' ),
				'priority' => '2',
				'section'  => 'sampression_typography_section',
				'settings' => 'title_textcolor',
			)
		)
	);

	/**
	 * Body Text Font - Setting
	 */
	$wp_customize->add_setting(
		'body_font',
		array(
			'sanitize_callback' => 'sampression_sanitize_fonts',
			'default'           => 'Roboto:400,400italic,700,700italic=sans-serif',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'body_font',
		array(
			'type'        => 'select',
			'priority'    => '3',
			'description' => __( 'Select your desired font for the body text.', 'sampression-lite' ),
			'section'     => 'sampression_typography_section',
			'choices'     => $google_fonts,
			'settings'    => 'body_font',
			'label'       => __( 'Body Text Font', 'sampression-lite' ),
		)
	);

	/**
	 * Body text color setting
	 */
	$wp_customize->add_setting( 'body_textcolor',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_textcolor',
			array(
				'label'    => __( 'Body Text Color', 'sampression-lite' ),
				'priority' => '4',
				'section'  => 'sampression_typography_section',
				'settings' => 'body_textcolor',
			)
		)
	);

	/**
	 * Link color setting
	 */
	$wp_customize->add_setting( 'link_color',
		array(
			'default'           => '#8AB7AD',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label'    => __( 'Link Color', 'sampression-lite' ),
				'priority' => '5',
				'section'  => 'sampression_typography_section',
				'settings' => 'link_color',
			)
		)
	);

	/**
	 * Colors - Section
	 */
	$wp_customize->add_section( 'colors', array(
		'title'          => __( 'Background Color', 'sampression-lite' ),
		'theme_supports' => 'custom-background',
		'panel'          => 'sampression_general_setting_panel',
		'priority'       => 3,
	) );

	/*
	 * Header & Navigation - Panel
	 */

	$wp_customize->add_panel( 'sampression_header_nav_panel', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Header &amp; Navigation', 'sampression-lite' ),
		'description'    => __( 'You can add/remove social media links, search bar and header image here.', 'sampression-lite' ),
	) );

	/**
	 * Social - Section
	 */
	$wp_customize->add_section(
		'sampression_social_section',
		array(
			'title'    => __( 'Social Media', 'sampression-lite' ),
			'priority' => 1,
			'panel'    => 'sampression_header_nav_panel',
		)
	);

	/**
	 * Facebook URL
	 */
	$fb_icon = '';
	if ( get_option( 'opt_get_facebook' ) ) {
		$fb_icon = get_option( 'opt_get_facebook' );
	}

	$wp_customize->add_setting( 'sampression_socials_facebook',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => $fb_icon,
		)
	);
	$wp_customize->add_control(
		'sampression_socials_facebook',
		array(
			'label'    => __( 'Facebook link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_facebook',
			'priority' => 1,
		)
	);

	/**
	 * Twitter URL
	 */
	$tw_icon = '';
	if ( get_option( 'opt_get_twitter' ) ) {
		$tw_icon = get_option( 'opt_get_twitter' );
	}

	$wp_customize->add_setting( 'sampression_socials_twitter',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => $tw_icon,
		)
	);
	$wp_customize->add_control(
		'sampression_socials_twitter',
		array(
			'label'    => __( 'Twitter link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_twitter',
			'priority' => 2,
		)
	);

	/**
	 * Youtube URL
	 */
	$yt_icon = '';
	if ( get_option( 'opt_get_youtube' ) ) {
		$yt_icon = get_option( 'opt_get_youtube' );
	}

	$wp_customize->add_setting( 'sampression_socials_youtube', array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => $yt_icon,
	) );
	$wp_customize->add_control(
		'sampression_socials_youtube',
		array(
			'label'    => __( 'Youtube link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_youtube',
			'priority' => 3,
		)
	);

	/**
	 * Google+ URL
	 */
	$gp_icon = '';
	if ( get_option( 'opt_get_gplus' ) ) {
		$gp_icon = get_option( 'opt_get_gplus' );
	}

	$wp_customize->add_setting( 'sampression_socials_googleplus', array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => $gp_icon,
	) );
	$wp_customize->add_control(
		'sampression_socials_googleplus',
		array(
			'label'    => __( 'Google+ link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_googleplus',
			'priority' => 4,
		)
	);

	/**
	 * Tumblr URL
	 */
	$wp_customize->add_setting( 'sampression_socials_tumblr', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		'sampression_socials_tumblr',
		array(
			'label'    => __( 'Tumblr link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_tumblr',
			'priority' => 5,
		)
	);

	/**
	 * Pinterest URL
	 */
	$wp_customize->add_setting( 'sampression_socials_pinterest', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		'sampression_socials_pinterest',
		array(
			'label'    => __( 'Pinterest link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_pinterest',
			'priority' => 6,
		)
	);

	/**
	 * Linkedin URL
	 */
	$wp_customize->add_setting( 'sampression_socials_linkedin', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		'sampression_socials_linkedin',
		array(
			'label'    => __( 'Linkedin link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_linkedin',
			'priority' => 7,
		)
	);

	/**
	 * Github URL
	 */
	$wp_customize->add_setting( 'sampression_socials_github', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		'sampression_socials_github',
		array(
			'label'    => __( 'Github link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_github',
			'priority' => 8,
		)
	);

	/**
	 * Instagram URL
	 */
	$wp_customize->add_setting( 'sampression_socials_instagram', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		'sampression_socials_instagram',
		array(
			'label'    => __( 'Instagram link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_instagram',
			'priority' => 9,
		)
	);

	/**
	 * Flickr URL
	 */
	$wp_customize->add_setting( 'sampression_socials_flickr', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		'sampression_socials_flickr',
		array(
			'label'    => __( 'Flickr link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_flickr',
			'priority' => 10,
		)
	);

	/**
	 * Vimeo URL
	 */
	$wp_customize->add_setting( 'sampression_socials_vimeo', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		'sampression_socials_vimeo',
		array(
			'label'    => __( 'Vimeo link', 'sampression-lite' ),
			'section'  => 'sampression_social_section',
			'settings' => 'sampression_socials_vimeo',
			'priority' => 11,
		)
	);

	/**
	 * Search Option - Section
	 */
	$wp_customize->add_section(
		'sampression_search_section',
		array(
			'title'    => __( 'Search Option', 'sampression-lite' ),
			'priority' => 2,
			'panel'    => 'sampression_header_nav_panel',
		)
	);

	/*
	 * Remove search box Setting
	 */
	$wp_customize->add_setting( 'sampression_remove_search', array( 'sanitize_callback' => 'sampression_sanitize_text' ) );
	$wp_customize->add_control(
		'sampression_remove_search',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Remove Search Box?', 'sampression-lite' ),
			'section'  => 'sampression_search_section',
			'priority' => 1,
		)
	);

	/**
	 * Header Image Section
	 */
	$wp_customize->add_section( 'header_image',
		array(
			'title'          => __( 'Header Image', 'sampression-lite' ),
			'theme_supports' => 'custom-header',
			'priority'       => 3,
			'panel'          => 'sampression_header_nav_panel',
		)
	);

}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sampression_customize_preview_js() {
	wp_enqueue_script( 'sampression_customizer', get_template_directory_uri() . '/lib/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

function sampression_customize_controls_js() {

	$wp_url            = esc_url( site_url() );
	$wp_version        = get_bloginfo( 'version' );
	$sampression_theme = wp_get_theme();
	$active_plugins    = get_option( 'active_plugins' );
	$active_plugins    = implode( ', ', $active_plugins );

	wp_enqueue_script( 'sampression_customizer_script', get_template_directory_uri() . '/lib/js/sampression.customizer.js', array( 'jquery' ), '1.0', true );

	wp_localize_script( 'sampression_customizer_script', 'objectL10n', array(

		'documentation'          => __( 'Theme Documentation', 'sampression-lite' ),
		'pro'                    => __( 'UPGRADE TO PRO', 'sampression-lite' ),
		'support_ticket'         => __( 'Support Ticket', 'sampression-lite' ),
		'support_ticket_subject' => 'Support Ticket: Sampression Lite Version ' . $sampression_theme->get( 'Version' ),
		'support_ticket_body'    => 'Site URL: ' . $wp_url . '%0D%0AWP Version: ' . $wp_version . '%0D%0AInstalled Plugins: ' . $active_plugins,

	) );

}

function sampression_sanitize_html( $input ) {

	$allowed_html = array(
		'style'  => array(
			'id'   => array(),
			'type' => array(),
		),
		'script' => array(
			'src'  => array(),
			'type' => array(),
		),
		'link'   => array(
			'rel'   => array(),
			'id'    => array(),
			'href'  => array(),
			'media' => array(),
			'type'  => array(),
		),
	);

	return wp_kses( $input, $allowed_html );

}

//Sanitizes Fonts 
function sampression_sanitize_fonts( $input ) {
	$valid = array(
		'Roboto+Slab:400,700=serif'                              => 'Roboto Slab - Default Header',
		'Roboto:400,400italic,700,700italic=sans-serif'          => 'Roboto - Default Body',
		'Playfair+Display:400,700,400italic,700italic=serif'     => 'Playfair Display',
		'Work+Sans:400,700=sans-serif'                           => 'Work Sans',
		'Alegreya:400,400italic,700,700italic=serif'             => 'Alegreya',
		'Alegreya+Sans:400,400italic,700,700italic=sans-serif'   => 'Alegreya Sans',
		'Fira+Sans:400,400italic,700,700italic=sans-serif'       => 'Fira Sans',
		'Droid+Sans:400,700=sans-serif'                          => 'Droid Sans',
		'Source+Sans+Pro:400,400italic,700,700italic=sans-serif' => 'Source Sans Pro',
		'Source+Serif+Pro:400,700=serif'                         => 'Source Serif Pro',
		'Lora:400,700=serif'                                     => 'Lora',
		'Neuton:400,700=serif'                                   => 'Neuton',
		'Poppins:400,700=sans-serif'                             => 'Poppins',
		'Karla:400,700=sans-serif'                               => 'Karla',
		'Merriweather:400,400italic,700,700italic=serif'         => 'Merriweather',
		'Open+Sans:400,400italic,700,700italic=sans-serif'       => 'Open Sans',
		'Lato:400,400italic,700,700italic=sans-serif'            => 'Lato',
		'Droid+Serif:400,400italic,700,700italic=serif'          => 'Droid Serif',
		'Archivo+Narrow:400,400italic,700,700italic=sans-serif'  => 'Archivo Narrow',
		'Libre+Baskerville:400,700,400italic=serif'              => 'Libre Baskerville',
		'Crimson+Text:400,400italic,700,700italic=serif'         => 'Crimson Text',
		'Montserrat:400,700=sans-serif'                          => 'Montserrat',
		'Chivo:400,400italic=sans-serif'                         => 'Chivo',
		'Old+Standard+TT:400,400italic,700=serif'                => 'Old Standard TT',
		'Domine:400,700=serif'                                   => 'Domine',
		'Varela+Round=sans-serif'                                => 'Varela Round',
		'Bitter:400,700=serif'                                   => 'Bitter',
		'Cardo:400,700,400italic=serif'                          => 'Cardo',
		'Arvo:400,400italic,700,700italic=serif'                 => 'Arvo',
		'PT+Serif:400,400italic,700,700italic=serif'             => 'PT Serif',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function sampression_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function sampression_sanitize_pro_version( $input ) {
	return $input;
}

function sampression_sanitize_widgets( $input ) {
	return $input;
}

function sampression_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

add_action( 'customize_register', 'sampression_customize_register' );
add_action( 'customize_preview_init', 'sampression_customize_preview_js' );
add_action( 'customize_controls_enqueue_scripts', 'sampression_customize_controls_js' );