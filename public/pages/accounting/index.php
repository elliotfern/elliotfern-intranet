<?php
# conectar la base de datos
$activePage = "accounting";
global $conn;

echo '<div class="container">';
echo '<h1>HispanTIC - Elliot Fernandez (2022 - )</h1>';
echo '<h2>ERP & CRM: central system information</h2>';

/* PRIMERA FILA - CRM CLIENTS */
echo '<div class="alert alert-secondary" role="alert" style="margin-bottom:20px";>';
echo "<h3>CRM: customers information</h3>";
echo "<div class='row'>";

/* 1 - llistat darrers 5 clients registrats a l'any actual */
echo "<div class='col-sm'>";
echo "<h6><strong>Last registered customers:</strong></h6>";

$data = array();
$stmt = $conn->prepare("SELECT c.id, c.clientNom, c.clientCognoms, c.clientRegistre, s.estatNom, c.clientStatus, c.clientEmpresa
FROM db_accounting_hispantic_costumers AS c
INNER JOIN db_accounting_hispantic_costumers_status as s ON s.id = c.clientStatus
ORDER BY c.clientRegistre DESC
LIMIT 5");
$stmt->execute();
  if ($stmt->rowCount() === 0) {
    echo 'No rows';
  } else {
    echo "<div class='".TABLE_DIV_CLASS."' style='margin-bottom:25px'>";
    echo "<table class='".TABLE_CLASS."'>";
    echo "<thead class='".TABLE_THREAD."'>";
    echo "<tr>";
    echo "<th>Customer</th>";
    echo "<th>Reg. date</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    $data = $stmt->fetchAll();
    foreach ($data as $row) {
      $idCostumer = $row['id'];
      $clientRegistre = $row['clientRegistre'];
      $clientRegistre2 = date("d/m/Y", strtotime($clientRegistre));
      $clientEstat = $row['clientStatus'];
      $clientNom = $row['clientNom'];
      $clientCognoms = $row['clientCognoms'];
      $estatNom = $row['estatNom'];
      if ($clientEstat == 1) { 
        $color = "primary";
      } elseif ($clientEstat == 2) {
        $color = "secondary";
      } elseif ($clientEstat == 3) {
        $color = "secondary";
      } elseif ($clientEstat == 4) {
        $color = "info";
      } elseif ($clientEstat == 5) {
        $color = "primary";
      } elseif ($clientEstat == 6) {
        $color = "danger";
      } elseif ($clientEstat == 7) {
        $color = "info";
      } elseif ($clientEstat == 8) {
        $color = "warning";
      } elseif ($clientEstat == 9) {
        $color = "warning";
      } elseif ($clientEstat == 10) {
        $color = "success";
      } elseif ($clientEstat == 11) {
        $color = "dark"; 
      }
      echo "<tr>";
      echo "<td><a href='&id=".$idCostumer."'>".$clientNom." ".$clientCognoms."</a></td>";
      echo "<td>".$clientRegistre2."</td>";
      echo "<td>";
      if ($clientEstat == '') { 
        echo "Customer not registered.";
      } else {
      echo '<button type="button" class="btn btn-'.$color.' btn-sm">'.$estatNom.'</button></td>';   
      }
      echo "</tr>";
    }
  echo "</tbody>";                            
  echo "</table>";
  echo "</div>";
}
                

echo "<p class='text-right'><a href='".APP_DEV."/accounting/customers' class='btn btn-info btn-sm' role='button' aria-pressed='true'>Customers list &rarr;</a>
      <a href='#' class='btn btn-dark btn-sm' role='button' aria-pressed='true'>Add new customer &rarr;</a></p>";
echo "</div>";

// 2- llistat darrers 5 pressupostos elabotats 
echo "<div class='col-sm'>";
echo"<h6><strong>Latest budgets sent:</strong></h6>";

$data = array();
$stmt = $conn->prepare("SELECT c.id as id, c.clientNom, c.clientCognoms,  p.id AS pressupostId, p.pressuData, p.pressuImport AS import, ce.estatNom AS clientEstat, p.pressuConcepte, ce.id AS estatId
FROM db_accounting_hispantic_costumers AS c
INNER JOIN db_accounting_hispantic_costumers_budgets AS p ON c.id = p.pressuClient
INNER JOIN db_accounting_hispantic_costumers_status AS ce ON ce.id = p.pressuEstat
ORDER BY p.pressuData DESC
LIMIT 5");
$stmt->execute();
  if ($stmt->rowCount() === 0) {
    echo 'No rows';
  } else {
    echo "<div class='".TABLE_DIV_CLASS."' style='margin-bottom:25px'>";
    echo "<table class='".TABLE_CLASS."'>";
    echo "<thead class='".TABLE_THREAD."'>
            <tr>
            <th>Customer</th>
            <th>Concept</th>
            <th>Date</th>
            <th>Import</th>
            <th>Status</th>
            </tr>
            </thead>
            <tbody>";
    $data = $stmt->fetchAll();
    foreach ($data as $row) {
      $importPressupost = $row['import'];
      $importPressupost_net = number_format($importPressupost, 2, '.', ',');
      $estatColor = $row['estatId'];
      $idCust = $row['id'];
      $nameCust = $row['clientNom'];
      $lastNameCust = $row['clientCognoms'];
      $pressuConcepte = $row['pressuConcepte'];
      $pressuData = $row['pressuData'];
      $pressupostId = $row['pressupostId'];
      $clientEstat = $row['clientEstat'];

      if ($estatColor == 1) { 
          $color2 = "primary";
          } elseif ($estatColor == 2) {
            $color2 = "secondary";
          } elseif ($estatColor == 3) {
            $color2 = "secondary";
          } elseif ($estatColor == 4) {
            $color2 = "info";
          } elseif ($estatColor == 5) {
            $color2 = "primary";
          } elseif ($estatColor == 6) {
            $color2 = "danger";
          } elseif ($estatColor == 7) {
            $color2 = "info";
          } elseif ($estatColor == 8) {
            $color2 = "warning";
          } elseif ($estatColor == 9) {
            $color2 = "warning";
          } elseif ($estatColor == 10) {
            $color2 = "success";
          } elseif ($estatColor == 11) {
            $color2 = "dark"; 
      }
   // 1 es genera la taula dinamica-----------------------
            echo "<tr>";
            echo "<td><a href='&id=".$idCust."'>".$nameCust." ".$lastNameCust."</a></td>";
            echo "<td>".$pressuConcepte."</td>";
            echo "<td>".$pressuData . "</td>";
            echo "<td>€".$importPressupost_net."</td>";
            echo "<td>
            <a href='&pressupostId=".$pressupostId."' class='btn btn-".$color2." btn-sm' role='button' aria-pressed='true'>".$clientEstat."</a>
             </td>";
            echo "</tr>";
    }
    echo "</tbody>";                            
    echo "</table>";
    echo "</div>"; 
  }

echo "<p class='text-right'><a href='' class='btn btn-info btn-sm' role='button' aria-pressed='true'>Budgets list &rarr;</a>
      <a href='' class='btn btn-dark btn-sm' role='button' aria-pressed='true'>Create new budget &rarr;</a></p>";
echo "</div>";
echo "</div>";
echo '</div>';

echo "<hr/>";

// SEGONA FILA - FACTURES EMESES 
echo '<div class="alert alert-secondary" role="alert" style="margin-bottom:20px";>';
echo "<h3>ERP Accounting: Customers invoices</h3>";
echo "<div class='row'>";

//llistat darrers 5 clients registrats a l'any actual
echo "<div class='col-sm'>";
echo"<h6><strong>Last invoices generated:</strong></h6>";

$data = array();
$stmt = $conn->prepare("SELECT f.id, u.id AS idClient, u.clientNom, u.clientCognoms, u.clientEmpresa, f.facData, f.facTotal, f.facConcepte, s.estat, s.id AS idEstat, YEAR(f.facData) AS any
FROM db_accounting_soletrade_invoices_customers AS f
INNER JOIN db_accounting_hispantic_invoices_status AS s ON f.facEstat = s.id
INNER JOIN db_accounting_hispantic_costumers AS u ON u.id = f.idUser
GROUP BY f.id
ORDER BY f.facData DESC
LIMIT 5");
$stmt->execute();
  if ($stmt->rowCount() === 0) {
    echo 'No rows';
  } else {
    echo "<div class='".TABLE_DIV_CLASS."' style='margin-bottom:25px'>";
    echo "<table class='".TABLE_CLASS."'>";
    echo "<thead class='".TABLE_THREAD."'>
            <tr>
            <th>Num.</th>
            <th>Company</th>
            <th>Invoice date</th>
            <th>Concept</th>
            <th>Amount</th>
            <th>Status</th>
            </tr>
            </thead>
            <tbody>";
    $data = $stmt->fetchAll();
    foreach ($data as $row) {
      $idEstat = $row['idEstat'];
      if ($idEstat == 1) { 
          $color3 = "primary";
          } elseif ($idEstat == 2) {
            $color3 = "secondary";
          } elseif ($idEstat == 3) {
            $color3 = "secondary";
          } elseif ($idEstat == 4) {
            $color3 = "success";
          } elseif ($idEstat == 5) {
            $color3 = "primary";
          } elseif ($idEstat == 6) {
            $color3 = "danger";
          } elseif ($idEstat == 7) {
            $color3 = "success";
          } elseif ($idEstat == 8) {
            $color3 = "warning";
          } elseif ($idEstat == 9) {
            $color3 = "warning";
          } elseif ($idEstat == 10) {
            $color3 = "info";
          } elseif ($idEstat == 11) {
            $color3 = "dark"; 
      }

      $date = $row['facData'];
      $date2 = date("d/m/Y", strtotime($date)); 
      $idInvoice = $row['id'];
      $idClient = $row['idClient'];
      $clientEmpresa = $row['clientEmpresa'];
      $clientNom2 = $row['clientNom'];
      $clientCognoms2 = $row['clientCognoms'];
      $facConcepte = $row['facConcepte'];
      $facTotal = $row['facTotal'];
      $estat = $row['estat'];
      $any = $row['any'];
   // 1 es genera la taula dinamica-----------------------
            echo "<tr>";
            echo "<td><a href='&id=".$idInvoice."'>".$idInvoice."/".$any."</a></td>";

            if (!empty($clientEmpresa)) { 
              echo "<td><a href='&id=".$idClient."'>".$clientEmpresa."</a></td>";
               } else {
               echo "<td><a href='&id=".$idClient."'>".$clientNom2." ".$clientCognoms2."</a></td>";
            }

            echo "<td>".$date2."</td>";
            echo "<td>".$facConcepte."</td>";
            echo "<td>€".$facTotal."</td>";
            echo "<td>
                <a href='&id=".$idInvoice."' class='btn btn-".$color3." btn-sm' role='button' aria-pressed='true'>".$estat."</a>
                </td>";
            echo "</tr>";
            }
            echo "</tbody>";                            
            echo "</table>";
            echo "</div>";
  }
echo "<p class='text-right'><a href='".APP_DEV."/accounting/customers/invoices' class='btn btn-info btn-sm' role='button' aria-pressed='true'>Customers invoices &rarr;</a>
    <a href='' class='btn btn-dark btn-sm' role='button' aria-pressed='true'>Create invoice &rarr;</a></p>";
echo "</div>";
echo "</div>";
echo "</div>";

echo "<hr/>";

// TERCERA FILA - COMPTABILITAT PAGAMENTS
echo '<div class="alert alert-secondary" role="alert" style="margin-bottom:20px";>';
echo "<h3>ERP Accounting: Suppliers invoices</h3>";
echo "<div class='row' >";

// 1- PAGAMENTS A EMPRESES PROVEIDORES ANY CORRENT 
echo "<div class='col-sm'>"; 
echo "<h6><strong>Payments to suppliers (current year):</strong></h6>";

$data = array();
$stmt = $conn->prepare("SELECT e.id, e.empresaNom, SUM(s.facTotal) AS total 
FROM db_accounting_hispantic_supplier_companies AS e
INNER JOIN db_accounting_hispantic_invoices_suppliers AS s ON e.id = s.facEmpresa
WHERE YEAR(s.facData) = YEAR(CURRENT_TIMESTAMP())
GROUP BY e.id 
ORDER BY SUM(s.facTotal) DESC
LIMIT 5");
$stmt->execute();
  if ($stmt->rowCount() === 0) {
    echo 'No data';
  } else {
    echo "<div class='".TABLE_DIV_CLASS."' style='margin-bottom:25px'>";
    echo "<table class='".TABLE_CLASS."'>";
    echo "<thead class='".TABLE_THREAD."'>";
    echo "<tr>";
    echo "<th>Company</th>";
    echo "<th>Total paid</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    $data = $stmt->fetchAll();
    foreach ($data as $row) {
      $totalSupplier = $row['total'];
      $totalSupplier_net = number_format($totalSupplier, 2, '.', ',');
      $empresaId = $row['id'];
      $empresaNom = $row['empresaNom'];

      echo "<tr>";
      echo "<td><a href='&empresaId=".$empresaId."'>".$empresaNom."</a></td>";
      echo "<td>€".$totalSupplier_net."</td>";
      echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
  }

echo "<p class='text-right'><a href='#' class='btn btn-info btn-sm' role='button' aria-pressed='true'>Supplies list &rarr;</a>
      <a href='' class='btn btn-dark btn-sm' role='button' aria-pressed='true'>Create new supply &rarr;</a></p>";
echo "</div>";

// 2- PAGAMENTS DARRERS 5 MESOS 
echo "<div class='col-sm'>";
echo "<h6><strong>Latest payments (per month):</strong></h6>";

$data = array();
$stmt = $conn->prepare("SELECT MONTH(i.facData) AS mes, SUM(i.facTotal) AS total, SUM(i.facImportIva) AS iva
FROM db_accounting_soletrade_invoices_suppliers AS i
WHERE YEAR(i.facData) = YEAR(CURRENT_TIMESTAMP())
GROUP BY MONTH(i.facData)
ORDER BY MONTH(i.facData) DESC
LIMIT 5");
$stmt->execute();
  if ($stmt->rowCount() === 0) {
    echo 'No data';
  } else {
    echo "<div class='".TABLE_DIV_CLASS."' style='margin-bottom:25px'>";
    echo "<table class='".TABLE_CLASS."'>";
    echo "<thead class='".TABLE_THREAD."'>";
    echo "<tr>";
    echo "<th>Month</th>";
    echo "<th>VAT paid</th>";
    echo "<th>Total paid</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    $data = $stmt->fetchAll();
    foreach ($data as $row) {
      $totalIvaMes = $row['iva'];
      $totalIvaMes_net = number_format($totalIvaMes, 2, '.', ',');
      $totalMes = $row['total'];
      $totalMes_net = number_format($totalMes, 2, '.', ',');
      $mes_numero = $row['mes'];
      
      //traduccio mes numero a mes nom
      switch($mes_numero)
          {   
          case "1":
          $mesNomCatala = "January";
          break;

          case "2":
          $mesNomCatala = "February";
          break;

          case "3":
          $mesNomCatala = "March";
          break;

          case "4":
          $mesNomCatala = "April";
          break;

          case "5":
          $mesNomCatala = "May";
          break;

          case "6":
          $mesNomCatala = "June";
          break;

          case "7":
          $mesNomCatala = "July";
          break;

          case "8":
          $mesNomCatala = "Augut";
          break;

          case "9":
          $mesNomCatala = "September";
          break;

          case "10":
          $mesNomCatala = "October";
          break;

          case "11":
          $mesNomCatala = "November";
          break;

          case "12":
          $mesNomCatala = "December";
          break;
          }
    echo "<tr>";
    echo "<td>".$mesNomCatala."</td>";
    echo "<td>€".$totalIvaMes_net."</td>";
    echo "<td><strong>€".$totalMes_net."</strong></td>";
    echo "</tr>";      
    }
    echo "</tbody>";                            
    echo "</table>";
    echo "</div>";
  }


echo "<p><a href='".APP_DEV."/accounting/supplies/invoices' class='btn btn-info btn-sm' role='button' aria-pressed='true'>Invoices Supplies &rarr;</a>
    <a href='#' class='btn btn-dark btn-sm' role='button' aria-pressed='true'>Create invoice supply &rarr;</a></p>";
echo '</div>'; 

// 3- PAGAMENTS TOTALS PER ANYS 
echo "<div class='col-sm'>";
echo "<h6><strong>Total paid per fiscal tax year:</strong></h6>";

$day1 = 17;
$month1 = 12;
$day2 = 16;

$data = array();
$stmt = $conn->prepare("SELECT 
CASE WHEN MONTH(fp.facData)>=12 AND DAY(fp.facData)>=17
THEN CONCAT(YEAR(fp.facData), '-',YEAR(fp.facData)+1)
ELSE concat(YEAR(fp.facData)-1,'-',YEAR(fp.facData)) 
END AS financial_year,
SUM(fp.facTotal) as total, SUM(fp.facTotal), SUM(fp.facImportIva) AS iva
FROM db_accounting_soletrade_invoices_suppliers AS fp
GROUP BY financial_year
ORDER BY financial_year ASC");
$stmt->execute();
  if ($stmt->rowCount() === 0) {
    echo 'No data';
  } else {
    echo "<div class='".TABLE_DIV_CLASS."' style='margin-bottom:25px'>";
    echo "<table class='".TABLE_CLASS."'>";
    echo "<thead class='".TABLE_THREAD."'>";
    echo "<tr>";
    echo "<th>Year</th>";
    echo "<th>VAT paid</th>";
    echo "<th>Total paid</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $data = $stmt->fetchAll();
    foreach ($data as $row) {
      $totalAnys = $row['total'];
      $totalAnys_net = number_format($totalAnys, 2, '.', ',');
      $totalIva = $row['iva'];
      $totalIva_net = number_format($totalIva, 2, '.', ',');
      $financial_year = $row['financial_year'];
      $financial_year_net = substr($financial_year, 5);
              echo "<tr>";
              echo "<td><a href='&facData=".$financial_year_net."'>".$financial_year_net."</a></td>";
              echo "<td>€".$totalIva_net."</td>";
              echo "<td><strong>€".$totalAnys_net."</strong></td>";
              echo"</tr>";

    }
    echo "</tbody>";                            
    echo "</table>";
    echo "</div>";
  }

echo "<p><a href='' class='btn btn-info btn-sm' role='button' aria-pressed='true'>Director loans</a></p>";

echo "</div>";
echo "</div>";
echo "</div>";

// QUARTA FILA - COMPTABILITAT TOTAL ENTRADES I SORTIDES
echo "<hr/>";
echo '<div class="alert alert-secondary" role="alert" style="margin-bottom:20px";>';
echo "<h3>ERP Accounting: Current status</h3>";
echo "<div class='row' >";

// 1- PAGAMENTS A EMPRESES PROVEIDORES ANY CORRENT 
echo "<div class='col-sm'>";

// Calcular el total guanyat a l'any corrent 
$data = array();
$stmt = $conn->prepare("SELECT SUM(f.facTotal) AS 'import'
FROM db_accounting_soletrade_invoices_customers AS f
WHERE f.facEstat='4' AND
YEAR(f.facData) = YEAR(CURRENT_TIMESTAMP())");
$stmt->execute();
$data = $stmt->fetchAll();
foreach ($data as $row) {
  $facturat = $row['import'];
}

// Calcular el total pagat a l'any corrent 
$data = array();
$stmt = $conn->prepare("SELECT SUM(factures.facTotal) as totalPagat
FROM db_accounting_soletrade_invoices_suppliers AS factures
WHERE YEAR(factures.facData) = YEAR(CURRENT_TIMESTAMP())");
$stmt->execute();
$data = $stmt->fetchAll();
foreach ($data as $row) {
  $pagat = $row['totalPagat'];
  $totalExercici = $facturat - $pagat;
  $totalExercici_net = number_format($totalExercici, 2, '.', ',');
}

echo "<h6><strong> ".date('Y').": €".$totalExercici_net."</strong></h6>";

echo "<p><a href='' class='btn btn-info btn-sm' role='button' aria-pressed='true'>ERP Years Status &rarr;</a></p>";

echo "</div>";
echo "</div>";
echo "</div>";


echo '</div>';
echo '</div>';

include_once('modals-accounting.php');

# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');