import { getPageType } from '../../utils/urlPath';
import { transmissioDadesDB } from '../../utils/actualitzarDades';

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
  }
}
