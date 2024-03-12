<?php

if (! defined('OCUPOP_VERSION') ) {
    // Replace the version number of the theme on each release.
    define('OCUPOP_VERSION', '0.1.1');
}

function ocupop_scripts()
{
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/library/css/style.css', array(), OCUPOP_VERSION);

    wp_register_script( 'main', get_stylesheet_directory_uri() . '/library/js/script.min.js', array('jquery'), OCUPOP_VERSION, true);
    // wp_localize_script( 'main', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'formsNonce' => wp_create_nonce("ocupop_forms_nonce")));
    wp_enqueue_script('main');
}
add_action('wp_enqueue_scripts', 'ocupop_scripts', 9); // set priority lower than 10 so that theme.json variables can override the css resets



function ocupop_scripts_in_admin_also()
{
    wp_enqueue_style('owl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), OCUPOP_VERSION);
    wp_enqueue_script('owl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), OCUPOP_VERSION, false);
}
add_action('wp_enqueue_scripts', 'ocupop_scripts_in_admin_also', 9);
add_action('admin_enqueue_scripts', 'ocupop_scripts_in_admin_also', 9);




/**
 * Inline important javascript in the HEAD.
 */
add_action('wp_head', 'add_top_inline_scripts');
function add_top_inline_scripts()
{
    echo "<script>";
    include get_stylesheet_directory() . '/library/js/top-script.min.js'; // phpcs:ignore WordPressVIPMinimum.Files.IncludingNonPHPFile.IncludingNonPHPFile
    echo "</script>";
};

/**
 * Inline important javascript in the HEAD.
 */

/**
 * Enqueue a styles and script in the WordPress admin.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function ocupop_enqueue_admin_script(){
  wp_enqueue_script('admin-custom', get_template_directory_uri() . '/library/js/admin-scripts.js', array(), OCUPOP_VERSION, true);
  wp_enqueue_style('admin-custom', get_template_directory_uri() . '/library/css/admin-styles.css', array(), OCUPOP_VERSION);
}
add_action('admin_init', 'ocupop_enqueue_admin_script');


