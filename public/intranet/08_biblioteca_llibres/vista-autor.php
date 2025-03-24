<?php
$slug = $routeParams[0];
?>

<div class="container">
  <main>
    <div class="container">
      <h1>Biblioteca: <span id="AutNom"></span> <span id="AutCognom1"></span></h1>
      <h6><a href="/biblioteca/">Biblioteca</a> > <a href="/biblioteca/autors">Autors/es </a></h6>

      <a id="modificaAutorUrl" href="" class="btn btn-warning btn-sm">Modifica les dades</a>
      <div class='row'>

        <div class='col imatge'>
          <img id="nameImg" src='' class='img-thumbnail' style='height:auto;width:auto;max-width:auto' alt='Author Photo' title='Author photo'>
        </div>

        <div class="col">

          <div class="quadre-detalls">
            <p>

            </p>
            <strong>
              <p>Anys:
            </strong><span id="yearBorn"> </span> - <span id="yearDie"></span></p>

            <p id="AutDescrip"> </p>

            <p><strong>Pais: </strong> <a id="linkAutor" href='' title='Country'><span id="country"></span></a></p>

            <p><strong>Professió: </strong><a id="ocupacioLink" href='' title='Movement'><span id="name"></span></a></p>

            <p><strong>Moviment: </strong><a id="movimentLink" href='' title='Movement'><span id="movement"></span></a></p>

            <p><strong>Viquipedia: </strong><a id="wikipediaLink" href='' target='_blank' title='Wikipedia'>Web</a></p>

            <p><strong>Data de creació: </strong><span id="dateCreated"></span></p>

            <p><strong>Data de modificació: </strong><span id="dateModified"></span></p>
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
              element.textContent = value; // Solo reemplazar el contenido del `span`
            }
          }

          // Actualizar el DOM con la información recibida
          if (key === 'nameImg') {
            (element).src = `http://media.elliotfern.com/${urlImg1}/${urlImg2}/${value}.jpg`;
          }

          // Casos especiales: Director/a
          if (key === 'nom' || key === 'cognoms') {
            const directorUrl = document.getElementById('directorUrl');
            if (directorUrl && directorUrl.tagName === 'A') {
              directorUrl.href = `/directors/${data2['director']}`; // Añadir la URL del director
            }
          }

          // Casos especiales: País
          if (key === 'pais_cat') {
            const paisUrl = document.getElementById('paisUrl');
            if (paisUrl && paisUrl.tagName === 'A') {
              paisUrl.href = `/paisos/${data2['pais']}`; // Añadir la URL del país
            }
          }

          // Formatear fechas si es necesario
          if (key === 'dateCreated' || key === 'dateModified' || key === 'dataVista') {
            const dateElement = document.getElementById(key);
            if (dateElement && dateElement.tagName === 'SPAN') {
              dateElement.textContent = value; // Formatear y agregar la fecha
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


  connexioApiDades("/api/biblioteca/get/autors/?type=autor&slugAuthor=", "<?php echo $slug; ?>", "08_biblioteca_llibres", "autors", function(data) {

    // Actualiza el atributo href del enlace con el idDirector
    document.getElementById('wikipediaLink').href = `${data.AutWikipedia}`;
    document.getElementById('movimentLink').href = `${window.location.origin}/biblioteca/autors/moviment/${data.idMovement}`;
    document.getElementById('ocupacioLink').href = `${window.location.origin}/biblioteca/autors/professio/${data.AutOcupacio}`;
    document.getElementById('linkAutor').href = `${window.location.origin}/biblioteca/autors/pais/${data.idPais}`;
    document.getElementById('modificaAutorUrl').href = `${window.location.origin}/biblioteca/autor/modifica/${data.id}`;
    document.getElementById('nameImg').src = `https://media.elliot.cat/img/library-author/${data.nameImg}.jpg`;

    construirTablaFromAPI("/api/biblioteca/get/autors/?type=autorLlibres&id=", data.id, ['Titol', 'Any', 'Accions'], function(fila, columna) {
      if (columna.toLowerCase() === 'titol') {
        // Manejar el caso del título
        return '<a href="' + window.location.origin + '/gestio/biblioteca/fitxa-llibre/' + fila['slug'] + '">' + fila['titol'] + '</a>';
      } else if (columna.toLowerCase() === 'accions') {
        return '<a href="' + window.location.origin + '/gestio/biblioteca/modifica/llibre/' + fila['id'] + '" class="btn btn-secondary btn-sm modificar-link">Modificar</a>';
      } else {
        // Manejar otros casos
        return fila[columna.toLowerCase()];
      }
    });
  });
</script>

<style>
  .row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-top: 20px;
    margin-bottom: 30px;
    gap: 20px;
    flex-wrap: wrap;
  }

  .col {
    flex: 1;
    margin: 2px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  .imatge {
    flex: 0 0 300px;
    /* Limita el ancho de la primera columna a 200px */
  }


  .img-thumbnail {
    max-width: 100%;
    height: 350px !important;
    border-radius: 8px;
  }

  .quadre-detalls {
    border: 1px black;
  }

  /* Media query para pantallas más pequeñas */
  @media (max-width: 600px) {
    .container {
      flex-direction: column;
      /* Cambia la dirección del flex a columna */
    }

    .imatge {
      flex: 1 1 100%;
      /* La primera columna ocupa el 100% del ancho en dispositivos pequeños */
    }
  }
</style>