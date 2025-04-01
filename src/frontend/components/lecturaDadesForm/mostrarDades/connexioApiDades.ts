import { formatData } from '../../../utils/formataData';
import { formataHTML } from '../../../utils/formataHtml';

// FUNCIÓ PER DEMANAR PER GET INFORMACIO A LA BD I MOSTRAR-LA EN PANTALLA
/**
 * Funció per realitzar una sol·licitud GET a l'API i obtenir dades.
 * @param url - L'URL de l'API per obtenir les dades.
 * @param id - L'ID de l'element a obtenir.
 * @param urlImg1 - L'URL de la primera imatge.
 * @param urlImg2 - L'URL de la segona imatge.
 * @param callback - La funció de callback que es cridarà amb les dades obtingudes.
 */
// Función para realizar la solicitud Axios a la API
export async function connexioApiDades(url: string, id: string, urlImg1: string, urlImg2: string, callback: (data: any) => void) {
  const urlAjax = `${url}${id}`;

  // Obtener el token del localStorage
  let token = localStorage.getItem('token');

  try {
    const response = await fetch(urlAjax, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${localStorage.getItem('token') || ''}`,
      },
    });

    if (!response.ok) {
      throw new Error('Error en la sol·licitud AJAX');
    }

    const data = await response.json();
    callback(data);

    // Asegúrate de que data sea un objeto o array adecuado
    const data2 = Array.isArray(data) ? data[0] : data;

    for (let key in data2) {
      if (data2.hasOwnProperty(key)) {
        let value = data2[key];

        // Buscar el elemento `<span>` con el ID correspondiente
        const element = document.getElementById(key);
        if (element) {
          // Verificar que el elemento es un `<span>` antes de modificar
          if (element.tagName === 'SPAN') {
            // Decodificar HTML si es necesario y asignar solo el texto
            value = formataHTML(value);
            element.textContent = value; // Solo reemplazar el contenido del `span`
          }
        }

        // Actualizar el DOM con la información recibida
        if (key === 'nameImg') {
          (element as HTMLImageElement).src = `http://media.elliot.cat/${urlImg1}/${urlImg2}/${value}.jpg`;
        }

        // Casos especiales: Director/a
        if (key === 'nom' || key === 'cognoms') {
          const directorUrl = document.getElementById('directorUrl') as HTMLAnchorElement;
          if (directorUrl && directorUrl.tagName === 'A') {
            directorUrl.href = `/directors/${data2['director']}`; // Añadir la URL del director
          }
        }

        // Casos especiales: País
        if (key === 'pais_cat') {
          const paisUrl = document.getElementById('paisUrl') as HTMLAnchorElement;
          if (paisUrl && paisUrl.tagName === 'A') {
            paisUrl.href = `/paisos/${data2['pais']}`; // Añadir la URL del país
          }
        }

        // Formatear fechas si es necesario
        if (key === 'dateCreated' || key === 'dateModified' || key === 'dataVista') {
          const dateElement = document.getElementById(key);
          if (dateElement && dateElement.tagName === 'SPAN') {
            dateElement.textContent = formatData(value); // Formatear y agregar la fecha
          }
        }
      }
    }
    // Ejecutar la función de devolución de llamada si se proporciona
    if (typeof callback === 'function') {
      callback(data);
    }
  } catch (error) {
    console.error('Error al parsear JSON:', error); // Muestra el error de parsing
  }
}
