<div class="container">
  <h2>Les meves pel·lícules favorites</h2>

  <p><a href="/cinema/pelicules/nova" id="afegirPelicula" class="btn btn-dark btn-sm">Afegir nova pel·lícula</a></p>

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
</div>

<script>
  // Escuchar el evento de entrada en el campo de búsqueda
  /*
  $('#searchInput').on('input', function() {
    cercarLlibres();
  });



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

  normalizeText(text);
  */
</script>