import { getPageType } from '../../utils/urlPath';
import { selectOmplirDades } from '../../components/lecturaDadesForm/selectOmplirDades';
import { omplirDadesForm } from '../../components/lecturaDadesForm/omplirDadesForm';
import { transmissioDadesDB } from '../../utils/actualitzarDades';
import { llistatPelicules } from '../../components/cinema/llistatPelicules';
import { connexioApiDades } from '../../components/lecturaDadesForm/mostrarDades/connexioApiDades';
import { llistatPeliculaActors } from '../../components/cinema/llistatPeliculaActors';

const url = window.location.href;
const pageType = getPageType(url);

export function cinema() {
  if (pageType[2] === 'modifica-pelicula') {
    // Inicialitzar l'editor Trix
    /*
    omplirDadesForm('/api/cinema/get/?pelicula=', idElement, 'peli', function (data) {
      selectOmplirDades('/api/auxiliars/get/?type=directors', data[0].director, 'director', 'nomComplet');
      selectOmplirDades('/api/auxiliars/get/?type=imgPelis', data[0].img, 'img', 'alt');
      selectOmplirDades('/api/auxiliars/get/?type=generesPelis', data[0].genere, 'genere', 'genere_ca');
      selectOmplirDades('/api/auxiliars/get/?type=llengues', data[0].lang, 'lang', 'idioma_ca');
      selectOmplirDades('/api/auxiliars/get/?type=paisos', data[0].pais, 'pais', 'pais_cat');
    });
*/
    const peli = document.getElementById('peli');
    if (peli) {
      peli.addEventListener('submit', function (event) {
        transmissioDadesDB(event, 'PUT', 'peli', '/api/cinema/put/?type=pelicula');
      });
    }
  } else if (pageType[2] === 'pelicules') {
    llistatPelicules(10); // Pasar 10 como parámetro para mostrar todas las películas al cargar la página

    // Manejar clic en los botones de tipo de contacto
    document.querySelectorAll('button[data-tipus]').forEach((button) => {
      button.addEventListener('click', (event) => {
        const target = event.target as HTMLElement;
        const tipus = target.getAttribute('data-tipus');
        if (tipus) {
          llistatPelicules(Number(tipus));

          // Remover la clase 'active' de todos los botones
          document.querySelectorAll('button[data-tipus]').forEach((btn) => {
            btn.classList.remove('active');
          });
          // Agregar la clase 'active' solo al botón clicado
          target.classList.add('active');
        }
      });
    });
  } else if (pageType[2] === 'fitxa-pelicula') {
    connexioApiDades('/api/cinema/get/?pelicula=', pageType[3], 'img', 'cinema-movie', function (data) {
      // Actualiza el atributo href del enlace con el idDirector
      const directorUrl = document.getElementById('directorUrl') as HTMLAnchorElement;
      const paisUrl = document.getElementById('paisUrl') as HTMLAnchorElement;
      if (directorUrl) {
        directorUrl.href = `${window.location.origin}/cinema/director/${data[0].director}`;
      }

      if (paisUrl) {
        paisUrl.href = `${window.location.origin}/cinema/pelicules/pais/${data[0].pais}`;
      }
    });

    // author book
    llistatPeliculaActors(pageType[3]);
  }
}
