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

];

// Unir rutas base con rutas específicas de idioma
$routes = $routes + generateLanguageRoutes($base_routes, true);

return $routes;
