<?php

// Define las rutas base que quieres traducir
$base_routes = [
    // HOMEPAGE
    '/ca' => 'public/web-publica/index.php',
    '/homepage' => 'public/web-publica/index.php',

    // ARTICLES
    '/article/{slug}' => 'public/web-publica/article.php',

    // CURSOS
    '/course/{slug}' => 'public/web-publica/curs.php',


    // 08. Biblioteca llibres
    $url['biblioteca'] => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'index.php',
    $url['biblioteca'] . '/llistat-llibres' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llistat-llibres.php',
    $url['biblioteca'] . '/llistat-autors' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llistat-autors.php',
    $url['biblioteca']  . '/fitxa-llibre/{slug}' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llibre.php',
    $url['biblioteca'] . '/fitxa-autor/{slug}' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-autor.php',

    // 17. Viatges
    $url['viatges'] => APP_INTRANET_DIR . APP_VIATGES_DIR . 'index.php',
    $url['viatges'] . '/llistat-viatges' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'llistat-viatges.php',
    $url['viatges'] . '/fitxa-viatge/{slug}' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'fitxa-viatge.php',
    $url['viatges'] . '/fitxa-espai/{slug}' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'fitxa-espai.php',

    // Cinema
    $url['cinema'] . '/llistat-pelicules' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-pelicules.php',
    $url['cinema'] . '/llistat-series' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-series.php',
    $url['cinema'] . '/llistat-directors' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-directors.php',
    $url['cinema'] . '/llistat-actors' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat.actors.php',
    $url['cinema'] . '/llistat-obres-teatre' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-teatre.php',

    $url['cinema'] . '/fitxa-actor/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-actor.php',
    $url['cinema'] . '/fitxa-director{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-director.php',
    $url['cinema'] . '/fitxa-pelicula/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-pelicula.php',
    $url['cinema'] . '/fitxa-serie/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-serie.php',
    $url['cinema'] . '/fitxa-teatre/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-teatre.php',
];

// Rutas principales sin idioma explícito (solo para el idioma por defecto)
$routes = [
    // HOMEPAGE GESTIO
    '/ca/homepage' => [
        'view' => 'public/web-publica/index.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
    ],

    // ARTICLES
    '/ca/article/{slug}' => [
        'view' => 'public/web-publica/article.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
    ],

    // CURSOS
    '/ca/course/{slug}' => [
        'view' => 'public/web-publica/curs.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
    ],

    // 08. Biblioteca llibres
    $url['biblioteca'] => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'index.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['biblioteca'] . '/llistat-llibres' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llistat-llibres.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['biblioteca'] . '/llistat-autors' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llistat-autors.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['biblioteca'] . '/fitxa-llibre/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llibre.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['biblioteca'] . '/fitxa-autor/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-autor.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    // 17. Viatges
    $url['viatges'] => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'index.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['viatges'] . '/llistat-viatges' => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'llistat-viatges.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['viatges'] . '/fitxa-viatge/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'fitxa-viatge.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['viatges'] . '/fitxa-espai/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'fitxa-espai.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    // Cinema
    $url['cinema'] => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'index.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/llistat-pelicules' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-pelicules.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/llistat-series' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-series.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/llistat-directors' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-directors.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/llistat-actors' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-actors.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/llistat-obres-teatre' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-teatre.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/fitxa-actor/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-actor.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/fitxa-director/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-director.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/fitxa-pelicula/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-pelicula.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/fitxa-serie/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-serie.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

    $url['cinema'] . '/fitxa-teatre/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-teatre.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => true,
        'apiSenseHTML' => false,
        'menu_intranet' => false
    ],

];

// Unir rutas base con rutas específicas de idioma
$routes = $routes + generateLanguageRoutes($base_routes, true);

return $routes;
