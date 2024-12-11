<?php
# conectare la base de datos
$activePage = "accounting";

echo '<div class="container">';
echo '<h2>Accounting & CRM</h2>';
echo '<h3>ERP - Supplies invoices</h3>';

echo "<p><button type='button' class='btn btn-light btn-sm' id='btnCreateSupplyCompany' onclick='btnCreateSupplyCompany()' data-bs-toggle='modal' data-bs-target='#modalCreateSupplyCompany'>Add company supply &rarr;</button>
        <button type='button' class='btn btn-light btn-sm' id='btnAddAuthor2' onclick='btnCreateSupplyInvoice()' data-bs-toggle='modal' data-bs-target='#modalCreateSupplyInvoice'>Add supply invoice &rarr;</button></p>";

?>
<input type='hidden' id='url' value='' />
<div class="table-responsive">
    <table class="table table-striped" id="suppliesInvoices">
        <thead class="table-primary">
            <tr>
                <th>Date</th>
                <th>Company</th>
                <th>Customer ass.</th>
                <th>Concept</th>
                <th>Subtotal</th>
                <th>VAT</th>
                <th>Total</th>
                <th>Paid by</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>

        </thead>
        <tbody></tbody>
    </table>
    <script>
        $(document).ready(function() {
            function fetch_data() {
                var urlRoot = $("#url").val();
                var urlAjax = urlRoot + "/controller/control/route.php?type=accounting-elliotfernandez-supplies-invoices";
                $.ajax({
                    url: urlAjax,
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        for (var i = 0; i < data.length; i++) {
                            html += '<tr>';
                            html += '<td>' + data[i].facData + '</td>';
                            html += '<td>';
                            if (data[i].empresaNom === "") {
                                html += data[i].empresaNom;
                            } else {
                                html += data[i].empresaNom;
                            }
                            html += '</td>';
                            html += '<td>' + data[i].clientEmpresa + '</td>';
                            html += '<td>' + data[i].facConcepte + '</td>';
                            html += '<td>' + data[i].facSubtotal + "€ " + '</td>';
                            html += '<td>' + data[i].facImportIva + "€ " + '</td>';
                            html += '<td>' + data[i].facTotal + "€ " + '</td>';
                            html += '<td>' + data[i].tipusNom + '</td>';
                            html += '<td><button type="button" onclick="btnUpdateBook(' + data[i].id + ')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="' + data[i].id + '" value="' + data[i].id + '" data-title="' + data[i].id + '" data-slug="' + data[i].id + '" data-text="' + data[i].id + '">Update</button>';
                            html += '</td>';
                            html += '<td><button type="button" onclick="btnUpdateBook(' + data[i].id + ')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="' + data[i].id + '" value="' + data[i].id + '" data-title="' + data[i].id + '" data-slug="' + data[i].id + '" data-text="' + data[i].id + '">Delete</button>';
                            html += '</td>';
                            html += '</tr>';
                        }
                        $('#suppliesInvoices tbody').html(html);
                    }
                });
            }
            fetch_data();
            setInterval(function() {
                fetch_data();
            }, 5000);
        });
    </script>