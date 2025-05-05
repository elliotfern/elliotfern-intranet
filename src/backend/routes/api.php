<?php
$base_routes = [
    // API INTRANET
    '/api/auth/login' => 'src/backend/api/00_auth/login.php',
    '/api/auth/registre' => 'src/backend/api/00_auth/registre.php',
    '/api/vault/get' => 'src/backend/api/10_vault/get-vault.php',

    '/api/accounting/get' => 'src/backend/api/02_accounting/accounting.php',
    '/api/accounting/post/invoice' => 'src/backend/api/02_accounting/customer-invoice-insert.php',
    '/api/accounting/get/invoice-pdf/{id}' => 'src/backend/api/02_accounting/generate_pdf.php',

    '/api/biblioteca/get' => 'src/backend/api/08_biblioteca_llibres/get-library.php',
    '/api/biblioteca/put' => 'src/backend/api/08_biblioteca_llibres/put-biblioteca.php',
    '/api/biblioteca/post' => 'src/backend/api/08_biblioteca_llibres/post-biblioteca.php',

    '/api/cinema/get' => 'src/backend/api/11_cinema/get-cinema.php',
    '/api/cinema/post' => 'src/backend/api/11_cinema/post-cinema.php',
    '/api/cinema/put' => 'src/backend/api/11_cinema/put-cinema.php',

    '/api/auxiliars/post/imatges' => 'src/backend/api/100_auxiliars/image-upload-process-form.php',
    '/api/auxiliars/get' => 'src/backend/api/100_auxiliars/get-auxiliars.php',

    '/api/xarxes-socials/post/bluesky' => 'src/backend/api/12_xarxes_socials/post-bluesky.php',

    '/api/xarxes-socials/get/mastodont' => 'src/backend/api/12_xarxes_socials/get-mastodon.php',
    '/api/xarxes-socials/post/mastodont' => 'src/backend/api/12_xarxes_socials/post-mastodont.php',
    '/api/xarxes-socials/post/likes-mastodont' => 'src/backend/api/12_xarxes_socials/post-like-mastodont.php',

    '/api/xarxes-socials/post/blog' => 'src/backend/api/12_xarxes_socials/post-blog.php',
    '/api/xarxes-socials/post/linkedin' => 'src/backend/api/12_xarxes_socials/post-linkedin.php',

    '/api/lector-rss/get' => 'src/backend/api/14_lector_rss/get-lector.php',

    '/api/sitemap/get' => 'src/backend/api/15_sitemap/get-sitemap.php',

    // HISTORIA OBERTA
    '/api/historia/get' => 'src/backend/api/16_historia_oberta/get-historia.php',
    '/api/historia/post' => 'src/backend/api/16_historia_oberta/post-historia.php',
    '/api/historia/put' => 'src/backend/api/16_historia_oberta/put-historia.php',

    // AGENDA CONTACTES
    '/api/contactes/get' => 'src/backend/api/contactes/get-contactes.php',

    // 09. Adreces interes
    '/api/adreces/get' => 'src/backend/api/09_adreces/get-link.php',
    '/api/adreces/post' => 'src/backend/api/09_adreces/post-link.php',
    '/api/adreces/put' => 'src/backend/api/09_adreces/put-link.php',

    // 04- Persones
    '/api/persones/get' => 'src/backend/api/04_persones/get-persones.php',


];

// Rutas principales sin idioma explícito (solo para el idioma por defecto)
$routes = [
    // API: Registre usuari / Login
    '/api/auth/login' => [
        'view' => 'src/backend/api/00_auth/login.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/auth/registre' => [
        'view' => 'src/backend/api/00_auth/registre.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // API: Vault
    '/api/vault/get' => [
        'view' => 'src/backend/api/10_vault/get-vault.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // API COMPTABILITAT ERP
    '/api/accounting/proxy' => [
        'view' => 'src/backend/api/02_accounting/proxy.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/accounting/get' => [
        'view' => 'src/backend/api/02_accounting/accounting.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/accounting/post/invoice' => [
        'view' => 'src/backend/api/02_accounting/customer-invoice-insert.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/accounting/get/invoice-pdf/{id}' => [
        'view' => 'src/backend/api/02_accounting/generate_pdf.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // 08. BIBLIOTECA
    '/api/biblioteca/get' => [
        'view' => 'src/backend/api/08_biblioteca_llibres/get-library.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/biblioteca/put' => [
        'view' => 'src/backend/api/08_biblioteca_llibres/put-biblioteca.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/biblioteca/post' => [
        'view' => 'src/backend/api/08_biblioteca_llibres/post-biblioteca.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // BD CINEMA
    '/api/cinema/get' => [
        'view' => 'src/backend/api/11_cinema/get-cinema.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/cinema/post' => [
        'view' => 'src/backend/api/11_cinema/post-cinema.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/cinema/put' => [
        'view' => 'src/backend/api/11_cinema/put-cinema.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // BD AUXILIARS
    '/api/auxiliars/post/imatges' => [
        'view' => 'src/backend/api/100_auxiliars/image-upload-process-form.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // BD AUXILIARS
    '/api/auxiliars/get' => [
        'view' => 'src/backend/api/100_auxiliars/get-auxiliars.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // XARXES SOCIALS
    '/api/xarxes-socials/post/bluesky' => [
        'view' => 'src/backend/api/12_xarxes_socials/post-bluesky.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/xarxes-socials/get/mastodont' => [
        'view' => 'src/backend/api/12_xarxes_socials/get-mastodon.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/xarxes-socials/post/mastodont' => [
        'view' => 'src/backend/api/12_xarxes_socials/post-mastodont.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/xarxes-socials/post/likes-mastodont' => [
        'view' => 'src/backend/api/12_xarxes_socials/post-like-mastodont.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/xarxes-socials/post/blog' => [
        'view' => 'src/backend/api/12_xarxes_socials/post-blog.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // LECTOR RSS
    '/api/lector-rss/get' => [
        'view' => 'src/backend/api/14_lector_rss/get-lector.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // SITEMAP
    '/api/sitemap/get' => [
        'view' => 'src/backend/api/15_sitemap/get-sitemap.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // HISTORIA OBERTA
    '/api/historia/get' => [
        'view' => 'src/backend/api/16_historia_oberta/get-historia.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/historia/post' => [
        'view' => 'src/backend/api/16_historia_oberta/post-historia.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/historia/put' => [
        'view' => 'src/backend/api/16_historia_oberta/put-historia.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // AGENDA CONTACTES
    '/api/contactes/get' => [
        'view' => 'src/backend/api/contactes/get-contactes.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // 09. Adreces interes
    '/api/adreces/get' => [
        'view' => 'src/backend/api/09_adreces/get-link.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/adreces/post' => [
        'view' => 'src/backend/api/09_adreces/post-link.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    '/api/adreces/put' => [
        'view' => 'src/backend/api/09_adreces/put-link.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],

    // 04. Persones
    '/api/persones/get' => [
        'view' => 'src/backend/api/04_persones/get-persones.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],


];

// Unir rutas base con rutas específicas de idioma
$routes = $routes + generateLanguageRoutes($base_routes, false);

return $routes;
