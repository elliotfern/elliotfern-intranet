import { getPageType } from '../../utils/urlPath';
import { transmissioDadesDB } from '../../utils/actualitzarDades';
import { fitxaPersona } from '../persona/fitxaPersona';
import { construirTaula } from '../../services/api/construirTaula';

const url = window.location.href;
const pageType = getPageType(url);

export function historiaOberta() {
  if (pageType[3] === 'modifica-article') {
  } else if (pageType[2] === 'fitxa-personatge') {
    fitxaPersona('/api/persones/get/?persona=', pageType[3], 'historia-persona', function (data) {
      construirTaula('taula1', '/api/historia/get/?carrecsPersona=', data.id, ['Càrrec', 'Anys', 'Accions'], function (fila, columna) {
        if (columna.toLowerCase() === 'càrrec') {
          // Manejar el caso del título
          return fila['carrec'];
        } else if (columna.toLowerCase() === 'anys') {
          return `${fila['anys']} / ${fila['carrecFi']}`;
        } else if (columna.toLowerCase() === 'accions') {
          return `<button onclick="window.location.href='${window.location.origin}/gestio/biblioteca/modifica-llibre/${fila['slug']}'" class="button btn-petit">Modificar</button>`;
        } else {
          // Manejar otros casos
          return fila[columna.toLowerCase()];
        }
      });

      construirTaula('taula2', '/api/historia/get/?esdevenimentsPersona=', data.id, ['Esdeveniment', 'Any', 'Accions'], function (fila, columna) {
        if (columna.toLowerCase() === 'esdeveniment') {
          // Manejar el caso del título
          return '<a href="' + window.location.origin + '/gestio/historia/fitxa-esdeveniment/' + fila['slug'] + '">' + fila['esdeveniment'] + '</a>';
        } else if (columna.toLowerCase() === 'anys') {
          return `${fila['esdeDataIAny']}`;
        } else if (columna.toLowerCase() === 'accions') {
          return `<button onclick="window.location.href='${window.location.origin}/gestio/biblioteca/modifica-llibre/${fila['slug']}'" class="button btn-petit">Modificar</button>`;
        } else {
          // Manejar otros casos
          return fila[columna.toLowerCase()];
        }
      });
    });
  }
}
