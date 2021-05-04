<?php

namespace WPDrift\Classes;

class Drift {

    /**
     * Initialize actions
     */
    public function __construct() {
        add_action( 'template_redirect', [ $this, 'dft_maintenance_mode' ] );
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
}