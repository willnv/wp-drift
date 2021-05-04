<?php	

require_once 'theme-config.php';
require_once 'globals.php';
require_once 'class/Drift.php';

if ( PWA_SUPPORT ) {
    require_once 'PWA/class-Drift_PWA.php';
}

use WPDrift\Classes\Drift;

$class = new Drift();

wp_create_nav_menu( 'Main Menu' );
show_admin_bar( false );


/**
 * Load LESS lib
 */
if ( !is_admin() )
    require_once( dirname( __FILE__ ) . '/lib/wp-less/wp-less.php' );


/**
 * Load shortcodes created in
 * /shortcodes folder. Not loaded
 * in admin panel.
 */
function dft_load_shortcodes() {

    if ( is_admin() )
        return;

    $files = glob( dirname( __FILE__ ) . '/shortcodes/*.php' );

    foreach( $files as $file ) {
        include_once $file;
    }
}
add_action( 'init', 'dft_load_shortcodes' );


/**
 * Adds additional classes to
 * <body>, including post category
 */
function dft_body_extra_classes( $classes ) {
    global $post;
    $cats = get_the_category();

    foreach( $cats as $cat ):
        $classes[] = $cat->slug;
    endforeach;

    if ( $post ) {
        $classes[] = $post->post_name;
    }

    return $classes;
}
add_filter( 'body_class', 'dft_body_extra_classes' );


/**
 * Dequeues unnecessary scripts & styles
 * 
 * Emoji script will only be loaded on single
 * blog posts if BLOG constant is true
 */
if ( !BLOG ) {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
} else {
    add_action( 'wp_enqueue_scripts', 'dequeue_emoji_scripts' );
}

function dequeue_emoji_scripts() {
    if ( is_page() || !is_singular( 'post' ) ) {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
    }
}


/**
 * Deactivates wp-embed.min.js
 */
function dequeue_embed_script() {
    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_embed_script', 99 );


/**
 * Main style & script loading function
*/
function dft_enqueue_scripts() {

    // JS
    wp_enqueue_script( 'dft-custom-js', THEME_DIR . '/assets/js/custom.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'dft-sticky', THEME_DIR . '/assets/js/dft-sticky.js', array( 'jquery' ), false, true );

    // CSS
    wp_enqueue_style( 'dft-main-less', THEME_DIR . '/style.less' );
    wp_enqueue_style( 'dft-main-css', THEME_DIR . '/style.css' );

    /**
     * LIBS
     */
    if ( SLIM_SELECT ) {
        wp_enqueue_style( 'slim-select-css', 'https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.6/slimselect.min.css' );
        wp_enqueue_script( 'slim-select-js', 'https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.6/slimselect.min.js' );
    }

    if ( MODAL_VIDEO ) {
        wp_enqueue_script( 'dft-modal-video-js', THEME_DIR. '/lib/modal-video/jquery-modal-video.min.js', array( 'jquery' ) );
        wp_enqueue_style( 'dft-modal-video-css', THEME_DIR. '/lib/modal-video/modal-video.min.css' );
    }

    if ( IMAGE_LIGHTBOX ) {
        wp_enqueue_script( 'lightbox-js', THEME_DIR . '/lib/lightbox/lightbox.min.js', array( 'jquery' ) );
        wp_enqueue_style( 'lightbox-css', THEME_DIR . '/lib/lightbox/lightbox.min.css' );
    }

    if ( SLICK_SLIDER ) {
        wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
        wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' );
    }
}

function dft_style_admin() {
    wp_enqueue_style( 'dft-style-admin', THEME_DIR . '/assets/css/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'dft_style_admin' );
add_action( 'wp_enqueue_scripts', 'dft_enqueue_scripts' );


/**
 * Adds ordering options to posts
 * inside admin panel
 */
if ( is_admin() ) {
    function post_orders_admin( $wp_query ) {
        if ( is_admin() && !isset( $_GET['orderby'] ) ) {
            $wp_query->set( 'orderby', 'date' );
            $wp_query->set( 'order', 'DESC' );
        }
    }
    add_filter( 'pre_get_posts', 'post_orders_admin' );
}
