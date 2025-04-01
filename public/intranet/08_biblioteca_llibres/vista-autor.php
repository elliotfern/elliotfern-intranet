<?php
$slug = $routeParams[0];
?>

<div class="container">
  <main>
    <div class="container">
      <h1>Biblioteca: <span id="nom"></span> <span id="cognoms"></span></h1>
      <h6><a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>">Biblioteca</a> > <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>/llistat-autors">Autors/es </a></h6>

      <button onclick="window.location.href='<?php echo APP_INTRANET . $url['biblioteca']; ?>/modifica-autor/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica fitxa</button>

      <div class='fixaDades'>

        <div class='columna imatge'>
          <img id="nameImg" src='' class='img-thumbnail' style='height:auto;width:auto;max-width:auto' alt='Author Photo' title='Author photo'>
        </div>

        <div class="columna">

          <div class="quadre-detalls">
            <p>

            </p>
            <strong>
              <p>Anys:
            </strong><span id="anyNaixement"></span></p>

            <p><strong>Pais: </strong> <span id="pais_cat"></span></p>

            <p><strong>Professió: </strong><span id="professio_ca"></span></p>

            <p><strong>Web: </strong><a id="web" href='' target='_blank' title='web'>Web</a></p>

            <p><strong>Data de creació: </strong><span id="dateCreated"></span></p>

            <p><strong>Data de modificació: </strong><span id="dateModified"></span></p>

            <p> <span id="descripcio"> </span></p>
          </div>
        </div>
      </div>

      <hr>
      <h4>Treballs publicats:</h4>

      <div class="table-responsive">
        <table id="tablaContainer" class="table table-striped"></table>
        </table>
      </div>

    </div>
</div>
</main>
</div>

<script>
  // Función para realizar la solicitud Axios a la API
  async function connexioApiDades(url, id, urlImg1, urlImg2, callback) {
    const urlAjax = `${url}${id}`;

    try {
      const response = await fetch(urlAjax, {
        method: 'GET',
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
              element.textContent = value; // Solo reemplazar el contenido del `span`
            }
          }

          // Actualizar el DOM con la información recibida
          if (key === 'nameImg') {
            document.getElementById('nameImg').src = `https://media.elliot.cat/img/library-author/${data2['nameImg']}.jpg`;
          }

          if (key === 'descripcio') {
            document.getElementById('descripcio').innerHTML = `${data2['descripcio']}`;
          }

          // Casos especiales: Director/a
          if (key === 'nom' || key === 'cognoms') {
            const directorUrl = document.getElementById('directorUrl');
            if (directorUrl && directorUrl.tagName === 'A') {
              directorUrl.href = `/directors/${data2['director']}`; // Añadir la URL del director
            }
          }

          if (key === 'web') {
            document.getElementById('web').href = data2['web'];
          }

          // Anys naixement i defuncio
          if (key === 'dateCreated') {
            const dateElement = document.getElementById('dateCreated');
            if (dateElement && dateElement.tagName === 'SPAN') {
              const dateObj = new Date(value);
              const day = dateObj.getDate();
              const month = dateObj.getMonth() + 1; // Los meses van de 0 a 11
              const year = dateObj.getFullYear();

              dateElement.textContent = `${day}-${month}-${year}`;
            }
          }

          // Anys naixement i defuncio
          if (key === 'dateModified') {
            const dateElement = document.getElementById('dateModified');
            if (dateElement && dateElement.tagName === 'SPAN') {
              const dateObj = new Date(value);
              const day = dateObj.getDate();
              const month = dateObj.getMonth() + 1; // Los meses van de 0 a 11
              const year = dateObj.getFullYear();

              dateElement.textContent = `${day}-${month}-${year}`;
            }
          }

          // Anys naixement i defuncio
          if (key === 'anyNaixement' || key === 'anyDefuncio') {
            const dateElement = document.getElementById(key);
            if (dateElement && dateElement.tagName === 'SPAN') {
              const anyNaixement = parseInt(data2['anyNaixement'], 10);
              const anyDefuncio = data2['anyDefuncio'] ? parseInt(data2['anyDefuncio'], 10) : null;
              const anyActual = new Date().getFullYear();

              let edad;

              if (!anyDefuncio) {
                edad = anyActual - anyNaixement; // Calcula la edad actual si sigue vivo
              } else {
                edad = anyDefuncio - anyNaixement; // Calcula la edad en caso de fallecimiento
              }

              dateElement.innerHTML = `${anyNaixement} - ${anyDefuncio || ""} (${edad} anys)`;
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


  // Función para construir una tabla a partir de datos de una API
  function construirTablaFromAPI(apiUrl, id, columnas, callback) {
    // Construir la URL completa con el ID
    const url = apiUrl + id;

    // Realizar la solicitud a la API
    fetch(url, {
        method: "GET",
        headers: {
          'Content-Type': 'application/json',
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // Crear la tabla y su encabezado
        const table = document.createElement('table');
        table.classList.add('table', 'table-striped');

        const thead = document.createElement('thead');
        thead.classList.add('table-primary');
        const trHead = document.createElement('tr');
        columnas.forEach(columna => {
          const th = document.createElement('th');
          th.textContent = columna;
          trHead.appendChild(th);
        });
        thead.appendChild(trHead);
        table.appendChild(thead);

        // Crear el cuerpo de la tabla
        const tbody = document.createElement('tbody');
        data.forEach(fila => {
          const trBody = document.createElement('tr');
          columnas.forEach(columna => {
            const td = document.createElement('td');
            td.innerHTML = callback(fila, columna);
            trBody.appendChild(td);
          });
          tbody.appendChild(trBody);
        });
        table.appendChild(tbody);

        // Agregar la tabla al contenedor deseado
        document.getElementById('tablaContainer').innerHTML = '';
        document.getElementById('tablaContainer').appendChild(table);
      })
      .catch(error => {
        console.error('Error en la solicitud:', error);
      });
  }


  connexioApiDades("/api/biblioteca/get/?autorSlug=", "<?php echo $slug; ?>", "08_biblioteca_llibres", "autors", function(data) {

    construirTablaFromAPI("/api/biblioteca/get/?type=autorLlibres&id=", data.id, ['Titol', 'Any', 'Accions'], function(fila, columna) {
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
</script>