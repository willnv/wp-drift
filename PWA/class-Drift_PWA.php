<?php

class Drift_PWA {

    public function __construct() {
        add_action( 'wp_head', array( __CLASS__, 'load_manifest' ) );
        add_action( 'after_setup_theme', array( __CLASS__, 'create_service_worker' ) );
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_service_worker' ) );
    }

    /**
     * Loads manifest.json
     */
    public static function load_manifest() {
        $dir = THEME_DIR . '/PWA/manifest.json';
        $tag = "<link rel='manifest' href='{$dir}'>";

        echo $tag;
    }

    /**
     * Creates the serviceWorker.js file in the
     * website's root folder.
     */
    public static function create_service_worker() {

        if ( !file_exists( ABSPATH . 'serviceWorker.js' ) ) {

            try {
                $file = fopen( ABSPATH . 'serviceWorker.js', 'w' );
                $script_content = file_get_contents( THEME_DIR . '/PWA/serviceWorker.js' );

                file_put_contents( ABSPATH . 'serviceWorker.js', $script_content );

                fclose( $file );

            } catch (Exception $e) {
                echo 'Error: serviceWorker.js file can\'t be created';

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
        
        if ( self::create_service_worker() ): ?>
            <script>
                if ('serviceWorker' in navigator) {
                    navigator.serviceWorker.register( '<?= SITEURL ?>/serviceWorker.js')
                    .then(function(registration) {
                        console.log('Service Worker registered');
                    })
                    .catch(function(err) {
                        console.error('Error: Service Worker can\'t be loaded.');
                    });
                }
            </script>
        <?php endif;
    }
}

$pwa = new Drift_PWA();