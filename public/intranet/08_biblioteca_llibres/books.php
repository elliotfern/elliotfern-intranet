<h2>La meva biblioteca</h2>

<p><button type='button' class='btn btn-outline-secondary' id='btnCreateLink' onclick='btnCrearLlibre()'>Afegir nou llibre &rarr;</button></p>

<hr>

<!-- Campo de búsqueda -->
<div class="input-group mb-3 quadre-cercador">
  <input type="text" class="form-control" placeholder="Cercar per llibre o per autor" id="searchInput">
  <button class="btn btn-outline-secondary" type="button" onclick="cercarLlibres()">Cercar</button>
</div>

<!-- Botones para seleccionar el tipo de contacto -->
<div class="btn-group" role="group" aria-label="Tipus de llibre" style="margin-bottom:25px">
  <button type="button" class="btn btn-outline-primary active" data-tipus="10">Tots els llibres</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="0">0. Obres generals</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="1">1. Filosofia</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="6">6. Ciències aplicades</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="8">8. Literatura</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="9">9. Història.Geografia</button>
</div>

<div class="container-fluid">
  <div class="row gap-3 justify-content-center" id="llibresContainer">
    <!-- Aquí se muestran los contactos -->
  </div>
</div>
</div>

<script>
  // Escuchar el evento de entrada en el campo de búsqueda
  $('#searchInput').on('input', function() {
    cercarLlibres();
  });

  $(document).ready(function() {
    obtenirLlibres(10); // Pasar 10 como parámetro para mostrar todos los libros al cargar la página

    // Manejar clic en los botones de tipo de contacto
    $('button[data-tipus]').click(function() {
      var tipus = $(this).data('tipus');
      obtenirLlibres(tipus);

      // Remover la clase 'active' de todos los botones
      $('button[data-tipus]').removeClass('active');
      // Agregar la clase 'active' solo al botón clicado
      $(this).addClass('active');
    });
  });

  function obtenirLlibres(tipus) {
    let urlAjax = devDirectory + "/api/biblioteca/get/autors/?type=totsLlibres";
    if (tipus !== 10) {
      urlAjax = devDirectory + "/api/biblioteca/get/autors/?type=generes&genere=" + tipus;
    }

    axios.get(urlAjax, {
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('token'),
          'Content-Type': 'application/json',
        }
      })
      .then(response => {
        if (response.status !== 200) {
          throw new Error('Network response was not ok');
        }
        return response.data;
      })
      .then(data => {
        if (!Array.isArray(data)) {
          console.error('Datos inesperados:', data);
          return;
        }

        let llibres = ''; // Inicializar variable
        data.forEach(llibre => {
          llibres += `
          <div class="col-sm-3 col-md-3 quadre">
            <h6><span style="background-color:black;color:white;padding:5px;">${llibre.codiGenere}.${llibre.nomGenCat}</span></h6>
            <h6><span style="background-color:black;color:white;padding:5px;margin-top:5px">${llibre.codiSubGenere}.${llibre.sub_genere_cat}</span></h6>
            <h3 class="links-contactes" style="margin-top: 15px;">
              <a href="${window.location.origin}/biblioteca/llibre/fitxa/${llibre.slug}" title="Fitxa del llibre">${llibre.titol}</a>
            </h3>
            <p class="links-contactes autor"><strong>Autor/a:</strong> <a href="${window.location.origin}/biblioteca/autor/fitxa/${llibre.slugAuthor}">${llibre.AutNom} ${llibre.AutCognom1}</a></p>
            <p><strong>Any: </strong> ${llibre.any}</p>
            <p><strong>Editorial: </strong> ${llibre.editorial}</p>
            <p><strong>Idioma original: </strong> ${llibre.idioma_ca}</p>
            <p><button type='button' class='btn btn-light btn-sm'>${llibre.estat}</button></p>
<<<<<<< HEAD
            <a href="${window.location.origin}/biblioteca/llibre/modifica/${llibre.id}" class="btn btn-secondary btn-sm modificar-link">Modificar</a>
=======
            <a href="${window.location.origin}/biblioteca/modifica/llibre/${llibre.id}" class="btn btn-secondary btn-sm modificar-link">Modificar</a>
>>>>>>> 9a73a7e249f477a8924ef753dfb8d632661ce007
            <button type='button' class='btn btn-dark btn-sm' onclick='eliminaContacte(${llibre.id})'>Eliminar</button>
          </div>`;
        });

        document.getElementById('llibresContainer').innerHTML = llibres;
      })
      .catch(error => {
        console.error('Error en la solicitud Axios:', error);
      });
  }



  // Función para buscar libros
  function cercarLlibres() {
    let textoBusqueda = normalizeText($('#searchInput').val());

    // Filtrar libros según el texto de búsqueda normalizado
    $('#llibresContainer .quadre').each(function() {
      let titol = normalizeText($(this).find('h3').text());
      let autor = normalizeText($(this).find('.autor').text()); // Obtener el texto del autor/a y apellidos
      if (titol.includes(textoBusqueda) || autor.includes(textoBusqueda)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }
</script>