<?php

// Define las rutas base que quieres traducir
$base_routes = [
    // 00 Homepage - Entrada Pàgina login i homepage
    '/gestio/entrada' => 'public/intranet/00_homepage/login.php',
    '/gestio' => 'public/intranet/00_homepage/admin.php',
    '/gestio/admin' => 'public/intranet/00_homepage/admin.php',

    // 02. ERP comptabilitat
    '/gestio/erp' => 'public/intranet/02_erp_comptabilitat/index.php',
    '/gestio/erp/facturacio-clients' => 'public/intranet/02_erp_comptabilitat/erp-invoices-customers.php',
    '/gestio/erp/facturacio-clients/nova-factura' => 'public/intranet/02_erp_comptabilitat/erp-invoices-customers-new.php',

    // 03. CRM clients

    // 04. 

    // 05.

    // 06. Gestor projectes

    // 07. Agenda contactes
    '/gestio/agenda-contactes' => 'public/intranet/07_agenda_contactes/index.php',

    // 08 Biblioteca llibres
    '/gestio/biblioteca' => 'public/intranet/08_biblioteca_llibres/index.php',
    '/gestio/biblioteca/llibres' => 'public/intranet/08_biblioteca_llibres/books.php',
    '/gestio/biblioteca/autors' => 'public/intranet/08_biblioteca_llibres/authors.php',
    '/gestio/biblioteca/fitxa-llibre/{slug}' => 'public/intranet/08_biblioteca_llibres/vista-llibre.php',
    '/gestio/biblioteca/fitxa-autor/{slug}' => 'public/intranet/08_biblioteca_llibres/vista-autor.php',

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


    // XARXES SOCIALS
    '/gestio/xarxes-socials' => 'public/intranet/12_xarxes_socials/index.php',
    '/gestio/xarxes-socials/mastodon' => 'public/intranet/12_xarxes_socials/lector-mastodon.php',
    '/gestio/xarxes-socials/publica' => 'public/intranet/12_xarxes_socials/nou-post.php',

    // LECTOR RSS
    '/gestio/lector-rss' => 'public/intranet/14_lector_rss/index.php',

    // HISTORIA OBERTA GESTIO
    '/gestio/historia-oberta' => 'public/intranet/15_historia_oberta/index.php',
    '/gestio/historia-oberta/modifica-article/{id}' => 'public/intranet/15_historia_oberta/modifica-article.php',
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

    '/gestio/xarxes-socials/mastodon' => [
        'view' => 'public/intranet/12_xarxes_socials/lector-mastodon.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/xarxes-socials/publica' => [
        'view' => 'public/intranet/12_xarxes_socials/nou-post.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // LECTOR RSS
    '/gestio/lector-rss' => [
        'view' => 'public/intranet/14_lector_rss/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // HISTORIA OBERTA GESTIO
    '/gestio/historia-oberta' => [
        'view' => 'public/intranet/15_historia_oberta/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/historia-oberta/modifica-article/{id}' => [
        'view' => 'public/intranet/15_historia_oberta/modifica-article.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 07. Agenda contactes
    '/gestio/agenda-contactes' => [
        'view' => 'public/intranet/07_agenda_contactes/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 08 Biblioteca llibres
    '/gestio/biblioteca' => [
        'view' => 'public/intranet/08_biblioteca_llibres/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/biblioteca/llibres' => [
        'view' => 'public/intranet/08_biblioteca_llibres/books.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/biblioteca/autors' => [
        'view' => 'public/intranet/08_biblioteca_llibres/authors.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/biblioteca/fitxa-llibre/{slug}' => [
        'view' => 'public/intranet/08_biblioteca_llibres/vista-llibre.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/biblioteca/fitxa-autor/{slug}' => [
        'view' => 'public/intranet/08_biblioteca_llibres/vista-autor.php',
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
