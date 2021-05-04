<?php
/**
 * This is the main class which handles
 * nearly all of WP-Drift's features and core
 * 
 * @author Willon Nava
 */
namespace WPDrift\Classes;

class Drift {

    /**
     * Initialize actions
     */
    public function __construct() {
        add_action( 'template_redirect', [ $this, 'dft_maintenance_mode' ] );
        add_filter( 'admin_title', [ $this, 'change_admin_title' ], 10, 2 );

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
}