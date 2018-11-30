<?php

/**
 * Bibliotécas que serão utilizadas no site. Para melhor performance,
 * sugiro que depois de finalizado o site, ir no functions e definir 
 * condicionais de páginas para que as libs sejam carregadas 
 * apenas onde serão usadas.
 * 
 * Exemplo: is_page( 'contato' )
 * 
 */
define( 'MODAL_VIDEO', false );
define( 'IMAGE_LIGHTBOX', false );
define( 'SLIM_SELECT', false );


/**
 * Configs do WooCommerce
 */
define( 'SUPORTE_WOOCOMMERCE', false );



/**
 * PWA / Mobile
 */
define( 'SUPORTE_PWA', true );
define( 'COR_BARRA_NAVEGADOR', '#000000' );


/**
 * Outras configs
 */
define( 'COMENTARIOS', false );




/**
 * ~ Aqui não é preciso editar nada ~
 * Configs gerais
 */
define( 'SITEURL', get_site_url() );
define( 'THEME_DIR', get_stylesheet_directory_uri() );
define( 'FONTS_DIR', get_stylesheet_directory_uri() . '/fontes' );


/**
 * Debug
 */
ini_set( 'display_errors', 'On' ); // off
error_reporting( E_ALL );