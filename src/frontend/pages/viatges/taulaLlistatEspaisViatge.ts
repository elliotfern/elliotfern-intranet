import { renderDynamicTable } from '../../components/renderTaula/taulaRender';
import { formatData } from '../../utils/formataData';
import { getPageType } from '../../utils/urlPath';
import { getIsAdmin } from '../../services/auth/isAdmin';

interface EspaiRow {
  slug: string;
  nom: string;
  dataVisita: string;
  id: number;
}

const url = window.location.href;
const pageType = getPageType(url);

export async function taulaLlistatEspaisViatges() {
  const isAdmin = await getIsAdmin();
  let slug: string = '';
  let gestioUrl: string = '';

  if (isAdmin) {
    slug = pageType[3];
    gestioUrl = '/gestio';
  } else {
    slug = pageType[2];
  }

  const columns = [
    {
      header: 'Espai',
      field: 'nom',
      render: (_: unknown, row: EspaiRow) => `<a href="https://${window.location.host}${gestioUrl}/viatges/fitxa-espai/${row.slug}">${row.nom}</a>`,
    },
    { header: 'Ciutat', field: 'city' },
    {
      header: 'Data visita',
      field: 'dataVisita',
      render: (_: unknown, row: EspaiRow) => {
        const inici = formatData(row.dataVisita);
        return `${inici}`;
      },
    },
  ];

  if (isAdmin) {
    columns.push({
      header: 'Accions',
      field: 'id',
      render: (_: unknown, row: EspaiRow) => `
         <a href="https://${window.location.host}/gestio/viatges/modifica-viatge/${row.id}"><button class="btn-petit">Modifica</button></a>`,
    });
  }

  renderDynamicTable({
    url: `https://${window.location.host}/api/viatges/get/?llistatEspaisViatge=${slug}`,
    containerId: 'taulaLlistatEspaisViatge',
    columns,
    filterKeys: ['nom', 'city'],
    filterByField: 'city',
  });
}
