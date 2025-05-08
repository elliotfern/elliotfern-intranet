import { renderDynamicTable } from '../../services/api/taulaRender';
import { formatData } from '../../utils/formataData';

export function taulaLlistatViatges() {
  renderDynamicTable({
    url: `https://${window.location.host}/api/viatges/get/?llistatViatges`,
    containerId: 'taulaLlistatViatges',
    columns: [
      {
        header: 'Viatge',
        field: 'viatge',
        render: (_, row) => `<a href="https://${window.location.host}/gestio/viatges/fitxa-viatge/${row.slug}">${row.viatge}</a>`,
      },
      { header: 'Descripció', field: 'descripcio' },
      { header: 'País', field: 'pais_cat' },
      {
        header: 'Data',
        field: 'dataInici',
        render: (_, row) => {
          const inici = formatData(row.dataInici);
          const fi = row.dataFi && row.dataFi !== '0' ? formatData(row.dataFi) : 'present';
          return `${inici} - ${fi}`;
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
    filterKeys: ['viatge', 'descripcio'],
    filterByField: 'pais_cat',
  });
}
