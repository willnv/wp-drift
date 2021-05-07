<?php
/**
 * This is the main class which handles
 * nearly all of WP-Drift's features
 * 
 * @author Willon Nava
 */
namespace WPDrift\Classes;

class Drift {

    /**
     * Initialize actions
     */
    public function __construct() {
        // Actions
        add_action( 'template_redirect', [ $this, 'dft_maintenance_mode' ] );
        add_action( 'init', [ $this, 'load_shortcodes' ] );

        // Filters
        add_filter( 'admin_title', [ $this, 'change_admin_title' ], 10, 2 );
        add_filter( 'body_class', [ $this, 'extra_body_classes' ] );

        // Disable auto updates
        add_filter( 'auto_update_theme', '__return_false' );

        self::init_theme_supports();
    }

    /**
     * Redirect the user to a maintenance 
     * page if MAINTENANCE const is defined true
     */
    public static function dft_maintenance_mode() : void {
        if ( MAINTENANCE && !is_user_logged_in() && $GLOBALS['pagenow'] != 'wp-login.php' ) {
            require_once( THEME_ROOT . '/maintenance-mode.php' );
        }
    }

    /**
     * Enables Google Analytics.
     * Define ID in configs.
     */
    public static function dft_analytics_script() : void {

        if ( !defined( 'ID_ANALYTICS' ) || !ID_ANALYTICS )
            return; 
            
        ob_start(); ?>
            
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= ID_ANALYTICS ?>"></script>

        <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', '<?= ID_ANALYTICS ?>');</script>

        <?php ob_flush();
    }

    /**
     * For some features to work,
     * WordPress requires them to be initialized
     */
    private static function init_theme_supports() : void {
        add_theme_support( 'menus' );
        add_theme_support( 'post-thumbnails' ); 
        add_theme_support( 'title-tag' ); 
        add_theme_support( 'custom-logo' );

        if ( WOOCOMMERCE_SUPPORT )
            add_theme_support( 'woocommerce' );
    }

    /**
     * Adds additional classes to
     * <body>, including post category
     */
    function extra_body_classes( $classes ) {
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

    /**
     * Debug helper function, simply
     * pretty-prints an object
     */
    public static function pre( $print ) : void {
        echo '<pre>';
            print_r( $print );
        echo '</pre>';
    }

    /**
     * Add the website's
     * title to the admin panel
     */
    public static function change_admin_title( $admin_title, $title ) : String {
        return get_bloginfo( 'name' ) .' - '. $title;
    }

    /**
     * Load shortcodes created in
     * /shortcodes folder. Not loaded
     * in admin panel.
     */
    public static function load_shortcodes() : void {

        if ( is_admin() )
            return;

        $files = glob( dirname( __FILE__ ) . '/../shortcodes/*.php' );

        if ( !empty( $files ) ) {
            foreach( $files as $file ) {
                include_once $file;
            }
        }
    }
    
    /**
     * Wrapper function to Wordpress' 
     * enqueue scripts. Adds the possibility to
     * specify a unique page for the script to be loaded.
     * 
     * @see wp_enqueue_script
     * @param String|int $page - page identifier
     */
    public static function enqueue_script( String $handle, String $src, Array $deps = [], bool $in_footer = true, $page = null ) : void {

        if ( $page ) {
            if ( is_page( $page ) ) {
                wp_enqueue_script( $handle, $src, $deps, false, $in_footer );
            }
        } else {
            wp_enqueue_script( $handle, $src, $deps, false, $in_footer );
        }
    }

    /**
     * Wrapper function to Wordpress' 
     * enqueue styles. Adds the possibility to
     * specify a unique page for the stylesheet to be loaded.
     * 
     * @see wp_enqueue_style
     * @param String|int $page - page identifier
     */
    public static function enqueue_style( String $handle, String $src, Array $deps = [], $page = null ) : void {

        if ( $page ) {
            if ( is_page( $page ) ) {
                wp_enqueue_style( $handle, $src, $deps, false, 'all' );
            }
        } else {
            wp_enqueue_style( $handle, $src, $deps, false, 'all' );
        }
    }
    
}