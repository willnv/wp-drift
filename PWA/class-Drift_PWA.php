<?php

class Drift_PWA {

    public function __construct() {
        add_action( 'wp_head', array( __CLASS__, 'load_manifest' ) );
        add_action( 'after_setup_theme', array( __CLASS__, 'cria_service_worker' ) );
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_service_worker' ) );
    }

    /**
     * Carrega o manifest.json entre as tags <head> do site
     */
    public static function load_manifest() {
        $dir = THEME_DIR . '/PWA/manifest.json';
        $tag = "<link rel='manifest' href='{$dir}'>";

        echo $tag;
    }


    /**
     * Cria o ServiceWorker.js na pasta raíz do site hospedado,
     * isso é necessário pois o sw sempre terá controle apenas sobre
     * os diretórios filhos.
     */
    public static function cria_service_worker() {

        if ( !file_exists( ABSPATH . 'serviceWorker.js' ) ) {

            try {
                $file = fopen( ABSPATH . 'serviceWorker.js', 'w' );
                $script_content = file_get_contents( THEME_DIR . '/PWA/serviceWorker.js' );

                file_put_contents( ABSPATH . 'serviceWorker.js', $script_content );

                fclose( $file );

            } catch (Exception $e) {
                echo 'Erro: não foi possível criar o arquivo serviceWorker.js';

                return false;
            }
        } else {
            return true;
        }
    }

     /**
     * Carrega o Service Worker
     */
    public static function load_service_worker() { 
        
        if ( self::cria_service_worker() ): ?>
            <script>
                if ('serviceWorker' in navigator) {
                    navigator.serviceWorker.register( '<?= SITEURL ?>/serviceWorker.js')
                    .then(function(registration) {
                        console.log('- SW Registrado -');
                    })
                    .catch(function(err) {
                        console.error('Erro: Service Worker não carregado: class-Drift_PWA.php \n' + err);
                    });
                }
            </script>
        <?php endif;
    }
}

$pwa = new Drift_PWA();