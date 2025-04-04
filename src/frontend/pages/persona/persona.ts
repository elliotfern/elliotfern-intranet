import { getPageType } from '../../utils/urlPath';
import { transmissioDadesDB } from '../../utils/actualitzarDades';

const url = window.location.href;
const pageType = getPageType(url);

export function persona() {
  if (pageType[2] === 'modifica-persona') {
    const autor = document.getElementById('modificaAutor');
    if (autor) {
      // Lanzar actualizador de datos
      autor.addEventListener('submit', function (event) {
        transmissioDadesDB(event, 'PUT', 'modificaAutor', '/api/biblioteca/put/?autor');
      });
    }
  } else if (pageType[2] === 'nova-persona') {
    const autor = document.getElementById('modificaAutor');
    if (autor) {
      // Lanzar actualizador de datos
      autor.addEventListener('submit', function (event) {
        transmissioDadesDB(event, 'POST', 'modificaAutor', '/api/biblioteca/post/?autor');
      });
    }
  }
}
