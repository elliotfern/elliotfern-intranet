<?php

// Define las rutas base que quieres traducir
$base_routes = [
    // 0. Entrada Pàgina login i homepage
    '/gestio/entrada' => 'public/intranet/00_homepage/login.php',
    '/gestio' => 'public/intranet/00_homepage/admin.php',
    '/gestio/admin' => 'public/intranet/00_homepage/admin.php',

];

// Rutas principales sin idioma explícito (solo para el idioma por defecto)
$routes = [
    // ACCES SECCIO GESTIO
    '/gestio/entrada' => ['view' => 'public/intranet/00_homepage/login.php', 'needs_session' => false, 'header_footer' => true, 'header_menu_footer' => false, 'apiSenseHTML' => false],

    // HOMEPAGE GESTIO
    '/gestio' => ['view' => 'public/intranet/00_homepage/admin.php', 'needs_session' => true, 'header_footer' => false, 'header_menu_footer' => true, 'apiSenseHTML' => false],

    '/gestio/admin' => ['view' => 'public/intranet/00_homepage/admin.php', 'needs_session' => true, 'header_footer' => false, 'header_menu_footer' => true, 'apiSenseHTML' => false],

];

// Unir rutas base con rutas específicas de idioma
$routes = $routes + generateLanguageRoutes($base_routes, false);

return $routes;
