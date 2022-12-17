<?php
/**
 * Theme Info
 *
 * @package sampresion-lite
 * @since version 2.1
 */

if ( ! function_exists( 'sampression_add_info_customizer' ) ) {
	/**
	 * Add Info about theme in customizer.
	 * @param $wp_customize
	 */
	function sampression_add_info_customizer( $wp_customize ) {

		/**
		 * Theme important links class.
		 */
		class Sampression_Important_Links extends WP_Customize_Control {
			/**
			 *  Add Theme instruction, Support Forum, Demo Link, Rating Link.
			 */
			public function render_content() {

				$important_links = array(
					'theme-info'    => array(
						'link' => esc_url( 'https://www.sampression.com/themes/sampression-lite/' ),
						'text' => esc_html__( 'Theme Info', 'sampression-lite' ),
					),
					'support'       => array(
						'link' => esc_url( 'https://www.sampression.com/support/' ),
						'text' => esc_html__( 'Support', 'sampression-lite' ),
					),
					'documentation' => array(
						'link' => esc_url( 'https://www.sampression.com/documentation-sampression-lite/' ),
						'text' => esc_html__( 'Documentation', 'sampression-lite' ),
					),
					'demo'          => array(
						'link' => esc_url( 'https://www.demo.sampression.com/?demosite=SAMPRESSION-LITE' ),
						'text' => esc_html__( 'Live Theme Demo', 'sampression-lite' ),
					),
					'forum'          => array(
						'link' => esc_url( 'https://www.sampression.com/community/' ),
						'text' => esc_html__( 'Community Forum', 'sampression-lite' ),
					),
				);
				$count = 0;
				$pro = "pro";
				foreach ( $important_links as $important_link ) {?>
					<p class="btn-wrap <?php if( 0 == $count ){ echo esc_attr( $pro ); } ?> ">
						<a target="_blank" href="<?php echo esc_url( $important_link['link'] ); ?>">
							<?php echo esc_html( $important_link['text'] );?>
						</a>
					</p>
					<?php
					$count++;
				}
			}
		}

		$wp_customize->add_section( 'sampression_important_links', array(
			'priority' => 1,
			'title'    => __( 'Sampression Important Links', 'sampression-lite' ),
		) );

		$wp_customize->add_setting( 'sampression_theme_settings[sampression_important_links]', array(
			'capability'        => 'manage_options',
			'type'              => 'option',
			'sanitize_callback' => 'sampression_links_sanitize',
		) );

		$wp_customize->add_control( new sampression_Important_Links( $wp_customize, 'sampression_theme_settings[sampression_important_links]', array(
			'label'    => __( 'Important Links', 'sampression-lite' ),
			'section'  => 'sampression_important_links',
			'settings' => 'sampression_theme_settings[sampression_important_links]',
		) ) );

	}
}

add_action( 'customize_register', 'sampression_add_info_customizer' );

