<?php
/**
 * Demo content configuration
 *
 * @package sampression-lite
 */


$config = array(
	'static_page'    => 'home',
	'posts_page'     => 'blog',
	'menu_locations' => array(
		'primary' => 'main-menu',
	),
	'ocdi'           => array(
		array(
			'import_file_name'             => esc_html__( 'Theme Demo Content', 'sampression-lite' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo/demo-content/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo/demo-content/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo/demo-content/customizer.dat',
		),
	),
);

Sampression_Demo_Import::init( apply_filters( 'Sampression_Demo_Import_filter', $config ) );