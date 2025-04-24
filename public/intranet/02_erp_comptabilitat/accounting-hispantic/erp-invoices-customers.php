<?php

# conectare la base de datos
$activePage = "accounting";
include_once('../inc/header.php');


echo '<div class="container">';
echo '<h1>Database</h1>';
echo '<h2>Hispano Atlantic Consulting Ltd - Accounting & CRM</h2>';
echo '<h3>ERP - Customers invoices</h3>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddCustomerInvoice' onclick='btnCreateCustomInvoice()' data-bs-toggle='modal' data-bs-target='#modalCreateCustomerInvoice'>Create customer invoice</button></p>";

echo "<hr>";

    echo '<div class="'.TABLE_DIV_CLASS.'">';
    echo '<table class="table table-striped datatable" id="customersInvoicesTable">
        <thead class="'.TABLE_THREAD.'">
        <tr>
            <th>Num.</th>
            <th>Company</th>
            <th>Invoice date</th>
            <th>Concept</th>
            <th>Amount</th>
            <th>Status</th>
            <th></th>
            <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
       
    </tr>
 </tbody>
    </table>
    </div>

    </div>
</div>';

include_once('modals-accounting.php');

# footer
include_once('../inc/footer.php');