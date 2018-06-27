<?php	

/**
 * Preparações iniciais do tema.
 */

add_filter( 'auto_update_theme', '__return_false' );

add_theme_support( 'menus' );
wp_create_nav_menu( 'Menu Principal' );
add_theme_support( 'post-thumbnails' ); 

show_admin_bar(false);



/**
 * Registrando sidebars nos widgets
 */
function dft_register_sidebars() {
    register_sidebar(array(
        'name'        => 'Blog Sidebar',
        'id'          => 'sidebar-blog',
        'description' => 'Sidebar visível apenas na página de blog.'
    ));

    register_sidebar(array(
        'name'        => 'Single Post Sidebar',
        'id'          => 'sidebar-singlepost',
        'description' => 'Sidebar visível apenas no single post.'
    ));
 }
 add_action( 'widgets_init', 'dft_register_sidebars' );



/**
 * Adicionando classes extras no body, 
 * as categorias do post.
 */
function dft_classes_extras_body( $classes ) {

    $cats = get_the_category();

    foreach( $cats as $cat ):
        $classes[] = $cat->slug;
    endforeach;

    return $classes;
}
add_filter( 'body_class', 'dft_classes_extras_body' );



/**
 * Carregando Scripts e Styles
*/
function dft_enqueue_scripts() {

    // JS
    wp_enqueue_script( 'dft-main-js', get_stylesheet_directory_uri() . '/assets/js/dft-main.js', array( 'jquery' ) );
    wp_enqueue_script( 'dft-sticky-menu', get_stylesheet_directory_uri() . '/assets/js/dft-sticky-menu.js', array( 'jquery' ) );

    // CSS
    wp_enqueue_style( 'dft-main-less', get_stylesheet_directory_uri() . '/custom.less' );
    wp_enqueue_style( 'dft-main-css', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'dft-font-awesome', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css' );
}

function dft_style_admin() {
    wp_enqueue_style( 'dft-style-admin', get_stylesheet_directory_uri() . 'assets/css/style-admin.css' );
}

add_action( 'admin_enqueue_scripts', 'dft_style_admin' );
add_action('wp_enqueue_scripts', 'dft_enqueue_scripts');
