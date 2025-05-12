import { renderDynamicTable } from '../../components/renderTaula/taulaRender';
import { formatData } from '../../utils/formataData';
import { getIsAdmin } from '../../services/auth/isAdmin';

interface ViatgeRow {
  slug: string;
  AutNom: string;
  AutCognom1: string;
  pais_cat: string;
  country: string;
  yearDie: string;
  yearBorn: string;
  id: number;
}

export async function taulaLlistatAutors() {
  const isAdmin = await getIsAdmin(); // Comprovar si és admin
  let gestioUrl: string = '';

  if (isAdmin) {
    gestioUrl = '/gestio';
  }

  const columns = [
    {
      header: 'Autor/a',
      field: 'viatge',
      render: (_: unknown, row: ViatgeRow) => `<a href="https://${window.location.host}${gestioUrl}/biblioteca/fitxa-autor/${row.slug}">${row.AutNom} ${row.AutCognom1}</a>`,
    },
    { header: 'País', field: 'country' },
    { header: 'Professió', field: 'profession' },
    {
      header: 'Dates',
      field: 'yearDie',
      render: (_: unknown, row: ViatgeRow) => {
        return `${!row.yearDie ? row.yearBorn : `${row.yearBorn} - ${row.yearDie}`}`;
      },
    },
  ];

  if (isAdmin) {
    columns.push({
      header: 'Accions',
      field: 'id',
      render: (_: unknown, row: ViatgeRow) => `
        <a href="https://${window.location.host}/gestio/base-dades-persones/modifica-persona/${row.slug}">
           <button type="button" class="button btn-petit">Modifica</button></a>`,
    });
  }

  renderDynamicTable({
    url: `https://${window.location.host}/api/biblioteca/get/?type=totsAutors`,
    containerId: 'taulaLlistatAutors',
    columns,
    filterKeys: ['author', 'AutCognom1'],
    filterByField: 'profession',
  });
}
