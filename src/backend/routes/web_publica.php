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


];

// Unir rutas base con rutas específicas de idioma
$routes = $routes + generateLanguageRoutes($base_routes, true);

return $routes;
