<?php

return [
    '/vault' => [
        'view' => 'app/Views/10_claus_acces/vault-elliot.php',
        'needs_session' => true,
        'no_header_footer' => false,
    ],

    '/vault/nova' => [
        'view' => 'app/Views/10_claus_acces/nova-contrasenya.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],
];