<?php
# conectare la base de datos
$activePage = "accounting";

echo '<div class="container">';
echo '<h2>Elliot Fernandez - Accounting & CRM</h2>';
echo '<h3>ERP - Customers invoices</h3>';

echo "<p><button type='button' class='btn btn-light btn-sm' id='btnAddCustomerInvoice' onclick='btnCreateCustomInvoice()' data-bs-toggle='modal' data-bs-target='#modalCreateCustomerInvoice'>Create customer invoice</button></p>";

echo "<hr>";
?>
<input type='hidden' id='url' value='<?php echo APP_SERVER;?>'/>

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
    
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function(){
                function fetch_data(){
                    var urlRoot = $("#url").val();
                    var urlAjax = "/elliotfern/api/accounting/?type=accounting-elliotfernandez-customers-invoices";
                    $.ajax({
                        url:urlAjax,
                        method:"POST",
                        dataType:"json",
                        success:function(data){
                            var html = '';
                            for(var i=0; i<data.length; i++){
                                html += '<tr>';
                                html += '<td><a id="'+data[i].id+'" title="Show invoice details" data-bs-toggle="modal" data-bs-target="#modalViewInvoiceC" href="#" onclick="viewDetailInvoicec('+data[i].id+');return false;\">'+data[i].id+'/'+data[i].yearInvoice+'</a></td>';
                                html += '<td>';
                                if (data[i].clientEmpresa === "") {
                                    html += data[i].clientNom + " " + data[i].clientCognoms;
                                } else {
                                    html += data[i].clientEmpresa;
                                }
                                html += '</td>';
                                // Assuming data[i].facData contains a valid date string
                                var date = new Date(data[i].facData);
                                var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });

                                // Append the formatted date to the HTML
                                html += '<td>' + formattedDate + '</td>';
                                html += '<td>'+data[i].facConcepte + '</td>';
                                html += '<td>'+data[i].facTotal + "€ "+'</td>';
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
                                html += '<td>'+data[i].tipusNom+'</td>';
                                html += '<td><button type="button" class="btn btn-sm btn-warning" onclick="btnCreatePDFInvoice('+data[i].id+')" id="pdfButton' + data[i].id +'">PDF</button>';
                                html += '</td>';
                                html += '<td><button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Update</button>';
                                html += '</td>';
                                html += '<td><button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Delete</button>';
                                html += '</td>';
                                html += '</tr>';
                            }
                            $('#customersInvoices tbody').html(html);
                        }
                    });
                }
                fetch_data();
                setInterval(function(){
                    fetch_data();
                }, 5000);
            });
       </script>
</div>
</div>
<?php
include_once('modals-accounting.php');

# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');