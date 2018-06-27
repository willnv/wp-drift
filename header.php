<head>
    <?php 
        wp_head(); 
        define( 'SITEURL', get_site_url() );
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
testeeeeeeeee
<body <?php body_class() ?>>
    <header>
        <nav class="menu-principal" role="navigation"><?php wp_nav_menu( 'Menu Principal' ); ?></nav>
    </header>