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
    APP_GESTIO . $url['persones'] => APP_INTRANET_DIR . APP_PERSONES_DIR . 'index.php',
    APP_GESTIO . $url['persones'] . '/llistat-persones' => APP_INTRANET_DIR . APP_PERSONES_DIR . 'index.php',
    APP_GESTIO . $url['persones'] . '/nova-persona' => APP_INTRANET_DIR . APP_PERSONES_DIR . 'form-operacions-persona.php',
    APP_GESTIO . $url['persones'] . '/modifica-persona/{slug}' => APP_INTRANET_DIR . APP_PERSONES_DIR . 'form-operacions-persona.php',

    // 05. Programacio
    APP_GESTIO . $url['programacio'] => APP_INTRANET_DIR . APP_PROGRAMACIO_DIR . 'index.php',
    APP_GESTIO . $url['programacio'] . '/daw' => APP_INTRANET_DIR . APP_PROGRAMACIO_DIR . 'daw.php',
    APP_GESTIO . $url['programacio'] . '/links' => APP_INTRANET_DIR . APP_PROGRAMACIO_DIR . 'links.php',
    APP_GESTIO . $url['programacio'] . '/links/{id}' => APP_INTRANET_DIR . APP_PROGRAMACIO_DIR . 'links-detail.php',

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
    APP_GESTIO . $url['adreces'] => APP_INTRANET_DIR . APP_ADRECES_DIR . 'index.php',
    APP_GESTIO . $url['adreces'] . '/llistat-categories' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'llistat-categories.php',
    APP_GESTIO . $url['adreces'] . '/llistat-temes' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'llistat-temes.php',
    APP_GESTIO . $url['adreces'] . '/categoria/{id}' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'vista-categoria.php',
    APP_GESTIO . $url['adreces'] . '/tema/{id}' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'vista-tema.php',
    APP_GESTIO . $url['adreces'] . '/nou-link' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'modifica-link.php',
    APP_GESTIO . $url['adreces'] . '/modifica-link/{id}' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'modifica-link.php',

    // 10. Claus access
    APP_GESTIO . $url['vault'] => APP_INTRANET_DIR . APP_CLAUS_DIR . 'index.php',
    APP_GESTIO . $url['vault'] . '/nova-clau' => APP_INTRANET_DIR . APP_CLAUS_DIR . 'nova-contrasenya.php',

    // 11. Arts esceniques, cinema, televisio
    APP_GESTIO . $url['cinema'] => APP_INTRANET_DIR . APP_CINEMA_DIR . 'index.php',

    APP_GESTIO . $url['cinema'] . '/llistat-pelicules' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-pelicules.php',
    APP_GESTIO . $url['cinema'] . '/llistat-series' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-series.php',
    APP_GESTIO . $url['cinema'] . '/llistat-directors' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-directors.php',
    APP_GESTIO . $url['cinema'] . '/llistat-actors' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat.actors.php',
    APP_GESTIO . $url['cinema'] . '/llistat-obres-teatre' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-llistat-teatre.php',

    APP_GESTIO . $url['cinema'] . '/fitxa-actor/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-actor.php',
    APP_GESTIO . $url['cinema'] . '/fitxa-director{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-director.php',
    APP_GESTIO . $url['cinema'] . '/fitxa-pelicula/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-pelicula.php',
    APP_GESTIO . $url['cinema'] . '/fitxa-serie/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-serie.php',
    APP_GESTIO . $url['cinema'] . '/fitxa-teatre/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'vista-teatre.php',

    APP_GESTIO . $url['cinema'] . '/nova-pelicula' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-pelicula.php',
    APP_GESTIO . $url['cinema'] . '/modifica-pelicula/{id}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-pelicula.php',

    APP_GESTIO . $url['cinema'] . '/nova-serie' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-serie.php',
    APP_GESTIO . $url['cinema'] . '/modifica-serie/{id}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-serie.php',

    APP_GESTIO . $url['cinema'] . '/inserir-actor-pelicula/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-actor-pelicula.php',
    APP_GESTIO . $url['cinema'] . '/modifica-actor-pelicula/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-actor-pelicula.php',

    APP_GESTIO . $url['cinema'] . '/inserir-actor-serie/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-actor-serie.php',
    APP_GESTIO . $url['cinema'] . '/modifica-actor-serie/{slug}' => APP_INTRANET_DIR . APP_CINEMA_DIR . 'form-actor-serie.php',

    // 12. Xarxes socials
    APP_GESTIO . $url['xarxes'] =>  APP_INTRANET_DIR . APP_XARXES_DIR . 'index.php',
    APP_GESTIO . $url['xarxes'] . '/mastodon' => APP_INTRANET_DIR . APP_XARXES_DIR . 'lector-mastodon.php',
    APP_GESTIO . $url['xarxes'] . '/publica' => APP_INTRANET_DIR . APP_XARXES_DIR . 'nou-post.php',

    // 13. Blog
    APP_GESTIO . $url['blog'] => APP_INTRANET_DIR . APP_BLOG_DIR . 'index.php',
    APP_GESTIO . $url['blog'] . '/modifica-article/{id}' => APP_INTRANET_DIR . APP_BLOG_DIR . 'modifica-article.php',

    // 14. Lector rss
    APP_GESTIO . $url['rss'] => APP_INTRANET_DIR . APP_RSS_DIR . 'index.php',

    // 15. Història
    APP_GESTIO . $url['historia'] => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'index.php',
    APP_GESTIO . $url['historia'] . '/llistat-cursos' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'llistat-cursos.php',
    APP_GESTIO . $url['historia'] . '/llistat-organitzacions' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'llistat-organitzacions.php',
    APP_GESTIO . $url['historia'] . '/llistat-esdeveniments' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'llistat-esdeveniments.php',

    APP_GESTIO . $url['historia'] . '/fitxa-persona/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'fitxa-persona.php',
    APP_GESTIO . $url['historia'] . '/fitxa-politic/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'fitxa-politic.php',
    APP_GESTIO . $url['historia'] . '/fitxa-esdeveniment/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'fitxa-esdeveniment.php',
    APP_GESTIO . $url['historia'] . '/fitxa-organitzacio/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'fitxa-organitzacio.php',

    APP_GESTIO . $url['historia'] . '/nou-esdeveniment' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-esdeveniment.php',
    APP_GESTIO . $url['historia'] . '/modifica-esdeveniment/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-esdeveniment.php',

    APP_GESTIO . $url['historia'] . '/modifica-esdeveniment-persona/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-esdeveniment-persona.php',
    APP_GESTIO . $url['historia'] . '/modifica-esdeveniment-organitzacio/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-esdeveniment-organitzacio.php',
    APP_GESTIO . $url['historia'] . '/nou-carrec/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-persona-carrec.php',
    APP_GESTIO . $url['historia'] . '/modifica-persona-carrec/{id}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-persona-carrec.php',

    APP_GESTIO . $url['historia'] . '/modifica-organitzacio/{slug}' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-organitzacio.php',
    APP_GESTIO . $url['historia'] . '/nova-organitzacio' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-organitzacio.php',

    // 16. Auxiliars
    APP_GESTIO . $url['auxiliars'] => APP_INTRANET_DIR . APP_AUXILIARS_DIR . 'index.php',
    APP_GESTIO . $url['auxiliars'] . '/llistat-imatges' => APP_INTRANET_DIR . APP_AUXILIARS_DIR . 'imatges/llistat-imatges.php',

    APP_GESTIO . $url['auxiliars'] . '/nova-imatge' => APP_INTRANET_DIR . APP_AUXILIARS_DIR . 'imatges/form-inserir-imatge.php',

    // 17. Viatges
    APP_GESTIO . $url['viatges'] => APP_INTRANET_DIR . APP_VIATGES_DIR . 'index.php',
    APP_GESTIO . $url['viatges'] . '/llistat-viatges' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'llistat-viatges.php',
    APP_GESTIO . $url['viatges'] . '/fitxa-viatge/{slug}' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'fitxa-viatge.php',
    APP_GESTIO . $url['viatges'] . '/fitxa-espai/{slug}' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'fitxa-espai.php',

    APP_GESTIO . $url['viatges'] . '/modifica-espai/{slug}' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'form-espai.php',
    APP_GESTIO . $url['viatges'] . '/nou-espai' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'form-espai.php',
];

// Rutas principales sin idioma explícito (solo para el idioma por defecto)
$routes = [
    // 01. Homepage i acces intranet
    APP_GESTIO . '/entrada' => [
        'view' =>  APP_INTRANET_DIR . APP_HOMEPAGE_DIR . 'login.php',
        'needs_session' => false,
        'header_footer' => true,
        'header_menu_footer' => false,
        'apiSenseHTML' => false
    ],

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

    // 04. Base de dades persones
    APP_GESTIO . $url['persones'] => [
        'view' =>  APP_INTRANET_DIR . APP_PERSONES_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['persones'] . '/llistat-persones' => [
        'view' =>  APP_INTRANET_DIR . APP_PERSONES_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['persones'] . '/modifica-persona/{slug}' => [
        'view' =>  APP_INTRANET_DIR . APP_PERSONES_DIR . 'form-operacions-persona.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['persones'] . '/nova-persona' => [
        'view' =>  APP_INTRANET_DIR . APP_PERSONES_DIR . 'form-operacions-persona.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 05. Programacio
    APP_GESTIO . $url['programacio'] => [
        'view' => APP_INTRANET_DIR . APP_PROGRAMACIO_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['programacio'] . '/daw' => [
        'view' => APP_INTRANET_DIR . APP_PROGRAMACIO_DIR . 'daw.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['programacio'] . '/links' => [
        'view' => APP_INTRANET_DIR . APP_PROGRAMACIO_DIR . 'links.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['programacio'] . '/links/{id}' => [
        'view' => APP_INTRANET_DIR . APP_PROGRAMACIO_DIR . 'links-detail.php',
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

    // 07. Agenda contactes
    APP_GESTIO . $url['contactes'] => [
        'view' => APP_INTRANET_DIR . APP_CONTACTES_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 08. Biblioteca
    APP_GESTIO . $url['biblioteca'] => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['biblioteca'] . '/llistat-llibres' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llistat-llibres.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['biblioteca'] . '/llistat-autors' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llistat-autors.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['biblioteca'] . '/fitxa-llibre/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-llibre.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['biblioteca'] . '/fitxa-autor/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'vista-autor.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['biblioteca'] . '/modifica-llibre/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'form-modifica-llibre.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['biblioteca'] . '/nou-llibre' => [
        'view' => APP_INTRANET_DIR . APP_BIBLIOTECA_DIR . 'form-modifica-llibre.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 09. Adreces interes
    APP_GESTIO . $url['adreces'] => [
        'view' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['adreces'] . '/llistat-categories' => [
        'view' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'llistat-categories.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['adreces'] . '/llistat-temes' => [
        'view' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'llistat-temes.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['adreces'] . '/categoria/{id}' => [
        'view' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'vista-categoria.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['adreces'] . '/tema/{id}' => [
        'view' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'vista-tema.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['adreces'] . '/nou-link' => [
        'view' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'modifica-link.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['adreces'] . '/modifica-link/{id}' => [
        'view' => APP_INTRANET_DIR . APP_ADRECES_DIR . 'modifica-link.php',
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

    APP_GESTIO . $url['vault'] . '/nova-clau' => [
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

    // 12. Xarxes socials
    APP_GESTIO . $url['xarxes'] => [
        'view' => APP_INTRANET_DIR . APP_XARXES_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['xarxes'] . '/mastodon' => [
        'view' => APP_INTRANET_DIR . APP_XARXES_DIR . 'lector-mastodon.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['xarxes'] . '/publica' => [
        'view' => APP_INTRANET_DIR . APP_XARXES_DIR . 'nou-post.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 13. Blog
    APP_GESTIO . $url['blog'] => [
        'view' => APP_INTRANET_DIR . APP_BLOG_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['blog'] . '/modifica-article/{id}' => [
        'view' => APP_INTRANET_DIR . APP_BLOG_DIR . 'modifica-article.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 14. Lector rss
    APP_GESTIO . $url['rss'] => [
        'view' =>  APP_INTRANET_DIR . APP_RSS_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 15. Història
    APP_GESTIO . $url['historia'] => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/llistat-cursos' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'llistat-cursos.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/llistat-organitzacions' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'llistat-organitzacions.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/llistat-esdeveniments' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'llistat-esdeveniments.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/fitxa-persona/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'fitxa-persona.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/fitxa-politic/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'fitxa-politic.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/fitxa-esdeveniment/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'fitxa-esdeveniment.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/fitxa-organitzacio/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'fitxa-organitzacio.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/nou-esdeveniment' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-esdeveniment.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/modifica-esdeveniment/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-esdeveniment.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/modifica-esdeveniment-persona/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-esdeveniment-persona.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/modifica-esdeveniment-organitzacio/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-esdeveniment-organitzacio.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/nou-persona-carrec/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-persona-carrec.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/modifica-persona-carrec/{id}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-persona-carrec.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/modifica-organitzacio/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-organitzacio.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['historia'] . '/nova-organitzacio' => [
        'view' => APP_INTRANET_DIR . APP_HISTORIA_DIR . 'form-organitzacio.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 16. Auxiliars
    APP_GESTIO . $url['auxiliars'] => [
        'view' => APP_INTRANET_DIR . APP_AUXILIARS_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['auxiliars'] . '/llistat-imatges' => [
        'view' => APP_INTRANET_DIR . APP_AUXILIARS_DIR . 'llistat-imatges.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['auxiliars'] . '/nova-imatge' => [
        'view' => APP_INTRANET_DIR . APP_AUXILIARS_DIR . 'imatges/form-inserir-imatge.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    // 17. Viatges
    APP_GESTIO . $url['viatges'] => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'index.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['viatges'] . '/llistat-viatges' => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'llistat-viatges.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['viatges'] . '/fitxa-viatge/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'fitxa-viatge.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['viatges'] . '/fitxa-espai/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'fitxa-espai.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['viatges'] . '/modifica-espai/{slug}' => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'form-espai.php',
        'needs_session' => true,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => false,
        'menu_intranet' => true
    ],

    APP_GESTIO . $url['viatges'] . '/nou-espai' => [
        'view' => APP_INTRANET_DIR . APP_VIATGES_DIR . 'form-espai.php',
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
