<?php

$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
require_once($rootDirectory . '/vendor/tcpdf/tcpdf.php');

if(isset($params['id'])){
    $id = $params['id'];
}

// Retrieve the invoice ID from the query parameters
$idInvoice = $id;

//call api
$url = APP_SERVER . "/controller/control/route.php?type=customers-invoices&id=" .$idInvoice;
$input = file_get_contents($url);
$arr = json_decode($input, true);
$obj = $arr[0];

$id_factura = $obj['id'];
$empresa = $obj['clientEmpresa'];
$nomClient = $obj['clientNom'];
$cognomsClient = $obj['clientCognoms'];
$clientAdreca = $obj['clientAdreca'];
$ciutat = $obj['clientCiutat'];
$provincia = $obj['clientProvincia'];
$pais = $obj['clientPais'];
$nif = $obj['clientNIF'];
$clientEmail = $obj['clientEmail'];
$clientWeb = $obj['clientWeb'];
$clientCP = $obj['clientCP'];
$any = $obj['yearInvoice'];
$date2 = $obj['id'];
$facDueDate2 = $obj['facDueDate'];
$facDueDate_net = date('d/m/Y', strtotime($facDueDate2));
$pagament = $obj['tipusNom'];
$idPayment = $obj['idPayment'];

$total = $obj['facTotal'];
$subTotal = $obj['facSubtotal'];
$facVAT = $obj['facVAT'];
$malt = $obj['facFees'];

$url2 = APP_SERVER . "/controller/control/route.php?type=invoice-products&id=" . $idInvoice;
//call api
$input2 = file_get_contents($url2);
$arr2 = json_decode($input2, true);

// Use the $idInvoice to fetch the necessary data for the PDF generation
// ... (code to fetch invoice data)

// Create a new TCPDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Set the document information
$pdf->SetCreator('Elliot Fernandez - HispanTIC');
$pdf->SetAuthor('Elliot Fernandez');
$pdf->SetTitle('Invoice PDF');

// Add a page
$pdf->AddPage();

// Add the image to the PDF
$imagePath = APP_SERVER . '/inc/img/hispantic_logo.jpg';
$pdf->Image($imagePath, $x = 10, $y = 10, $w = 100, $h = 0, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false, $alt = '');

// Write HTML content to the PDF

// Agregar estilos CSS para la tabla
$styles = '<style>
            .table-custom thead tr {
                background-color: black;
                color: white;
            }

            .table,
            .table th,
            .table td {
                padding: 5px;
                border: 1px solid black;
            }
          </style>';
          
$html = '
<br><br><br><br><br><br><br>
<div class="container">
<strong>Invoice Number: '.$id_factura.'/'.$any.'</strong><br>
Invoice Date: '.$facDueDate_net.'<br>
Pay by: '.$pagament.'
</div>';

$html .= '<div class="container">
  <table class="table">
          <thead>
          <tr>
            <th>
                <strong>Invoiced To:</strong><br>
                '.$empresa.'<br>
                ATTN: '.$nomClient.' '.$cognomsClient.'<br>
                Tax ID: '.$nif.'<br>
                '.$clientAdreca.'<br>
                '.$ciutat.', ('.$provincia.'), '.$clientCP.'<br>
                '.$pais.'
            </th>
            <th>
            <strong>HISPANTIC®</strong><br>
            Elliot Fernandez<br>
            Tax ID: 9323971DA<br>
        
            Apartment 5, The Court, <br>
            The Paddocks Road<br>
            Lucan, co. Dublin<br>
            Ireland
            </th>
          </tr>
          </thead>
  </table>
</div>';

$html = $styles . $html;
$html .= '
<div class="container">
<h2 style="text-align: center;"><strong>INVOICE DETAILS</strong></h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr style="background-color: black; color: white;">
                    <th style="padding: 5px; border: 1px solid black;">Description</th>
                    <th style="padding: 5px; border: 1px solid black;">Total</th>
                </tr>
            </thead>
            <tbody>';

foreach ($arr2 as $obj2) {
    $html .= '<tr>
                    <td style="padding: 5px; border: 1px solid black;">' . $obj2['product'] . ' (' . $obj2['notes'] . ')</td>
                    <td style="padding: 5px; border: 1px solid black;">€' . $obj2['price'] . '</td>
               </tr>';
}

$html .= '</tbody>                       
        </table>
    </div>
</div>';

$html .= '<div class="container">
  <table class="table">
          <thead>
          <tr>
            <th scope="col">Sub Total</th>
            <th scope="col">€'.$subTotal.'</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <th scope="row">VAT</th>
            <td>';
if ($facVAT == 0) {
    $html .= '€0.00';
} else {
    $html .= $facVAT;
}
$html .= '</td>
          </tr>

          <tr>
            <th scope="row">Total</th>
            <td>€'.$total.'</td>
          </tr>
  </table>
</div>';

if ($idPayment == 6) {
    $html .= '
  <div class="container">
  <h2 style="text-align: center;">PAID BY BANK TRANSFER</h2>
  <span style="text-align: center;"><strong>BANK: AIB Bank (Ireland)</strong><br>
  IBAN: IE80AIBK93356246103042<br>
  BIC-SWIFT: AIBKIE2D</span>
  </div>';
} elseif ($idPayment == 5) {
  $html .= '
  <div class="container">
  <h2 style="text-align: center;">PAID BY STRIPE (Credit/Debit Card)</h2>
  </div>';
} elseif ($idPayment == 2) {
  $html .= '
  <div class="container">
  <h2 style="text-align: center;">PAID BY BANK TRANSFER</h2>
  <span style="text-align: center;"><strong>BANK: N26 (Germany)</strong><br>
  IBAN: DE56100110012620403754<br>
  BIC-SWIFT: NTSBDEB1XXX</span>
  </div>';
}

$html .= '<hr>
<h6 style="text-align: center;">
<strong>Elliot Fernandez<br>
Tax Reference Number: 9323971DA</strong></h2>';

// Establecer el espaciado vertical entre las celdas
$pdf->SetHtmlVSpace(array(0, 0, 0, 0));

// Agregar el contenido HTML a través de la función writeHTML()
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF as a downloadable file
$pdf->Output('invoice_'.$idInvoice.'.pdf', 'D');

?>