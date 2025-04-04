// author book
export async function llistatPeliculaActors(id: string) {
  let urlAjax = '/api/cinema/get/?actors-pelicula=' + id;

  try {
    // Obtener el token del localStorage
    let token = localStorage.getItem('token');

    // Realizar la solicitud fetch
    let response = await fetch(urlAjax, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${token}`,
      },
    });

    if (!response.ok) {
      throw new Error('Error en la sol·licitud AJAX');
    }

    let data = await response.json();

    let html = '';
    for (let i = 0; i < data.length; i++) {
      html += '<tr>';

      html += '<td><img src="https://media.elliot.cat/img/cinema-actor/' + data[i].nameImg + '.jpg" alt="Descripción de la imagen" width="auto" height="150"></td>';

      html += '<td><a id="' + data[i].id + '" title="Actor" href="' + window.location.origin + '/gestio/cinema/fitxa-actor/' + data[i].slug + '">' + data[i].nom + ' ' + data[i].cognoms + '</a></td>';

      html += '<td>' + data[i].role + '</td>';

      html += '<td><a href="' + window.location.origin + '/gestio/persona/modifica-persona/' + data[i].slug + '" class="btn btn-secondary btn-sm modificar-link">Modificar</a></td>';

      html += '<td><button type="button" onclick="btnDeleteBook(' + data[i].id + ')" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBook" data-id="' + data[i].id + '">Elimina</button></td>';
      html += '</tr>';
    }

    // Actualizar el contenido del tbody
    const tbody = document.querySelector('#booksAuthor tbody');
    if (tbody) {
      tbody.innerHTML = html;
    } else {
      console.error('Elemento tbody no encontrado');
    }
  } catch (error) {
    console.error('Error al parsear JSON:', error); // Muestra el error de parsing
  }
}
