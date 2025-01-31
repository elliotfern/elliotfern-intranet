<?php
$base_routes = [
    // API INTRANET
    '/api/auth/login' => 'src/backend/api/00_auth/login.php',
    '/api/auth/registre' => 'src/backend/api/00_auth/registre.php',
    '/api/vault/get' => 'src/backend/api/10_vault/get-vault.php',
    '/api/accounting/get' => 'src/backend/api/02_accounting/accounting.php',
    '/api/accounting/post/invoice' => 'src/backend/api/02_accounting/customer-invoice-insert.php',
    '/api/accounting/get/invoice-pdf/{id}' => 'src/backend/api/02_accounting/generate_pdf.php',
    '/api/biblioteca/get/autors' => 'src/backend/api/08_biblioteca_llibres/get-library.php',
    '/api/biblioteca/put' => 'src/backend/api/08_biblioteca_llibres/put-biblioteca.php',
    '/api/biblioteca/post' => 'src/backend/api/08_biblioteca_llibres/post-biblioteca.php',
    '/api/cinema/get' => 'src/backend/api/11_cinema/get-cinema.php',
    '/api/cinema/post' => 'src/backend/api/11_cinema/post-cinema.php',
    '/api/cinema/put' => 'src/backend/api/11_cinema/put-cinema.php',
    '/api/auxiliars/post/imatges' => 'src/backend/api/100_auxiliars/image-upload-process-form.php',
    '/api/auxiliars/get' => 'src/backend/api/100_auxiliars/get-auxiliars.php',

    '/api/xarxes-socials/post/bluesky' => 'src/backend/api/12_xarxes_socials/post-bluesky.php',
    '/api/xarxes-socials/post/mastodont' => 'src/backend/api/12_xarxes_socials/post-mastodont.php',
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
    '/api/biblioteca/get/autors' => [
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

    '/api/xarxes-socials/post/mastodont' => [
        'view' => 'src/backend/api/12_xarxes_socials/post-mastodont.php',
        'needs_session' => false,
        'header_footer' => false,
        'header_menu_footer' => false,
        'apiSenseHTML' => true
    ],


];

// Unir rutas base con rutas específicas de idioma
$routes = $routes + generateLanguageRoutes($base_routes, false);

return $routes;
