<?php
require 'vendor/autoload.php';
require 'vendor/tecnickcom/tcpdf/tcpdf.php';

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="invoice_' . $idInvoice . '.pdf"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

// Datos de entrada
$idInvoice = $routeParams['id'];

$url = "https://gestio.elliotfern.com/api/accounting/get/?type=customers-invoices&id={$idInvoice}";

// segunda llamada a API
$url2 = "https://gestio.elliotfern.com/api/accounting/get/?type=invoice-products&id={$idInvoice}";

// Llamada a la API pasando el token y el ID de la factura
$invoiceData = hacerLlamadaAPI($url);

// Llamada a la API pasando el token y el ID de la factura
$productData = hacerLlamadaAPI($url2);

// Acceder al primer elemento si existe
$obj = $invoiceData ?? null; // El operador null coalescing asegura que no falle si no existe el índice

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
$facDate2 = $obj['facData'];
$facDate_net = date('d/m/Y', strtotime($facDate2));
$facDueDate2 = $obj['facDueDate'];
$facDueDate_net = date('d/m/Y', strtotime($facDueDate2));
$pagament = $obj['tipusNom'];
$idPayment = $obj['idPayment'];

$total = $obj['facTotal'];
$subTotal = $obj['facSubtotal'];
$facVAT = $obj['facVAT'];
$malt = $obj['facFees'];



// Acceder al primer elemento si existe
$arr2 = $productData ?? null; // El operador null coalescing asegura que no falle si no existe el índice

// comença la generacio del PDF

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

  // Page footer
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    // Custom footer text
    $this->Cell(0, 10, '<strong>Elliot Fernandez<br>Tax Reference Number: 9323971DA</strong>', 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

// Create a new TCPDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Set the document information
$pdf->SetCreator('Elliot Fernandez - HispanTIC');
$pdf->SetAuthor('Elliot Fernandez');
$pdf->SetTitle('Invoice PDF');

// Add a page
$pdf->AddPage('P', 'A4');

// Add the image to the PDF
$imagePath = "https://gestio.elliotfern.com/public/img/hispantic_logo.jpg";
// Especifica los valores sin unidades, por ejemplo, en milímetros (mm).
$pdf->Image($imagePath, $x = 17, $y = 10, $w = 70, $h = 0, $type = '', $link = '', $align = '', $resize = false, $dpi = 150, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false, $alt = '');

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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

$html = '<br><br><br><br><br>
<div class="container">
    <strong>Invoice Number: ' . $id_factura . '/' . $any . '</strong><br>
    Invoice Date: ' . $facDate_net . '<br>
    Invoice Due Date: ' . $facDueDate_net . '<br>
    Pay by: ' . $pagament . '
</div>';

$html .= '<div class="container">
  <table class="table">
          <thead>
          <tr>
            <th>
                <strong>Invoiced To:</strong><br>
                ' . $empresa . '<br>
                ATTN: ' . $nomClient . ' ' . $cognomsClient . '<br>
                Tax ID: ' . $nif . '<br>
                ' . $clientAdreca . '<br>
                ' . $ciutat . ', (' . $provincia . '), ' . $clientCP . '<br>
                ' . $pais . '
            </th>
            <th>
            <strong>HISPANTIC®</strong><br>
            Elliot Fernandez<br>
            Tax ID: 9323971DA<br>
        
            4 Meehan Court <br>
            Portlaoise, co. Laois<br>
            R32 F6YC<br>
            Ireland
            </th>
          </tr>
          </thead>
  </table>
</div>';

$html = $styles . $html;
$html .= '
<div class="container">
<h4 style="text-align: center;"><strong>INVOICE DETAILS</strong></h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr style="background-color: black; color: white;">
                    <th style="padding: 5px; border: 1px solid black;">Description</th>
                    <th style="padding: 5px; border: 1px solid black;">Total</th>
                </tr>
            </thead>
            <tbody>';

// Verificar si $arr2 es un array, si no lo es, lo convertimos en un array.
$arr2 = is_array($arr2) ? $arr2 : [$arr2]; // Si no es un array, lo convertimos en un array con un solo producto

foreach ($arr2 as $obj2) {
  $html .= '<tr>
                    <td style="padding: 5px; border: 1px solid black;">' . $obj2['product'] . ' ';
  if (!empty($obj2['notes'])) {
    $html .= '(' . $obj2['notes'] . ')';
  }
  $html .= '</td>
                    <td style="padding: 5px; border: 1px solid black;">€' . number_format($obj2['price'], 2, '.', ',') . '</td>
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
            <th scope="col">€' . number_format($subTotal, 2, '.', ',') . '</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <th scope="row">VAT</th>
            <td>';
if ($facVAT == 0) {
  $html .= '€0.00';
} else {
  $html .= number_format($facVAT, 2, '.', ',');
}
$html .= '</td>
          </tr>

          <tr>
            <th scope="row">Total</th>
            <td><strong>€' . number_format($total, 2, '.', ',') . '</strong></td>
          </tr>
  </table>
</div>';

if ($idPayment == 6) {
  $html .= '
  <div class="container">
  <h5 style="text-align: center;">PAID BY BANK TRANSFER</h5>
  <span style="text-align: center;"><strong>BANK: AIB Bank (Ireland)</strong><br>
  IBAN: IE80AIBK93356246103042<br>
  BIC-SWIFT: AIBKIE2D</span>
  </div>';
} elseif ($idPayment == 5) {
  $html .= '
  <div class="container">
  <h4 style="text-align: center;">PAID BY STRIPE (Credit/Debit Card)</h4>
  </div>';
} elseif ($idPayment == 2) {
  $html .= '
  <div class="container">
  <h4 style="text-align: center;">PAID BY BANK TRANSFER</h4>
  <span style="text-align: center;"><strong>BANK: N26 (Germany)</strong><br>
  IBAN: DE56100110012620403754<br>
  BIC-SWIFT: NTSBDEB1XXX</span>
  </div>';
}

// Establecer el espaciado vertical entre las celdas
$pdf->SetHtmlVSpace(array(0, 0, 0, 0));

// Agregar el contenido HTML a través de la función writeHTML()
$pdf->writeHTML($html, true, false, true, false, '');

// Limpiar el buffer de salida
ob_clean();
flush();

// Output the PDF as a downloadable file
$pdf->Output('invoice_' . $idInvoice . '.pdf', 'D');
