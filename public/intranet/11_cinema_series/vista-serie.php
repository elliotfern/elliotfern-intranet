<?php
$slug = $routeParams[0];
?>

<div class="container">
  <main>
    <div class="container">
      <h1>Cinema i sèries TV</h1>
      <h6><a href="/cinema/">Cinema i sèries TV</a> > <a href="/cinema/series">Sèries </a></h6>

      <div class='row'>
        <div class='col-sm-8'>
          <img id="img" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Cartell' title='Cartell'>
        </div>

        <div class="col-sm-4">
          <p><a href="/cinema/modifica/serie/" class="btn btn-sm btn-warning">Modificar les dades</a></p>
          <div class="alert alert-primary" role="alert" style="margin-top:10px">
            <h4 class="alert-heading"></h4>
            <p><strong>Nom original de la sèrie: </strong><span id="name"></span></p>
            <p><strong>Director: </strong><a id="directorUrl" href=""><span id="nom"></span> <span id="cognoms"></span></a></p>
            <p><strong>Idioma original: </strong><span id="idioma_ca"></span></p>
            <p><strong>Gènere: </strong><span id="genere_ca"></span></p>
            <p><strong>País: </strong><a id="paisUrl" href=""><span id="pais_cat"></span></a></p>
            <p><strong>Productora tv/plataforma: </strong><a id="plataformaUrl" href=""><span id="productora"></span></a></p>
            <p><strong>Número de temporades: </strong><span id="season"></span></p>
            <p><strong>Número d'episodis: </strong><span id="chapter"></span></p>
            <p><strong>Anys d'emissió: </strong><span id="startYear"></span> / <span id="endYear"></span></p>
            <p><strong>Fitxa creada: </strong><span id="dateCreated"></span></p>
            <p><strong>Fitxa actualizada: </strong><span id="dateModified"></span></p>
          </div>
        </div>

      </div>

      <hr>
      <div class="container" style="padding:20px;background-color:#ececec;margin-top:25px;margin-bottom:25px">
        <h4>Crítica de la sèrie</h4>
        <p id="descripcio"></p>
      </div>

      <hr>
      <h4>Actors:</h4>
      <p><a href="/cinema/afegir/actor/serie/>" class="btn btn-sm btn-warning">Afegir actor a la pel·lícula</a></p>

      <div class="table-responsive">
        <table class="table table-striped" id="actors">
          <thead class="table-primary">
            <tr>
              <th></th>
              <th>Actor:</th>
              <th>Personatge</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

    </div>
  </main>
</div>

<script>
  connexioApiGetDades("/api/cinema/get/?serie=", "<?php echo $slug; ?>")
  actorsDeLaSerie("<?php echo $slug; ?>");

  async function connexioApiGetDades(url, id) {
    const urlAjax = `${url}${id}`;

    try {
      const response = await fetch(urlAjax, {
        method: 'GET'
      });

      if (!response.ok) {
        throw new Error('Error en la sol·licitud AJAX');
      }

      const data = await response.json();

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
            document.getElementById('img').src = `https://media.elliot.cat/img/cinema-television/${data2['nameImg']}.jpg`;
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


        }
      }

    } catch (error) {
      console.error('Error al parsear JSON:', error); // Muestra el error de parsing
    }
  }

  async function actorsDeLaSerie(id) {
    const urlAjax = `/api/cinema/get/?llistat-actors-serie=${id}`;


    try {
      const response = await fetch(urlAjax, {
        method: "GET",
      });

      if (!response.ok) {
        throw new Error(`Error en la petición: ${response.statusText}`);
      }

      const data = await response.json();
      let html = data.map(actor => `
            <tr>
                <td>
                    <a id="actor-${actor.idActor}" title="Actor" href="${window.location.origin}/gestio/cinema/fitxa-actor/${actor.slug}">
                        <img src="https://media.elliot.cat/img/cinema-actor/${actor.nameImg}.jpg" width="100" height="auto">
                    </a>
                </td>
                <td>
                    <a id="actor-${actor.idActor}" title="Actor" href="${window.location.origin}/gestio/cinema/fitxa-actor/${actor.slug}">
                        ${actor.nom} ${actor.cognoms}
                    </a>
                </td>
                <td>${actor.role}</td>
                <td>
                    <a href="${window.location.origin}/biblioteca/modifica/llibre/${actor.id}" class="btn btn-secondary btn-sm modificar-link">Modificar</a>
                </td>
                <td>
                    <button type="button" onclick="btnDeleteBook(${actor.id})" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBook" data-id="${actor.id}">
                        Elimina
                    </button>
                </td>
            </tr>
        `).join("");

      document.querySelector("#actors tbody").innerHTML = html;
    } catch (error) {
      console.error("Error al obtener los actores:", error);
    }
  }
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
    max-width: 300px;
    height: auto !important;
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