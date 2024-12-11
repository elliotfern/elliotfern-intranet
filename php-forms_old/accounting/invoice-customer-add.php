<?php
# conectare la base de datos
global $conn;

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createCustomerInvoiceMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createCustomerInvoiceMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormAddCustomerInvoice" class="row g-3">';

    echo '<div class="col-md-4">';
    echo '<label>Company:</label>';
    echo '<select class="form-select" name="idUser" id="idUser">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT c.id, c.clientNom, c.clientCognoms, c.clientEmpresa
        FROM db_accounting_hispantic_costumers AS c
        ORDER BY c.id");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach($data as $row) {
            $ID_antic = $row['id'];
            $clientNom = $row['clientNom'];
            $clientCognoms = $row['clientCognoms'];
            $clientEmpresa = $row['clientEmpresa'];
            $coma = " ";
            if (!empty($clientEmpresa)) {
                $nom = $clientEmpresa;
            } else {
                $nom = $clientNom.$coma.$clientCognoms;
            }
            echo "<option value=".$ID_antic." selected>".$ID_antic." - ".$nom."</option>"; 
        }
    echo '</select>';
    echo '</div>';
    
    echo '<div class="col-md-4">';
    echo '<label>Invoice concept</label>';
    echo '<input class="form-control" type="text" name="facConcepte" id="facConcepte">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Invoice date:</label>';
    echo '<input class="form-control" type="date" name="facData" id="facData">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Due Date:</label>';
    echo '<input class="form-control" type="date" name="facDueDate" id="facDueDate">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Invoice Subtotal (without VAT):</label>';
    echo '<input class="form-control" type="url" name="facSubtotal" id="facSubtotal">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Fees (STRIPE):</label>';
    echo '<input class="form-control" type="url" name="facFees" id="facFees">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Invoice total:</label>';
    echo '<input class="form-control" type="url" name="facTotal" id="facTotal">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>VAT amount:</label>';
    echo '<input class="form-control" type="url" name="facVAT" id="facVAT">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Vat type:</label>';
    echo '<select class="form-select" name="facIva" id="facIva">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT v.id, v.ivaPercen 	
        FROM db_accounting_hispantic_vat_type AS v
        ORDER BY v.ivaPercen ");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach($data as $row){
            $ID_vat = $row['id'];
            $ivaPercen = $row['ivaPercen'];
        echo "<option value='".$ID_vat."'>".$ivaPercen."</option>"; 
      }
    echo '</select>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Payment method:</label>';
    echo '<select class="form-select" name="facPaymentType" id="facPaymentType">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.id, p.tipusNom
        FROM db_accounting_hispantic_payment_type AS p
        ORDER BY p.tipusNom");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach($data as $row){
            $ID_type = $row['id'];
            $tipusNom = $row['tipusNom'];
        echo "<option value='".$ID_type."'>".$tipusNom."</option>"; 
      }
    echo '</select>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Invoice status:</label>';
    echo '<select class="form-select" name="facEstat" id="facEstat">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT s.id, s.estat
        FROM db_accounting_hispantic_invoices_status AS s
        ORDER BY s.id");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach($data as $row){
            $ID_estat = $row['id'];
            $estat = $row['estat'];
        echo "<option value='".$ID_estat."'>".$estat."</option>"; 
      }
    echo '</select>';
    echo '</div>';
      
echo "</form>";