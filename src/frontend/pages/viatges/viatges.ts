import { getPageType } from '../../utils/urlPath';
import { transmissioDadesDB } from '../../utils/actualitzarDades';

const url = window.location.href;
const pageType = getPageType(url);

export function viatges() {
  if (pageType[2] === 'modifica-espai') {
    const autor = document.getElementById('formEspai');
    if (autor) {
      // Lanzar actualizador de datos
      autor.addEventListener('submit', function (event) {
        transmissioDadesDB(event, 'PUT', 'formEspai', '/api/viatges/put/?espai');
      });
    }
  } else if (pageType[2] === 'nou-espai') {
    const autor = document.getElementById('formEspai');
    if (autor) {
      // Lanzar actualizador de datos
      autor.addEventListener('submit', function (event) {
        transmissioDadesDB(event, 'POST', 'formEspai', '/api/viatges/post/?espai');
      });
    }
  }
}
