<?php	

require_once 'theme-config.php';

/**
 * Preparações iniciais do tema.
 */
add_filter( 'auto_update_theme', '__return_false' );

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'title-tag' ); 
add_theme_support( 'custom-logo' );
wp_create_nav_menu( 'Menu Principal' );
show_admin_bar( false );

if ( SUPORTE_WOOCOMMERCE ) {
    add_theme_support( 'woocommerce' );
}

if ( SUPORTE_PWA ) {
    require_once 'PWA/class-Drift_PWA.php';
}



/**
 * Altera na área admin 
 * o title das páginas
 */
function title_admin( $admin_title, $title ) {
    return get_bloginfo( 'name' ) .' - '. $title;
}
add_filter( 'admin_title', 'title_admin', 10, 2 );



/**
 * Adiciona suporte ao LESS
 */
if ( !is_admin() )
    require_once( dirname( __FILE__ ) . '/lib/wp-less/wp-less.php' );




/**
 * Função que da print_r 
 * com <pre> automatico
 * 
 * @param mixed $print - objeto a ser printado
 */
if ( ! function_exists( 'pre' ) ) {
    function pre( $print ) {
        echo '<pre>';
            print_r( $print );
        echo '</pre>';
    }
}


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
    global $post;
    $cats = get_the_category();

    foreach( $cats as $cat ):
        $classes[] = $cat->slug;
    endforeach;

    $classes[] = $post->post_name;

    return $classes;
}
add_filter( 'body_class', 'dft_classes_extras_body' );



/**
 * Carregando Scripts e Styles
*/
function dft_enqueue_scripts() {

    // JS
    wp_enqueue_script( 'dft-custom-js', THEME_DIR . '/assets/js/custom.js', array( 'jquery' ) );
    # wp_enqueue_script( 'dft-sticky-menu', THEME_DIR . '/assets/js/dft-sticky-menu.js', array( 'jquery' ) );

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

<<<<<<< HEAD
    if ( MODAL_VIDEO ) {
        wp_enqueue_script( 'dft-modal-video-js', get_stylesheet_directory_uri() . '/lib/modal-video/jquery-modal-video.min.js', array( 'jquery' ) );
        wp_enqueue_style( 'dft-modal-video-css', get_stylesheet_directory_uri() . '/lib/modal-video/modal-video.min.css' );
=======
    if ( MODAL_VIDEO_JS ) {
        wp_enqueue_script( 'dft-modal-video-js', THEME_DIR . '/lib/modal-video/jquery-modal-video.min.js', array( 'jquery' ) );
>>>>>>> 4846ec02c50feef00023bcd9758b1a3601185983
    }

    if ( IMAGE_LIGHTBOX ) {
        wp_enqueue_script( 'lightbox-js', THEME_DIR . '/lib/lightbox/lightbox.min.js', array( 'jquery' ) );
        wp_enqueue_style( 'lightbox-css', THEME_DIR . '/lib/lightbox/lightbox.min.css' );
    }
}

function dft_style_admin() {
    wp_enqueue_style( 'dft-style-admin', THEME_DIR . '/assets/css/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'dft_style_admin' );
add_action( 'wp_enqueue_scripts', 'dft_enqueue_scripts' );
