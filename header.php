<?php
/**
 * @author Willon Nava
 */
use WPDrift\Classes\Drift; ?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php Drift::dft_analytics_script(); ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
        <meta name="theme-color" content="<?= TOP_BAR_COLOR ?>">
        <meta name="format-detection" content="telephone=no"/>

        <?php wp_head(); ?>
        
        <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet"> -->
        
    </head>

    <body <?php body_class(); ?>>
        <!-- Start header -->
        <header class="main-header">
            <div class="header-grid">
                <?php the_custom_logo(); ?>
                <nav class="nav-menu" role="navigation">
                    <?php wp_nav_menu( [ 'menu' => 'Main Menu' ] ); ?>
                </nav>
            </div>
        </header>
