<?php

return [
    '/auxiliars' => [
        'view' => 'app/Views/100_auxiliars/index.php',
        'needs_session' => true,
        'no_header_footer' => false,
    ],

    '/auxiliars/imatges/inserir' => [
        'view' => 'app/Views/100_auxiliars/imatges/form-inserir-imatge.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],
];
