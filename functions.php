<?php	

/**
 * Preparações iniciais do tema.
 */
add_filter( 'auto_update_theme', '__return_false' );

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'title-tag' ); 
add_theme_support( 'custom-logo' );
# add_theme_support( 'woocommerce' );

wp_create_nav_menu( 'Menu Principal' );

show_admin_bar(false);



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
    wp_enqueue_script( 'dft-main-js', get_stylesheet_directory_uri() . '/assets/js/dft-main.js', array( 'jquery' ) );
    # wp_enqueue_script( 'dft-sticky-menu', get_stylesheet_directory_uri() . '/assets/js/dft-sticky-menu.js', array( 'jquery' ) );

    // Modal Video
    # wp_enqueue_script( 'dft-modal-video-js', get_stylesheet_directory_uri() . '/lib/modal-video/jquery-modal-video.min.js', array( 'jquery' ) );

    // CSS
    wp_enqueue_style( 'dft-main-less', get_stylesheet_directory_uri() . '/custom.less' );
    wp_enqueue_style( 'dft-main-css', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'dft-font-awesome', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css' );
}

function dft_style_admin() {
    wp_enqueue_style( 'dft-style-admin', get_stylesheet_directory_uri() . '/assets/css/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'dft_style_admin' );
add_action( 'wp_enqueue_scripts', 'dft_enqueue_scripts' );
