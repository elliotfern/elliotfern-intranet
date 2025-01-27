interface Pelicula {
  id: number;
  pelicula: string;
  pelicula_es: string;
  any: string;
  dataVista: string;
  nom: string;
  cognoms: string;
  pais_cat: string;
  genere_ca: string;
  idioma_ca: string;
  nameImg: string;
  dateCreated: string;
  dateModified: string;
  descripcio: string;
  director: number;
  lang: number;
  genere: number;
  img: number;
  pais: number;
}

export async function llistatPelicules(tipus: number) {
  // Si se selecciona "Tots", no pasamos ningún tipo de contacto como parámetro
  let urlAjax = '/api/cinema/get/';

  // Si 'tipus' es 10, añadir el parámetro adecuado a la URL
  if (tipus === 10) {
    urlAjax += '?pelicules';
  } else {
    urlAjax += '?type=generes&generes=' + tipus;
  }

  try {
    const response = await fetch(urlAjax, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${localStorage.getItem('token') || ''}`,
      },
    });

    if (!response.ok) {
      throw new Error('Error en la solicitud AJAX');
    }

    const data: Pelicula[] = await response.json();
    // Aquí puedes manejar los datos recibidos

    // Modificaciones del DOM
    let pelicules = '';
    data.forEach((pelicula) => {
      pelicules += `
      <div class="col-sm-3 col-md-3 quadre">
        <h6><span style="background-color:black;color:white;padding:5px;">${pelicula.genere_ca}</span></h6>
    
        <h3 class="links-contactes" style="margin-top: 15px;"> <a href="${window.location.origin}/cinema/fitxa-pelicula/${pelicula.id}" title="Fitxa de la pel·lícula" >${pelicula.pelicula}</a></h3>`;

      pelicules += `<p class="links-contactes autor"><strong>Director/a:</strong> <a href="${window.location.origin}/cinema/director/${pelicula.id}">${pelicula.nom} ${pelicula.cognoms}</a></p>`;
      pelicules += `<p><strong>Any: </strong> ${pelicula.any}</p>`;
      pelicules += `<p><strong>País: </strong> ${pelicula.pais_cat}</p>`;
      pelicules += `<p><strong>Idioma original: </strong> ${pelicula.idioma_ca}</p>`;
      pelicules += `
        <p><button type='button' class='btn btn-light btn-sm'>${pelicula.genere_ca}</button></p>`;

      pelicules += `
        <a href="${window.location.origin}/cinema/modifica-pelicula/${pelicula.id}" class="btn btn-secondary btn-sm modificar-link">Modificar</a>
        <button type='button' class='btn btn-dark btn-sm' onclick='eliminaContacte(${pelicula.id})'>Eliminar</button>
        </div>`;
    });

    const peliculesContainer = document.getElementById('peliculesContainer');

    if (peliculesContainer) {
      peliculesContainer.innerHTML = pelicules;
    }
  } catch (error) {
    console.error('Error:', error);
  }
}
