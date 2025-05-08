import { renderDynamicTable } from '../../services/api/taulaRender';
import { formatData } from '../../utils/formataData';
import { getPageType } from '../../utils/urlPath';

const url = window.location.href;
const pageType = getPageType(url);

export function taulaLlistatEspaisViatges() {
  const slug: string = pageType[3];

  renderDynamicTable({
    url: `https://${window.location.host}/api/viatges/get/?llistatEspaisViatge=${slug}`,
    containerId: 'taulaLlistatEspaisViatge',
    columns: [
      {
        header: 'Espai',
        field: 'viatge',
        render: (_, row) => `<a href="https://${window.location.host}/gestio/viatges/fitxa-espai/${row.slug}">${row.nom}</a>`,
      },
      { header: 'Ciutat', field: 'city' },
      {
        header: 'Data visita',
        field: 'dataVisita',
        render: (_, row) => {
          const inici = formatData(row.dataVisita);
          return `${inici}`;
        },
      },
      {
        header: 'Accions',
        field: 'id',
        render: (_, row) => `
                    <a href="https://${window.location.host}/gestio/viatges/modifica-viatge/${row.id}">
                        <button class="btn-petit">Modifica</button></a>`,
      },
    ],
    filterKeys: ['viatge', 'city'],
    filterByField: 'city',
  });
}
