<?php
if (isset($_POST['idInvoice'])) {
    $idInvoice = $_POST['idInvoice'];
} else {
    $idInvoice = $_POST['idInvoice'];
}

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
$pagament = $obj['tipusNom'];

$total = $obj['facTotal'];
$subTotal = $obj['facSubtotal'];
$facVAT = $obj['facVAT'];
$malt = $obj['facFees'];

$url2 = APP_SERVER . "/controller/control/route.php?type=invoice-products&id=" . $idInvoice;
//call api
$input2 = file_get_contents($url2);
$arr2 = json_decode($input2, true);

echo '<div class="container-fluid">';

 //* -------------- FACTURA - DETALLS ----------------------- *//
 echo "<div class='container'>";
 echo '<div class="row">';
 
     echo '<div class="col-sm">'; // Customer info
     echo '<h4><strong>Invoiced To</strong></h4>
           <h6>'.$empresa.'</h6>
           <h6>ATTN: '.$nomClient.' '.$cognomsClient.'</h6>
           <h6>'.$clientAdreca.'</h6>
           <h6>'.$ciutat.', '.$provincia.', '.$clientCP.' </h6>
           <h6>'.$pais.'</h6>
           <h6>Tax ID: '.$nif.'</h6>';
     echo '</div>';

     echo '<div class="col-sm">'; // invoice info
     echo '<table class="table table-bordered">
             <thead>
             <tr>
               <th scope="col">Invoice No.</th>
               <th scope="col">'.$id_factura.'/'.$any.'</th>
             </tr>
             </thead>
             <tbody>

             <tr>
               <th scope="row">Invoice Date</th>
               <td>'.$date2.'</td>
             </tr>

              <tr>
               <th scope="row">Due Date</th>
               <td>'.$facDueDate2.'</td>
             </tr>

             <tr>
               <th scope="row">Pay by</th>
               <td>'.$pagament.'</td>
             </tr>

     </table>';
     echo '</div>';

 echo '</div>';
echo '</div>';

 /* -------------- PRODUCTES DETALLS-----------------------
 invoice
product
notes
price
*/

     echo "<div class='container' style='margin-top:20px;margin-bottom:25px'>";
     echo "<div class='".TABLE_DIV_CLASS."'>";
     echo "<table class='".TABLE_CLASS."'>";
     echo "<thead class='".TABLE_THREAD."'>
             <th>Description</th>
             <th>Total</th>
             </tr>
             </thead>
             <tbody>";
             foreach ($arr2 as $obj2) {
         echo "<tr>";
         echo "<td>".$obj2['product']." ";
         if (!empty($obj2['notes'])) {
          echo '(' . $obj2['notes'] . ')';
      }
         echo "</td>";
         echo "<td>€".$obj2['price']."</td>";
         echo "</tr>";
        }
         echo "</tbody>";                            
         echo "</table>";
         echo "</div></div>";

//* -------------- TOTALS ----------------------- *//
echo '<div class="container">
<div class="row justify-content-end">
  <div class="col-4">
      <table class="table table-bordered">
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
                  echo '€0.00';
                } else {
                  echo ''.$facVAT.'';
                }
              echo '</td>
              </tr>';

              if (!empty($malt)) {
              echo '<tr>
                <th scope="row">Fees pay to STRIPE</th>
                <td>€-'.$malt.'</td>
              </tr>';
              }

              echo '<tr>
                <th scope="row">Total</th>
                <td>€'.$total.'</td>
              </tr>

      </table>
  </div>
</div>
</div>';

echo '</div">';