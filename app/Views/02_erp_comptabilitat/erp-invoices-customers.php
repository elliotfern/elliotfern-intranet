<?php


echo '<div class="container">';
echo '<h2>Elliot Fernandez - Accounting & CRM</h2>';
echo '<h3>ERP - Customers invoices</h3>';

echo "<p><a href='./facturacio-clients/nova-factura'><button type='button' class='btn btn-light btn-sm' id='btnAddCustomerInvoice'>Create customer invoice</button></a></p>";

echo "<hr>";
?>
<input type='hidden' id='url' value='https://gestio.elliotfern.com' />

<div class="table-responsive">
    <table class="table table-striped" id="customersInvoices">
        <thead class="table-primary">
            <tr>
                <th>Num.</th>
                <th>Company</th>
                <th>Invoice date</th>
                <th>Concept</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment</th>
                <th>PDF</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <script>
        $(document).ready(function() {
            function fetch_data() {
                var urlRoot = $("#url").val();
                var urlAjax = "/api/accounting/get/?type=accounting-elliotfernandez-customers-invoices";
                $.ajax({
                    url: urlAjax,
                    method: "POST",
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        for (var i = 0; i < data.length; i++) {
                            html += '<tr>';
                            html += '<td><a id="' + data[i].id + '" title="Show invoice details" data-bs-toggle="modal" data-bs-target="#modalViewInvoiceC" href="#" onclick="viewDetailInvoicec(' + data[i].id + ');return false;\">' + data[i].id + '/' + data[i].yearInvoice + '</a></td>';
                            html += '<td>';
                            if (data[i].clientEmpresa === "") {
                                html += data[i].clientNom + " " + data[i].clientCognoms;
                            } else {
                                html += data[i].clientEmpresa;
                            }
                            html += '</td>';
                            // Assuming data[i].facData contains a valid date string
                            var date = new Date(data[i].facData);
                            var formattedDate = date.toLocaleDateString('en-GB', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            });

                            // Append the formatted date to the HTML
                            html += '<td>' + formattedDate + '</td>';
                            html += '<td>' + data[i].facConcepte + '</td>';
                            html += '<td>' + data[i].facTotal + "€ " + '</td>';
                            html += '<td>';
                            if (data[i].facEstat === 1) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 2) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 3) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 4) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 5) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 6) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 7) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 8) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 9) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 10) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            } else if (data[i].facEstat === 11) {
                                html += '<button type="button" class="btn btn-primary btn-sm">' + data[i].estat + "</button>";
                            }
                            html += '</td>';
                            html += '<td>' + data[i].tipusNom + '</td>';
                            html += '<td><button type="button" class="btn btn-sm btn-warning" onclick="generatePDF(' + data[i].id + ')" id="pdfButton' + data[i].id + '">PDF</button>';
                            html += '</td>';
                            html += '<td><button type="button">Update</button>';
                            html += '</td>';
                            html += '<td><button type="button"  id="btnUpdateBook" class="btn btn-sm btn-danger">Delete</button>';
                            html += '</td>';
                            html += '</tr>';
                        }
                        $('#customersInvoices tbody').html(html);
                    }
                });
            }
            fetch_data();
        });
    </script>
</div>
</div>

<script>
    const generatePDF = async (invoiceId) => {
        try {
            const response = await fetch(`https://gestio.elliotfern.com/api/accounting/get/invoice-pdf/${invoiceId}`);

            if (response.ok) {
                const blob = await response.blob();

                if (blob.type === 'application/pdf') {
                    const link = document.createElement('a');
                    const url = URL.createObjectURL(blob);
                    link.href = url;
                    link.download = `invoice_${invoiceId}.pdf`;
                    document.body.appendChild(link); // Necesario para que el enlace funcione
                    link.click();

                    // Limpiar
                    document.body.removeChild(link);
                    URL.revokeObjectURL(url);
                } else {
                    console.error('El archivo descargado no es un PDF', blob.type);
                }
            } else {
                console.error('Error al generar el PDF:', response.status, response.statusText);
            }
        } catch (error) {
            console.error('Hubo un error al hacer la solicitud:', error);
        }
    };
</script>