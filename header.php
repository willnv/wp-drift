<!DOCTYPE html>
<html lang="pt">
    <head>
        <?php 
            wp_head(); 
            define( 'SITEURL', get_site_url() );
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <style type="text/css">
            @font-face {
                font-family: "Thin";
                src: url(<?= SITEURL ?>/wp-content/fontes/thin.otf);
            }
            @font-face {
                font-family: "Light";
                src: url(<?= SITEURL ?>/wp-content/fontes/light.otf);
            }
            @font-face {
                font-family: "Regular";
                src: url(<?= SITEURL ?>/wp-content/fontes/regular.otf);
            }
            @font-face {
                font-family: "Medium";
                src: url(<?= SITEURL ?>/wp-content/fontes/media.otf);
            }
            @font-face {
                font-family: "Bold";
                src: url(<?= SITEURL ?>/wp-content/fontes/bold.otf);
            }
            @font-face {
                font-family: "Letra";
                src: url(<?= SITEURL ?>/wp-content/fontes/letra.ttf);
            }
        </style>
    </head>

    <body <?php body_class(); ?>>
        <header class="header-principal">
            <?php the_custom_logo(); ?>
            <div>
                <nav class="menu-principal" role="navigation">
                    <?php wp_nav_menu( array ( 'menu' => 'Menu Principal' ) ); ?>
                </nav>
            </div>
        </header>
