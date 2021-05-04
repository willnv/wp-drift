<?php
/**
 * General config file for
 * theme setup
 */


// Libs
define( 'MODAL_VIDEO', false );
define( 'IMAGE_LIGHTBOX', false );
define( 'SLIM_SELECT', false );
define( 'SLICK_SLIDER', false );


//This is required if using Woocommerce
define( 'WOOCOMMERCE_SUPPORT', false );


// PWA / Mobile
define( 'PWA_SUPPORT', true );
define( 'TOP_BAR_COLOR', '#000000' );


// Misc
define( 'MAINTENANCE', false );
define( 'BLOG', true );
define( 'ID_ANALYTICS', false );
define( 'THEME_ROOT', get_theme_root() . '/wp-drift' );

// Debug
ini_set( 'display_errors', 'On' );
error_reporting( E_ALL );