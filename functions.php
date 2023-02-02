<?php
/**
 * UnitedMaltCo Theme
 * Functions.php
 */
 
function divichild_enqueue_scripts() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'divichild_enqueue_scripts' );
/**
 * Include Support for Advance Custom Fields Pro.
 * 
 * @since v1.0
 */
$theme_ACFPro = __DIR__ . '/includes/acf.php';
$theme_ACFProDIR  = __DIR__ . '/includes/acf/;
if ( is_readable( $theme_ACFPro ) ) {
	require_once $theme_ACFPro;
}