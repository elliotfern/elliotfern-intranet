<?php

// Proxy
// ruta => api/auth/?type=user&id=1&token="

if (isset($_GET['type']) && $_GET['type'] == 'factures-clients') {

    $token = proxyRequestAPI();

    if ($token) {
        // segunda llamada a API
        $url = "https://gestio.elliotfern.com/api/accounting/get/?type=accounting-elliotfernandez-customers-invoices";

        // Llamada a la API pasando el token y el ID de la factura
        $data = hacerLlamadaAPI($url);

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
