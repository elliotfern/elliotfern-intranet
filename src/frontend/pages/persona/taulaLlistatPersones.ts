import { renderDynamicTable } from '../../components/renderTaula/taulaRender';
import { formatData } from '../../utils/formataData';
import { getPageType } from '../../utils/urlPath';
import { getIsAdmin } from '../../services/auth/isAdmin';

interface EspaiRow {
  slug: string;
  pelicula: string;
  dataVisita: string;
  id: number;
  cognoms: string;
  nom: string;
  grup: number;
  yearDie: string;
  yearBorn: string;
  nameImg: string;
}

const url = window.location.href;
const pageType = getPageType(url);

function getDirInfoByGroup(grup: number) {
  let dirImg = '';
  let dirUrl = '';

  switch (grup) {
    case 1:
      dirImg = 'biblioteca-autor';
      dirUrl = 'biblioteca/fitxa-autor';
      break;
    case 2:
      dirImg = 'cinema-director';
      dirUrl = 'cinema/fitxa-director';
      break;
    case 3:
      dirImg = 'cinema-actor';
      dirUrl = 'cinema/fitxa-actor';
      break;
    case 4:
      dirImg = 'historia-persona';
      dirUrl = 'historia/fitxa-persona';
      break;
    case 5:
      dirImg = 'politic';
      dirUrl = 'historia/fitxa-politic';
      break;
    default:
      dirImg = 'default';
      dirUrl = 'default/fitxa';
  }

  return { dirImg, dirUrl };
}

export async function taulaLlistatPersones() {
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
      header: '',
      field: 'nameImg',
      render: (_: unknown, row: EspaiRow) => {
        const { dirImg, dirUrl } = getDirInfoByGroup(row.grup);

        const detailUrl = `https://${window.location.host}${gestioUrl}/${dirUrl}/${row.slug}`;
        const fullImgUrl = `https://media.elliot.cat/img/${dirImg}/${row.nameImg}.jpg`;

        // Genera el enlace dinámico con la imagen
        return `<a id="${row.id}" title="Persona" href="${detailUrl}">
              <img src="${fullImgUrl}" style="height:70px">
            </a>`;
      },
    },
    {
      header: 'Nom i cognoms',
      field: 'nom',
      render: (_: unknown, row: EspaiRow) => {
        const { dirImg, dirUrl } = getDirInfoByGroup(row.grup);

        // Genera el enlace dinámico sin la imagen
        return `<a id="${row.id}" title="${row.nom} ${row.cognoms}" 
               href="https://${window.location.hostname}${gestioUrl}/${dirUrl}/${row.slug}">
               ${row.nom} ${row.cognoms}
            </a>`;
      },
    },
    { header: 'País', field: 'pais_cat' },
    { header: 'Professió', field: 'professio_ca' },
    {
      header: 'Anys',
      field: 'yearBorn',
      render: (_: unknown, row: EspaiRow) => `${row.yearDie ? `${row.yearBorn} - ${row.yearDie}` : row.yearBorn}`,
    },
  ];

  if (isAdmin) {
    columns.push({
      header: 'Accions',
      field: 'id',
      render: (_: unknown, row: EspaiRow) => `<a id="${row.id}" title="Modifica" href="https://${window.location.hostname}${gestioUrl}/base-dades-persones/modifica-persona/${row.slug}"><button type="button" class="button btn-petit">Modifica</button></a>`,
    });
  }

  renderDynamicTable({
    url: `https://${window.location.host}/api/persones/get/?type=llistatPersones`,
    containerId: 'taulaLlistatPersones',
    columns,
    filterKeys: ['nom', 'cognoms'],
    filterByField: 'grup_ca',
  });
}
