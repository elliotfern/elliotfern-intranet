<?php

# conectare la base de datos
$activePage = "accounting";
include_once('../inc/header.php');


echo '<div class="container">';
echo '<h1>Database</h1>';
echo '<h2>Hispano Atlantic Consulting Ltd - Accounting & CRM</h2>';
echo '<h3>ERP - Supplies invoices</h3>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnCreateSupplyCompany' onclick='btnCreateSupplyCompany()' data-bs-toggle='modal' data-bs-target='#modalCreateSupplyCompany'>Add company supply &rarr;</button>
        <button type='button' class='btn btn-dark btn-sm' id='btnAddAuthor2' onclick='btnCreateSupplyInvoice()' data-bs-toggle='modal' data-bs-target='#modalCreateSupplyInvoice'>Add supply invoice &rarr;</button></p>";

    echo '<div class="'.TABLE_DIV_CLASS.'">';
    echo '<table class="table table-striped datatable" id="suppliesInvoicesTable">
        <thead class="'.TABLE_THREAD.'">
        <tr>
            <th>Date</th>
            <th>Company</th>
            <th>Concept</th>
            <th>Subtotal</th>
            <th>VAT</th>
            <th>Total</th>
            <th>Paid by</th>
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