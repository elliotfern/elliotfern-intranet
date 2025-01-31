<?php

// Define las rutas base que quieres traducir
$base_routes = [
    // 0. Entrada Pàgina login i homepage
    '/gestio/entrada' => 'public/intranet/00_homepage/login.php',
    '/gestio' => 'public/intranet/00_homepage/admin.php',
    '/gestio/admin' => 'public/intranet/00_homepage/admin.php',

    // VAULT
    '/gestio/vault' => 'public/intranet/10_claus_acces/index.php',
    '/gestio/vault/elliot' => 'public/intranet/10_claus_acces/vault-elliot.php',
    '/gestio/vault/nova' => 'public/intranet/10_claus_acces/nova-contrasenya.php',

    // CINEMA
    '/gestio/cinema' => 'public/intranet/11_cinema_series/index.php',
    '/gestio/cinema/pelicules/llistat' => 'public/intranet/11_cinema_series/vista-llistat-pelicules.php',
    '/gestio/cinema/series' => 'app/Views/11_cinema_series/vista-llistat-series.php',
    '/gestio/cinema/nova-pelicula' => 'public/intranet/11_cinema_series/form-inserir-pelicula.php',
    '/gestio/cinema/modifica-pelicula/{id}' => 'public/intranet/11_cinema_series/form-inserir-pelicula.php',
    '/gestio/cinema/fitxa-pelicula/{id}' => 'public/intranet/11_cinema_series/vista-pelicula.php',

    // ERP
    '/gestio/erp' => 'public/intranet/02_erp_comptabilitat/index.php',
    '/gestio/erp/facturacio-clients' => 'public/intranet/02_erp_comptabilitat/erp-invoices-customers.php',
    '/gestio/erp/facturacio-clients/nova-factura' => 'public/intranet/02_erp_comptabilitat/erp-invoices-customers-new.php',

    // XARXES SOCIALS
    '/gestio/xarxes-socials' => 'public/intranet/12_xarxes_socials/index.php',
];

// Rutas principales sin idioma explícito (solo para el idioma por defecto)
$routes = [
    // ACCES SECCIO GESTIO
    '/gestio/entrada' => ['view' => 'public/intranet/00_homepage/login.php', 'needs_session' => false, 'header_footer' => true, 'header_menu_footer' => false, 'apiSenseHTML' => false],

    // HOMEPAGE GESTIO
    '/gestio' => [
        'view' => 'public/intranet/00_homepage/admin.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/admin' => [
        'view' => 'public/intranet/00_homepage/admin.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // VAULT
    '/gestio/vault' => [
        'view' => 'public/intranet/10_claus_acces/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/vault/elliot' => [
        'view' => 'public/intranet/10_claus_acces/vault-elliot.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],


    '/gestio/vault/nova' => [
        'view' => 'public/intranet/10_claus_acces/nova-contrasenya.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // CINEMA
    '/gestio/cinema' => [
        'view' => 'public/intranet/11_cinema_series/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/cinema/pelicules/llistat' => [
        'view' => 'public/intranet/11_cinema_series/vista-llistat-pelicules.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/cinema/series' => [
        'view' => 'public/intranet/11_cinema_series/vista-llistat-series.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/cinema/nova-pelicula' => [
        'view' => 'public/intranet/11_cinema_series/form-inserir-pelicula.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/cinema/modifica-pelicula/{id}' => [
        'view' => 'public/intranet/11_cinema_series/form-inserir-pelicula.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/cinema/fitxa-pelicula/{id}' => [
        'view' => 'public/intranet/11_cinema_series/vista-pelicula.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // ERP
    '/gestio/erp' => [
        'view' => 'public/intranet/02_erp_comptabilitat/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/erp/facturacio-clients' => [
        'view' => 'public/intranet/02_erp_comptabilitat/erp-invoices-customers.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/erp/facturacio-clients/nova-factura' => [
        'view' => 'public/intranet/02_erp_comptabilitat/erp-invoices-customers-new.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // XARXES SOCIALS
    '/gestio/xarxes-socials' => [
        'view' => 'public/intranet/12_xarxes_socials/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

];

// Unir rutas base con rutas específicas de idioma
$routes = $routes + generateLanguageRoutes($base_routes, false);

return $routes;
