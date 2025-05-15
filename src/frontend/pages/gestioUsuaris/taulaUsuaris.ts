import { renderDynamicTable } from '../../components/renderTaula/taulaRender';
import { formatData } from '../../utils/formataData';
import { getIsAdmin } from '../../services/auth/isAdmin';

interface EspaiRow {
  nom: string;
  cognom: string;
  dateCreated: string;
  id: number;
}

export async function taulaUsuaris() {
  const isAdmin = await getIsAdmin();

  const columns = [
    {
      header: 'Nom i cognoms',
      field: 'nom',
      render: (_: unknown, row: EspaiRow) => `${row.nom} ${row.cognom}`,
    },
    { header: 'Email', field: 'email' },
    { header: 'Tipus', field: 'tipus' },
    {
      header: 'Data alta',
      field: 'dateCreated',
      render: (_: unknown, row: EspaiRow) => {
        const inici = formatData(row.dateCreated);
        return `${inici}`;
      },
    },
  ];

  if (isAdmin) {
    columns.push({
      header: 'Accions',
      field: 'id',
      render: (_: unknown, row: EspaiRow) => `
         <a href="https://${window.location.host}/gestio/gestio-usuaris/modifica-usuari/${row.id}"><button class="btn-petit">Modifica</button></a>`,
    });
  }

  renderDynamicTable({
    url: `https://${window.location.host}/api/auth/get/usuaris`,
    containerId: 'taulaUsuaris',
    columns,
    filterKeys: ['nom', 'cognom'],
    filterByField: 'tipus',
  });
}
