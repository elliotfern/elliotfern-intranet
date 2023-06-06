<?php
# conectare la base de datos

if (isset($_GET['id']) ) {
    $id = $_GET['id'];
}

$url = APP_SERVER . "/controller/control/route.php?type=customers-invoices&id=" . $id;

echo '<div class="container">';
echo '<h1>HispanTIC - Elliot Fernandez - Accounting & CRM</h1>';
echo '<h2>ERP - Invoice info</h2>';

//call api

//read json file from url in php

$input = file_get_contents($url);

$arr = json_decode($input, true);
$obj = $arr[0];
echo "Id factura: " . $obj['id'] . "/" . $obj['yearInvoice']; // Output: 31


/*
"num": "31",
	"idUser": 38,
	"facConcepte": "Nova web",
	"facData": "2023-02-17",
	"yearInvoice": 2023,
	"facDueDate": "2023-02-17",
	"facSubtotal": 835,
	"facFees": 0,
	"facTotal": 835,
	"facVAT": 0,
	"facIva": 3,
	"facEstat": 1,
	"facPaymentType": 2,
	"ivaPercen": 0,
	"estat": "Pending",
	"tipusNom": "Bank A\/C (N26) Elliot Fernandez",
	"clientNom": "Gabriel",
	"clientCognoms": "Perez Turon",
	"clientEmpresa": ""
*/
# footer
include_once(APP_ROOT. '/inc/control/footer.php');