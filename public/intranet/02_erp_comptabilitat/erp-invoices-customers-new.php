<?php
# conectare la base de datos

// some action goes here under php
echo '<main>
<div class="form">
<h2>Creació de factura</h2>';

echo '<div class="alert alert-success" id="createCustomerInvoiceMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>correcte!</h4></strong>
              <h6></h6>
              </div>';

echo '<div class="alert alert-danger" id="createCustomerInvoiceMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>error</h4></strong>
              <h6></h6>
              </div>
              ';

echo '<form method="POST" action="" id="modalFormAddCustomerInvoice">

<div class="form-espai">';

echo '<div class="col-md-4">';
echo '<label>Company:</label>';
echo '<select class="form-select" name="idUser" id="idUser">';
echo '<option selected value="">Select an option:</option>';
$stmt = $conn->prepare("SELECT c.id, c.clientNom, c.clientCognoms, c.clientEmpresa
        FROM db_accounting_hispantic_costumers AS c
        ORDER BY c.id");
$stmt->execute();
$data = $stmt->fetchAll();
foreach ($data as $row) {
    $ID_antic = $row['id'];
    $clientNom = $row['clientNom'];
    $clientCognoms = $row['clientCognoms'];
    $clientEmpresa = $row['clientEmpresa'];
    $coma = " ";
    if (!empty($clientEmpresa)) {
        $nom = $clientEmpresa;
    } else {
        $nom = $clientNom . $coma . $clientCognoms;
    }
    echo "<option value=" . $ID_antic . ">" . $ID_antic . " - " . $nom . "</option>";
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
foreach ($data as $row) {
    $ID_vat = $row['id'];
    $ivaPercen = $row['ivaPercen'];
    echo "<option value='" . $ID_vat . "'>" . $ivaPercen . "</option>";
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
foreach ($data as $row) {
    $ID_type = $row['id'];
    $tipusNom = $row['tipusNom'];
    echo "<option value='" . $ID_type . "'>" . $tipusNom . "</option>";
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
foreach ($data as $row) {
    $ID_estat = $row['id'];
    $estat = $row['estat'];
    echo "<option value='" . $ID_estat . "'>" . $estat . "</option>";
}
echo '</select>';
echo '</div>';
echo '</div>';

echo '<hr>';
echo '<div class="form-espai">
  <!-- Columna izquierda: Botón Atrás -->
  <div class="col-md-4">
    <button type="button" id="btnBack" class="btn btn-back">Atrás</button>
  </div>

  <!-- Columna derecha: Botón Crear factura -->
  <div class="col-md-4 dreta">
    <button type="submit" id="btnAddNewCustomerInvoice" class="btn btn-primary">Crear factura</button>
  </div>
</div>';

echo "</form>
</div>
</main>";

?>
<script>
    // AJAX PROCESS > PHP - MODAL FORM - CREATE NEW INVOICE CUSTOMER - ELLIOT FERNANDEZ SOLE TRADE
    document.addEventListener("DOMContentLoaded", function() {
        const urlAjax = "https://elliotfern.com/api/accounting/post/invoice";

        const btnAddNewCustomerInvoice = document.getElementById("btnAddNewCustomerInvoice");
        btnAddNewCustomerInvoice.addEventListener("click", async function(event) {
            // Ocultar mensajes de éxito y error
            document.getElementById("createCustomerInvoiceMessageOk").style.display = 'none';
            document.getElementById("createCustomerInvoiceMessageErr").style.display = 'none';

            // Detener el comportamiento predeterminado del formulario (evitar la recarga de la página)
            event.preventDefault();

            // Preparar los datos para el POST
            const formData = {
                idUser: document.getElementById("idUser").value,
                facConcepte: document.getElementById("facConcepte").value,
                facData: document.getElementById("facData").value,
                facDueDate: document.getElementById("facDueDate").value,
                facSubtotal: document.getElementById("facSubtotal").value,
                facFees: document.getElementById("facFees").value,
                facTotal: document.getElementById("facTotal").value,
                facVAT: document.getElementById("facVAT").value,
                facIva: document.getElementById("facIva").value,
                facEstat: document.getElementById("facEstat").value,
                facPaymentType: document.getElementById("facPaymentType").value,
            };

            try {
                // Hacer el POST usando fetch con async/await
                const response = await fetch(urlAjax, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(formData),
                });

                const data = await response.json();

                if (data.status === "success") {
                    // Mostrar mensaje de éxito y ocultar el de error
                    document.getElementById("createCustomerInvoiceMessageOk").style.display = 'block';
                    document.getElementById("createCustomerInvoiceMessageErr").style.display = 'none';

                    // Cerrar el modal
                    document.getElementById("modalFormAddCustomerInvoice").style.display = 'none';
                    document.getElementById("btnAddNewCustomerInvoice").style.display = 'none';
                } else {
                    // Mostrar mensaje de error
                    document.getElementById("createCustomerInvoiceMessageErr").style.display = 'block';
                    document.getElementById("createCustomerInvoiceMessageOk").style.display = 'none';
                }
            } catch (error) {
                // Manejo de errores de la solicitud
                console.error("Error al enviar los datos:", error);
                document.getElementById("createCustomerInvoiceMessageErr").style.display = 'block';
                document.getElementById("createCustomerInvoiceMessageOk").style.display = 'none';
            }
        });
    });
</script>