import { renderDynamicTable } from '../../components/renderTaula/taulaRender';
import { formatData } from '../../utils/formataData';

export function taulaFacturacioClients() {
  renderDynamicTable({
    url: `https://${window.location.host}/api/accounting/get/?type=accounting-elliotfernandez-customers-invoices`,
    containerId: 'taulaLlistatFactures',
    columns: [
      {
        header: 'Num',
        field: 'yearInvoice',
        render: (_, row) => `<a id="${row.id}" href="#">${row.id}/${row.yearInvoice}</a>`,
      },
      {
        header: 'Empresa',
        field: 'clientEmpresa',
        render: (_, row) => `${row.clientEmpresa ? row.clientEmpresa : `${row.clientNom} ${row.clientCognoms}`}`,
      },
      {
        header: 'Data factura',
        field: 'dataVisita',
        render: (_, row) => {
          const inici = formatData(row.facData);
          return `${inici}`;
        },
      },
      { header: 'Concepte', field: 'facConcepte' },
      {
        header: 'Total',
        field: 'facTotal',
        render: (_, row) => `${row.facTotal}€`,
      },
      {
        header: 'Estat',
        field: 'estat',
        render: (_, row) => `<button type="button" class="btn-petit btn-primari">${row.estat}</button>`,
      },
      {
        header: 'PDF',
        field: 'city',
        render: (_, row) => ` <button type="button" class="btn-petit btn-secondari" onclick="generatePDF(${row.id})" id="pdfButton${row.id}">PDF</button>`,
      },
      {
        header: 'Accions',
        field: 'id',
        render: (_, row) => `
                    <a href="https://${window.location.host}/gestio/viatges/modifica-viatge/${row.id}">
                        <button class="btn-petit">Modifica</button></a>`,
      },
    ],
    filterKeys: ['clientEmpresa', 'clientCognoms'],
    filterByField: 'any',
  });
}
