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
);

Sampression_Demo_Import::init( apply_filters( 'Sampression_Demo_Import_filter', $config ) );
