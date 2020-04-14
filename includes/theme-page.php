<?php
/**
 * Sampression Lite Theme Options
 *
 * @package Sampression-Lite
 * @since Sampression Lite 2.0
 */


/**
 *
 * Function to build theme page
 */

add_action( 'admin_menu', 'sampression_theme_page' );

function sampression_theme_page() {
	add_theme_page( __( 'Sampression Theme', 'sampression-lite' ), __( 'About Theme', 'sampression-lite' ), 'edit_theme_options', 'about-sampression', 'sampression_render_theme_page' );
}

/**
 * Sampression lite theme page.
 */

function sampression_render_theme_page() {
	?>
	<div class="wrap" style="width:75%">
		<div>
			<h1><?php esc_html_e( 'Welcome to Sampression Lite', 'sampression-lite' ); ?></h1>
			<p><?php esc_html_e( 'We hope you will enjoy using Sampression Lite, as much as we enjoyed creating it.', 'sampression-lite' ); ?></p>
		</div>
		<div>
			<h2><?php esc_html_e( 'Getting started', 'sampression-lite' ); ?></h2>
			<h4><?php esc_html_e( 'Customize everything from a single place.', 'sampression-lite' ); ?></h4>
			<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'sampression-lite' ); ?></p>
			<p>
				<a class="button button-primary" href="<?php echo esc_url( wp_customize_url() ); ?>">
					<?php esc_html_e( 'Go to Customizer', 'sampression-lite' ); ?>
				</a>
				<a class="button button-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank">
					<?php esc_html_e( 'Visit', 'sampression-lite' ); ?>
					<?php bloginfo( 'name' ); ?>
				</a>
			</p>
			<p>
				<?php esc_html_e( 'For further help, please visit our support page at:', 'sampression-lite' ); ?>
				<a href="https://www.sampression.com/support/" target="_blank">https://www.sampression.com/support/</a>
			</p>
		</div>
		<div>

			<ul class="pro-feature-list">
				<li>
					<h3>
						<?php esc_html_e( 'Demo Content', 'sampression-lite' ); ?>
					</h3>
					<?php esc_html_e( 'To make your setup process more easy, we provide sample demo content files which you can import using One Click Demo Import plugin.', 'sampression-lite' ); ?>
					<a href="https://sampression.com/wp-content/uploads/demo-files.zip" target="_blank"><?php esc_html_e( 'Download Demo Content', 'sampression-lite' ); ?></a>
				</li>
				<li>
					<h3>
						<?php esc_html_e( 'Theme Customizer', 'sampression-lite' ); ?>
					</h3>
					<?php esc_html_e( 'The Sampression Lite Theme Customizer is packed full of design controls and features for setting up the styles of your website, including header styles, typography styles, footer widgets , default colors and so much more..', 'sampression-lite' ); ?>
				</li>
				<li>
					<h3>
						<?php esc_html_e( 'Search Engine Optimised', 'sampression-lite' ); ?>
					</h3>
					<?php esc_html_e( 'Our designers and developers follow the best SEO practices while developing each theme – we make sure search engine spiders like what they see when they are crawling your site.', 'sampression-lite' ); ?>
				</li>
				<li class="clear left">
					<h3>
						<?php esc_html_e( 'Mobile Responsive', 'sampression-lite' ); ?>
					</h3>
					<?php esc_html_e( 'We know that your website needs to be readable on all devices. Sampression Theme is fully responsive and looks great all the way down to even the smallest mobile devices and screen sizes.', 'sampression-lite' ); ?>
				</li>
				<li>
					<h3>
						<?php esc_html_e( 'Right-To-Left (RTL) Support', 'sampression-lite' ); ?>
					</h3>
					<?php esc_html_e( 'Our theme supports Right-To-Left (RTL) Languages to give you a full experience on languages of the world like (Arabic, Hebrew etc.)', 'sampression-lite' ); ?>
				</li>
				<li>
					<h3>
						<?php esc_html_e( 'Translation Ready', 'sampression-lite' ); ?>
					</h3>
					<?php esc_html_e( 'Material packed with .po & .mo files, which will help you localise the theme for another language. We have expanded the theme localisation to cover all aspect, of our theme.', 'sampression-lite' ); ?>
				</li>

			</ul>
			<p style="clear: both; padding-top: 20px;">

				<a target="_blank" class="button button-primary" href="https://www.demo.sampression.com/sampression-lite/">
					<?php esc_html_e( 'Live Theme Demo', 'sampression-lite' ); ?>
				</a>
			</p>
		</div>
	</div>
	<style>
		ul.pro-feature-list {
			list-style: inherit;
		}

		ul.pro-feature-list > li {
			display: inline-block;
			float: left;
			padding: 10px;
			width: 30%;
		}

		ul.pro-feature-list .clear.left {
			clear: left;
		}

		.button.upgrade-pro {
			background-color: #fe6e41;
			box-shadow: 0 1px 0 #FF3B00;
			color: #fff;
			border-color: #FF3B00;
		}

		.button.upgrade-pro:hover {
			background-color: #FB8F6E;
			color: #fff;
			border-color: #FF3B00;
		}
	</style>
	<?php
}
