<div class="container">
    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">
            <h1>Comptabilitat: Facturació clients</h1>

            <p><button onclick="window.location.href='<?php echo APP_INTRANET . $url['comptabilitat']; ?>/facturacio-clients/nova-factura'" class="button btn-gran btn-secondari">Crear factura</button></p>

            <div id="taulaLlistatFactures"></div>

        </div>
    </main>
</div>


<script>
    const generatePDF = async (invoiceId) => {
        try {
            const response = await fetch(`https://elliot.cat/api/accounting/get/invoice-pdf/${invoiceId}`);

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