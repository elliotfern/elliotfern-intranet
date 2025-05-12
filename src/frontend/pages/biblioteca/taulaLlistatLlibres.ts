import { renderDynamicTable } from '../../components/renderTaula/taulaRender';
import { formatData } from '../../utils/formataData';
import { getIsAdmin } from '../../services/auth/isAdmin';

interface ViatgeRow {
  slug: string;
  AutNom: string;
  AutCognom1: string;
  slugAuthor: string;
  titol: string;
  any: string;
  sub_genere_cat: string;
  nomGenCat: string;
  id: number;
}

export async function taulaLlistatLlibres() {
  const isAdmin = await getIsAdmin(); // Comprovar si és admin
  let gestioUrl: string = '';

  if (isAdmin) {
    gestioUrl = '/gestio';
  }

  const columns = [
    {
      header: 'Llibre',
      field: 'titol',
      render: (_: unknown, row: ViatgeRow) => `<a href="https://${window.location.host}${gestioUrl}/biblioteca/fitxa-llibre/${row.slug}">${row.titol}</a>`,
    },
    {
      header: 'Autor/a',
      field: 'titol',
      render: (_: unknown, row: ViatgeRow) => `<a href="https://${window.location.host}${gestioUrl}/biblioteca/fitxa-autor/${row.slugAuthor}">${row.AutNom} ${row.AutCognom1}</a>`,
    },
    {
      header: 'Gènere',
      field: 'nomGenCat',
      render: (_: unknown, row: ViatgeRow) => `${row.nomGenCat} (${row.sub_genere_cat})`,
    },
    {
      header: 'Any',
      field: 'any',
      render: (_: unknown, row: ViatgeRow) => {
        return `${row.any}`;
      },
    },
  ];

  if (isAdmin) {
    columns.push({
      header: 'Accions',
      field: 'id',
      render: (_: unknown, row: ViatgeRow) => `
        <a href="https://${window.location.host}/gestio/biblioteca/modifica-llibre/${row.slug}">
            <button type="button" class="button btn-petit">Modifica</button></a>`,
    });
  }

  renderDynamicTable({
    url: `https://${window.location.host}/api/biblioteca/get/?type=totsLlibres`,
    containerId: 'taulaLlistatLlibres',
    columns,
    filterKeys: ['titol', 'titolEng'],
    filterByField: 'nomGenCat',
  });
}
