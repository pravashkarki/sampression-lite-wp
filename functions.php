<?php
/**
 * Sampression functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sampression-Lite
 */

/**
 *
 * WARNING: Please do not edit this file in any way
 *
 * Load the theme function files.
 */
require get_template_directory() . '/includes/functions.php';
require get_template_directory() . '/includes/customizer.php';
require get_template_directory() . '/includes/theme-page.php';

// TGM Plugin activation.
require_once trailingslashit( get_template_directory() ) . '/tgm/class-tgm-plugin-activation.php';
