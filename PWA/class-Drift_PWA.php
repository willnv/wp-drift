<?php

class Drift_PWA {

    public function __construct() {
        add_action( 'wp_head', array( 'Drift_PWA', 'load_manifest' ) );
        add_action( 'after_setup_theme', array( 'Drift_PWA', 'cria_service_worker' ) );
        add_action( 'wp_enqueue_scripts', array( 'Drift_PWA', 'load_service_worker' ) );
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
                fopen( ABSPATH . 'serviceWorker.js', 'w' );
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
        
        if ( Drift_PWA::cria_service_worker() ): ?>
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