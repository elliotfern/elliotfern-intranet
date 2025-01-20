<?php

return [
    // API: Registre usuari / Login
    '/api/auth/login' => [
        'view' => 'app/api/00_auth/login.php',
        'needs_session' => false,
        'no_header_footer' => true,
    ],

    '/api/auth/registre' => [
        'view' => 'app/api/00_auth/registre.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    // API: Vault
    '/api/vault/get' => [
        'view' => 'app/api/10_vault/get-vault.php',
        'needs_session' => true,
        'no_header_footer' => true, // No incluir header/footer
    ],

    // API COMPTABILITAT ERP
    '/api/accounting/proxy' => [
        'view' => 'app/api/02_accounting/proxy.php',
        'needs_session' => false,
        'needs_autentication' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    '/api/accounting/get' => [
        'view' => 'app/api/02_accounting/accounting.php',
        'needs_session' => false,
        'needs_autentication' => true,
        'no_header_footer' => true, // No incluir header/footer
    ],

    '/api/accounting/post/invoice' => [
        'view' => 'app/api/02_accounting/customer-invoice-insert.php',
        'needs_session' => false,
        'needs_autentication' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    '/api/accounting/get/invoice-pdf/{id}' => [
        'view' => 'app/api/02_accounting/generate_pdf.php',
        'needs_session' => true,
        'no_header_footer' => true, // No incluir header/footer
    ],

    // 08. BIBLIOTECA
    '/api/biblioteca/get/autors' => [
        'view' => 'app/api/08_biblioteca_llibres/get-library.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    '/api/biblioteca/put' => [
        'view' => 'app/api/08_biblioteca_llibres/put-biblioteca.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    '/api/biblioteca/post' => [
        'view' => 'app/api/08_biblioteca_llibres/post-biblioteca.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    // BD CINEMA
    '/api/cinema/get' => [
        'view' => 'app/api/11_cinema/get-cinema.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    '/api/cinema/post' => [
        'view' => 'app/api/11_cinema/post-cinema.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    '/api/cinema/put' => [
        'view' => 'app/api/11_cinema/put-cinema.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    // BD AUXILIARS
    '/api/auxiliars/post/imatges' => [
        'view' => 'app/api/100_auxiliars/image-upload-process-form.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],

    // BD AUXILIARS
    '/api/auxiliars/get' => [
        'view' => 'app/api/100_auxiliars/get-auxiliars.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],





];
