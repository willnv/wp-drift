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
}