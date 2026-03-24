<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Theme support
add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
} );

// Enqueue assets
add_action( 'wp_enqueue_scripts', function() {
    $css_ver = filemtime( get_template_directory() . '/assets/css/main.css' );
    $js_ver  = filemtime( get_template_directory() . '/assets/js/main.js' );

    wp_enqueue_style(
        'mikel-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        $css_ver
    );
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Inter:wght@300;400&display=swap',
        [],
        null
    );
    wp_enqueue_script(
        'mikel-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $js_ver,
        true
    );
} );

// Helper: convert [brackets] to italic gold em
function mikel_tagged( $str ) {
    return preg_replace( '/\[([^\]]+)\]/', '<em style="color:#C4B99A;font-style:italic">$1</em>', wp_kses_post( $str ) );
}

// Include ACF field registration
require_once get_template_directory() . '/acf-fields.php';
