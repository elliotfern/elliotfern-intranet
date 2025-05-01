import { getPageType } from '../../utils/urlPath';
import { transmissioDadesDB } from '../../utils/actualitzarDades';
import { fitxaPersona } from '../../pages/persona/fitxaPersona';
import { construirTaula } from '../../services/api/construirTaula';

const url = window.location.href;
const pageType = getPageType(url);

export function biblioteca() {
  if (pageType[2] === 'modifica-llibre') {
    const llibre = document.getElementById('modificaLlibre');
    if (llibre) {
      // Lanzar actualizador de datos
      llibre.addEventListener('submit', function (event) {
        transmissioDadesDB(event, 'PUT', 'modificaLlibre', '/api/biblioteca/put/?llibre');
      });
    }
  } else if (pageType[2] === 'nou-llibre') {
    const llibre = document.getElementById('modificaLlibre');
    if (llibre) {
      // Lanzar actualizador de datos
      llibre.addEventListener('submit', function (event) {
        transmissioDadesDB(event, 'POST', 'modificaLlibre', '/api/biblioteca/post/?llibre');
      });
    }
  } else if (pageType[2] === 'fitxa-autor') {
    fitxaPersona('/api/persones/get/?persona=', pageType[3], 'biblioteca-autor', function (data) {
      construirTaula('taula1', '/api/biblioteca/get/?type=autorLlibres&id=', data.id, ['Titol', 'Any', 'Accions'], function (fila, columna) {
        if (columna.toLowerCase() === 'titol') {
          // Manejar el caso del título
          return '<a href="' + window.location.origin + '/gestio/biblioteca/fitxa-llibre/' + fila['slug'] + '">' + fila['titol'] + '</a>';
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
