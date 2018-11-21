<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="<?= COR_BARRA_NAVEGADOR ?>">

        <?php if ( SUPORTE_PWA ) { ?>
            <link rel="manifest" href="<?= get_stylesheet_directory_uri() . '/PWA/manifest.json' ?>">
        <?php } ?>

        <?php wp_head(); ?>
        

        <?php 
        /**
         * Caso a fonte existe no Google Fonts, fazer da seguinte
         * forma para melhorar a performance:
         * 
         * <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
         */
        ?>

        <!-- Fontes 
        <style type="text/css">
            @font-face {
                font-family: "Arial";
                src: url(<?= FONTS_DIR ?>/light.otf);
                font-weight: 300;
            }
            @font-face {
                font-family: "Arial";
                src: url(<?= FONTS_DIR ?>/regular.otf);
                font-weight: 400;
            }
            @font-face {
                font-family: "Arial";
                src: url(<?= FONTS_DIR ?>/media.otf);
                font-weight: 500;
            }
            @font-face {
                font-family: "Arial";
                src: url(<?= FONTS_DIR ?>/bold.otf);
                font-weight: 700;
            }
        </style>
        -->
    </head>

    <body <?php body_class(); ?>>
        <header class="main-header">
            <div class="header-grid">
                <?php the_custom_logo(); ?>
                <nav class="nav-menu" role="navigation">
                    <?php wp_nav_menu( array ( 'menu' => 'Menu Principal' ) ); ?>
                </nav>
            </div>
        </header>
