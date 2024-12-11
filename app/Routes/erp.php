<?php

return [
    '/erp' => [
        'view' => 'app/Views/02_erp_comptabilitat/index.php',
        'needs_session' => true,
        'no_header_footer' => false,
    ],

    '/erp/facturacio-clients' => [
        'view' => 'app/Views/02_erp_comptabilitat/erp-invoices-customers.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],
];
