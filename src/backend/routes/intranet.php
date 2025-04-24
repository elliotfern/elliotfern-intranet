<?php

// Define las rutas base que quieres traducir
$base_routes = [
    // 01. Homepage - Entrada Pàgina login i homepage
    APP_GESTIO . '/entrada' => APP_INTRANET_DIR . APP_HOMEPAGE_DIR . 'login.php',
    APP_GESTIO . '/' => APP_INTRANET_DIR . APP_HOMEPAGE_DIR . 'admin.php',
    APP_GESTIO . '/admin' => APP_INTRANET_DIR . APP_HOMEPAGE_DIR . 'admin.php',

    // 02. Comptabilitat
    APP_GESTIO . $url['comptabilitat'] => APP_INTRANET_DIR . APP_COMPTABILITAT_DIR . 'index.php',
    APP_GESTIO . $url['comptabilitat'] . '/facturacio-clients' => APP_INTRANET_DIR . APP_COMPTABILITAT_DIR . 'erp-invoices-customers.php',
    APP_GESTIO . $url['comptabilitat'] . '/facturacio-clients/nova-factura' => APP_INTRANET_DIR . APP_COMPTABILITAT_DIR . 'erp-invoices-customers-new.php',

    // 03. Clients
    APP_GESTIO . $url['clients']  => APP_INTRANET_DIR . APP_CLIENTS_DIR . 'index.php',

    // 04. Base dades Persones
    APP_GESTIO . $url['persones'] . '/nova-persona' => APP_INTRANET_DIR . APP_PERSONES_DIR . 'form-operacions-persona.php',
    APP_GESTIO . $url['persones'] . '/modifica-persona/{slug}' => APP_INTRANET_DIR . APP_PERSONES_DIR . 'form-operacions-persona.php',

    // 05.

    // 06. Gestor projectes
    APP_GESTIO . $url['projectes'] => APP_INTRANET_DIR . APP_PROJECTES_DIR . 'index.php',

    // 07. Agenda contactes
    APP_GESTIO . $url['contactes'] => APP_INTRANET_DIR . APP_CONTACTES_DIR . 'index.php',

    // 08. Biblioteca llibres
    APP_GESTIO . $url['biblioteca'] => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'index.php',
    APP_GESTIO . $url['biblioteca'] . '/llistat-llibres' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llistat-llibres.php',
    APP_GESTIO . $url['biblioteca'] . '/llistat-autors' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llistat-autors.php',
    APP_GESTIO . $url['biblioteca']  . '/fitxa-llibre/{slug}' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llibre.php',
    APP_GESTIO . $url['biblioteca'] . '/fitxa-autor/{slug}' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-autor.php',
    APP_GESTIO . $url['biblioteca'] . '/modifica-llibre/{slug}' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR .  'form-modifica-llibre.php',
    APP_GESTIO . $url['biblioteca'] . '/nou-llibre' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'form-modifica-llibre.php',

    // 09. Adreces interes
    '/gestio/adreces' => 'public/intranet/09_adreces_interes/index.php',
    '/gestio/adreces/llistat-categories' => 'public/intranet/09_adreces_interes/llistat-categories.php',
    '/gestio/adreces/llistat-temes' => 'public/intranet/09_adreces_interes/llistat-temes.php',
    '/gestio/adreces/categoria/{id}' => 'public/intranet/09_adreces_interes/vista-categoria.php',
    '/gestio/adreces/tema/{id}' => 'public/intranet/09_adreces_interes/vista-tema.php',
    '/gestio/adreces/nou-link' => 'public/intranet/09_adreces_interes/modifica-link.php',
    '/gestio/adreces/modifica-link/{id}' => 'public/intranet/09_adreces_interes/modifica-link.php',

    // VAULT
    '/gestio/vault' => 'public/intranet/10_claus_acces/index.php',
    '/gestio/vault/elliot' => 'public/intranet/10_claus_acces/vault-elliot.php',
    '/gestio/vault/nova' => 'public/intranet/10_claus_acces/nova-contrasenya.php',

    // 11. Arts esceniques, cinema, televisio
    '/gestio/cinema' => 'public/intranet/11_cinema_series/index.php',

    '/gestio/cinema/llistat-pelicules' => 'public/intranet/11_cinema_series/vista-llistat-pelicules.php',
    '/gestio/cinema/llistat-series' => 'app/Views/11_cinema_series/vista-llistat-series.php',
    '/gestio/cinema/llistat-directors' => 'public/intranet/11_cinema_series/vista-llistat-directors.php',
    '/gestio/cinema/llistat-actors' => 'public/intranet/11_cinema_series/vista-llistat.actors.php',
    '/gestio/cinema/llistat-obres-teatre' => 'public/intranet/11_cinema_series/vista-llistat-teatre.php',

    '/gestio/cinema/fitxa-actor/{slug}' => 'public/intranet/11_cinema_series/vista-actor.php',
    '/gestio/cinema/fitxa-director{slug}' => 'public/intranet/11_cinema_series/vista-director.php',
    '/gestio/cinema/fitxa-pelicula/{slug}' => 'public/intranet/11_cinema_series/vista-pelicula.php',
    '/gestio/cinema/fitxa-serie/{slug}' => 'public/intranet/11_cinema_series/vista-serie.php',
    '/gestio/cinema/fitxa-teatre/{slug}' => 'public/intranet/11_cinema_series/vista-teatre.php',

    '/gestio/cinema/nova-pelicula' => 'public/intranet/11_cinema_series/form-pelicula.php',
    '/gestio/cinema/modifica-pelicula/{id}' => 'public/intranet/11_cinema_series/form-pelicula.php',

    '/gestio/cinema/nova-serie' => 'public/intranet/11_cinema_series/form-serie.php',
    '/gestio/cinema/modifica-serie/{id}' => 'public/intranet/11_cinema_series/form-serie.php',

    '/gestio/cinema/inserir-actor-pelicula/{slug}' => 'public/intranet/11_cinema_series/form-actor-pelicula.php',
    '/gestio/cinema/modifica-actor-pelicula/{slug}' => 'public/intranet/11_cinema_series/form-actor-pelicula.php',

    '/gestio/cinema/inserir-actor-serie/{slug}' => 'public/intranet/11_cinema_series/form-actor-serie.php',
    '/gestio/cinema/modifica-actor-serie/{slug}' => 'public/intranet/11_cinema_series/form-actor-serie.php',

    // XARXES SOCIALS
    '/gestio/xarxes-socials' => 'public/intranet/12_xarxes_socials/index.php',
    '/gestio/xarxes-socials/mastodon' => 'public/intranet/12_xarxes_socials/lector-mastodon.php',
    '/gestio/xarxes-socials/publica' => 'public/intranet/12_xarxes_socials/nou-post.php',

    // LECTOR RSS
    '/gestio/lector-rss' => 'public/intranet/14_lector_rss/index.php',

    // HISTORIA OBERTA GESTIO
    '/gestio/historia-oberta' => 'public/intranet/15_historia_oberta/index.php',
    '/gestio/historia-oberta/modifica-article/{id}' => 'public/intranet/15_historia_oberta/modifica-article.php',

    // 100. Auxiliars
    '/gestio/auxiliars' => 'public/intranet/100_auxiliars/index.php',
    '/gestio/auxiliars/nova-imatge' => 'public/intranet/100_auxiliars/imatges/form-inserir-imatge.php',
];

// Rutas principales sin idioma explícito (solo para el idioma por defecto)
$routes = [
    // ACCES SECCIO GESTIO
    APP_GESTIO . '/entrada' => [
        'view' =>  APP_INTRANET_DIR . APP_HOMEPAGE_DIR . 'login.php',
        'needs_session' => false,
        'header_footer' => true,
        'header_menu_footer' => false,
        'apiSenseHTML' => false
    ],

    // 00. Homepage
    APP_GESTIO => [
        'view' =>  APP_INTRANET_DIR . APP_HOMEPAGE_DIR . 'admin.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . '/admin' => [
        'view' =>  APP_INTRANET_DIR . APP_HOMEPAGE_DIR . 'admin.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 02. Comptabilitat
    APP_GESTIO . $url['comptabilitat'] => [
        'view' => APP_INTRANET_DIR . APP_COMPTABILITAT_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['comptabilitat'] . '/facturacio-clients' => [
        'view' => APP_INTRANET_DIR . APP_COMPTABILITAT_DIR . 'erp-invoices-customers.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['comptabilitat'] . '/facturacio-clients/nova-factura' => [
        'view' => APP_INTRANET_DIR . APP_COMPTABILITAT_DIR . 'erp-invoices-customers-new.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 03. Clients
    APP_GESTIO . $url['clients'] => [
        'view' => APP_INTRANET_DIR . APP_CLIENTS_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 06. Gestor projectes
    APP_GESTIO . $url['projectes'] => [
        'view' => APP_INTRANET_DIR . APP_PROJECTES_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 10. Claus acces
    APP_GESTIO . $url['vault'] => [
        'view' => APP_INTRANET_DIR . APP_CLAUS_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['vault'] . '/nova' => [
        'view' => APP_INTRANET_DIR . APP_CLAUS_DIR . 'nova-contrasenya.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 11. Cinema i televisió
    APP_GESTIO . $url['cinema'] => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/llistat-pelicules' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-pelicules.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/llistat-series' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-series.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/llistat-directors' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-directors.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/llistat-actors' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-actors.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/llistat-obres-teatre' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-teatre.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/fitxa-pelicula/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-pelicula.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/fitxa-actor/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-actor.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/fitxa-director/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-director.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/fitxa-serie/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-serie.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/nova-pelicula' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-pelicula.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/modifica-pelicula/{id}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-pelicula.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/nova-serie' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-serie.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] .  '/modifica-serie/{id}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-serie.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/inserir-actor-pelicula/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-actor-pelicula.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/modifica-actor-pelicula/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-actor-pelicula.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/inserir-actor-serie/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-actor-serie.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['cinema'] . '/modifica-actor-serie/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-actor-serie.php',
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

    '/gestio/biblioteca/llistat-llibres' => [
        'view' => 'public/intranet/08_biblioteca_llibres/vista-llistat-llibres.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/biblioteca/llistat-autors' => [
        'view' => 'public/intranet/08_biblioteca_llibres/vista-llistat-autors.php',
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

    '/gestio/biblioteca/modifica-llibre/{slug}' => [
        'view' => 'public/intranet/08_biblioteca_llibres/form-modifica-llibre.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/biblioteca/nou-llibre' => [
        'view' => 'public/intranet/08_biblioteca_llibres/form-modifica-llibre.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],


    // 09. Adreces interes
    '/gestio/adreces' => [
        'view' => 'public/intranet/09_adreces_interes/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],


    '/gestio/adreces/llistat-categories' => [
        'view' => 'public/intranet/09_adreces_interes/llistat-categories.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/adreces/llistat-temes' => [
        'view' => 'public/intranet/09_adreces_interes/llistat-temes.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/adreces/categoria/{id}' => [
        'view' => 'public/intranet/09_adreces_interes/vista-categoria.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/adreces/tema/{id}' => [
        'view' => 'public/intranet/09_adreces_interes/vista-tema.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/adreces/nou-link' => [
        'view' => 'public/intranet/09_adreces_interes/modifica-link.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/adreces/modifica-link/{id}' => [
        'view' => 'public/intranet/09_adreces_interes/modifica-link.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 04. DB Persones
    '/gestio/persona/modifica-persona/{slug}' => [
        'view' => 'public/intranet/04_persones/form-operacions-persona.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/persona/nova-persona' => [
        'view' => 'public/intranet/04_persones/form-operacions-persona.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 100. Auxiliars
    '/gestio/auxiliars' => [
        'view' => 'public/intranet/100_auxiliars/index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    '/gestio/auxiliars/nova-imatge' => [
        'view' => 'public/intranet/100_auxiliars/imatges/form-inserir-imatge.php',
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
