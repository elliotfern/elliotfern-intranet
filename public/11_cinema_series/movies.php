<h2>Les meves pel·lícules favorites</h2>

<p><a href="<?php echo APP_WEB;?>/cinema/afegir/pelicula/"  id="afegirPelicula" class="btn btn-dark btn-sm">Afegir nova pel·lícula</a></p>

<hr>

<!-- Campo de búsqueda -->
  <div class="input-group mb-3 quadre-cercador">
    <input type="text" class="form-control" placeholder="Cercar per llibre o per autor" id="searchInput">
    <button class="btn btn-outline-secondary" type="button" onclick="cercarLlibres()">Cercar</button>
  </div>

<!-- Botones para seleccionar el tipo de contacto -->
<div class="btn-group" role="group" aria-label="Tipus de llibre" style="margin-bottom:25px">
  <button type="button" class="btn btn-outline-primary active" data-tipus="10">Totes les pel·lícules</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="1">1. Drama</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="6">6. Ciències aplicades</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="8">8. Literatura</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="9">9. Història.Geografia</button>
</div>

<div class="container-fluid">
  <div class="row gap-3 justify-content-center" id="peliculesContainer">
    <!-- aqui es mostren les pelicules -->
  </div>
</div>
</div>

<script>
  // Escuchar el evento de entrada en el campo de búsqueda
  $('#searchInput').on('input', function() {
    cercarLlibres();
});

    $(document).ready(function() {
        obtenirPelicules(10); // Pasar 10 como parámetro para mostrar todos los libros al cargar la página

    // Manejar clic en los botones de tipo de contacto
    $('button[data-tipus]').click(function() {
      var tipus = $(this).data('tipus');
      obtenirPelicules(tipus);

      // Remover la clase 'active' de todos los botones
      $('button[data-tipus]').removeClass('active');
      // Agregar la clase 'active' solo al botón clicado
      $(this).addClass('active');
    });
  });

function obtenirPelicules(tipus) {

// Si se selecciona "Tots", no pasamos ningún tipo de contacto como parámetro
let urlAjax = "/api/cinema/get/";

// Si 'tipus' es 10, añadir el parámetro adecuado a la URL
if (tipus === 10) {
    urlAjax += "?pelicules";
} else {
    urlAjax += "?type=generes&generes=" + tipus;
}

$.ajax({
  url: urlAjax,
  method: "GET",
  dataType: "JSON",
  beforeSend: function(xhr) {
    // Obtener el token del localStorage
    let token = localStorage.getItem('token');

    // Incluir el token en el encabezado de autorización
    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
  },
  success: function(data) {
  
    try {
      // Modificaciones del DOM
      let pelicules = '';
      data.forEach(pelicula => {
        pelicules += `
          <div class="col-sm-3 col-md-3 quadre">
            <h6><span style="background-color:black;color:white;padding:5px;">${pelicula.genere_ca}</span></h6>
        
            <h3 class="links-contactes" style="margin-top: 15px;"> <a href="${window.location.origin}/cinema/pelicula/${pelicula.id}" title="Fitxa de la pel·lícula" >${pelicula.pelicula}</a></h3>`;
       
            pelicules += `<p class="links-contactes autor"><strong>Director/a:</strong> <a href="${window.location.origin}/cinema/director/${pelicula.id}">${pelicula.nom} ${pelicula.cognoms}</a></p>`;
            pelicules += `<p><strong>Any: </strong> ${pelicula.any}</p>`;
            pelicules += `<p><strong>País: </strong> ${pelicula.pais_cat}</p>`;
            pelicules += `<p><strong>Idioma original: </strong> ${pelicula.idioma_ca}</p>`;            
            pelicules += `
            <p><button type='button' class='btn btn-light btn-sm'>${pelicula.genere_ca}</button></p>`;

            pelicules += `
            <a href="${window.location.origin}/cinema/modifica/pelicula/${pelicula.id}" class="btn btn-secondary btn-sm modificar-link">Modificar</a>
            <button type='button' class='btn btn-dark btn-sm' onclick='eliminaContacte(${pelicula.id})'>Eliminar</button>
            </div>`;
      });
      document.getElementById('peliculesContainer').innerHTML = pelicules;
    } catch (error) {
      console.error('Error al parsear JSON:', error); // Muestra el error de parsing
    }
  }
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

function normalizeText(text) {
  return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
}

</script>
<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');