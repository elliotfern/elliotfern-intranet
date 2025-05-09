import { renderDynamicTable } from '../../components/renderTaula/taulaRender';
import { formatDataCatala } from '../../utils/formataData';
import { getIsAdmin } from '../../services/auth/isAdmin';
import { getPageType } from '../../utils/urlPath';

interface ViatgeRow {
  slug: string;
  nom: string;
  any1: string;
  id: number;
}

const url = window.location.href;
const pageType = getPageType(url);

export async function taulaLlistatVisitesEspais() {
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
      header: 'Viatge',
      field: 'nom',
      render: (_: unknown, row: ViatgeRow) => `<a href="${window.location.origin}${gestioUrl}/viatges/fitxa-viatge/${row.slug}">${row.nom}</a>`,
    },
    {
      header: 'Data',
      field: 'any1	',
      render: (_: unknown, row: ViatgeRow) => {
        const inici = formatDataCatala(row.any1);
        return `${inici}`;
      },
    },
  ];

  if (isAdmin) {
    columns.push({
      header: 'Accions',
      field: 'id',
      render: (_: unknown, row: ViatgeRow) => `
        <a href="https://${window.location.host}/gestio/viatges/modifica-viatge/${row.id}">
            <button class="btn-petit">Modifica</button>
        </a>`,
    });
  }

  renderDynamicTable({
    url: `https://${window.location.host}/api/viatges/get/?llistatVisitesEspai=${slug}`,
    containerId: 'taulaLlistatVisites',
    columns,
    filterKeys: ['nom'],
  });
}
