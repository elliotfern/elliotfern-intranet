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
        document.addEventListener('DOMContentLoaded', async function() {
            async function fetchData() {
                const urlAjax = "/api/accounting/get/?type=accounting-elliotfernandez-customers-invoices";

                try {
                    const response = await fetch(urlAjax, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    let html = '';

                    data.forEach(invoice => {
                        const date = new Date(invoice.facData);
                        const formattedDate = date.toLocaleDateString('en-GB', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                        });

                        let statusButton = `<button type="button" class="btn-petit btn-primari">${invoice.estat}</button>`;
                        html += `
                    <tr>
                        <td>
                            <a id="${invoice.id}" title="Show invoice details" data-bs-toggle="modal" data-bs-target="#modalViewInvoiceC" href="#" onclick="viewDetailInvoicec(${invoice.id});return false;">
                                ${invoice.id}/${invoice.yearInvoice}
                            </a>
                        </td>
                        <td>
                            ${invoice.clientEmpresa ? invoice.clientEmpresa : `${invoice.clientNom} ${invoice.clientCognoms}`}
                        </td>
                        <td>${formattedDate}</td>
                        <td>${invoice.facConcepte}</td>
                        <td>${invoice.facTotal}€</td>
                        <td>${statusButton}</td>
                        <td>${invoice.tipusNom}</td>
                        <td>
                            <button type="button" class="btn-petit btn-secondari" onclick="generatePDF(${invoice.id})" id="pdfButton${invoice.id}">PDF</button>
                        </td>
                        <td><button type="button">Update</button></td>
                        <td><button type="button" id="btnUpdateBook" class="btn btn-sm btn-danger">Delete</button></td>
                    </tr>
                `;
                    });

                    document.querySelector('#customersInvoices tbody').innerHTML = html;

                } catch (error) {
                    console.error('There was an error fetching the data:', error);
                }
            }

            await fetchData();
        });
    </script>
</div>
</div>

<script>
    const generatePDF = async (invoiceId) => {
        try {
            const response = await fetch(`https://elliotfern.com/api/accounting/get/invoice-pdf/${invoiceId}`);

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