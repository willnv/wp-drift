<head>
    <?php 
        wp_head(); 
        define( 'SITEURL', get_site_url() );
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body <?php body_class() ?>>
    <header>
        <a href='<?= SITEURL ?>'><img src='<?= SITEURL ?>/wp-content/uploads/2018/07/logo-1.png'></a>
        <div>
            <nav class="menu-principal" role="navigation">
                <?php wp_nav_menu( 'Menu Principal' ); ?>
            </nav>
        </div>
    </header>
