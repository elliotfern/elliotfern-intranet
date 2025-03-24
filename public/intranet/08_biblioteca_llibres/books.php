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
  document.getElementById('searchInput').addEventListener('input', cercarLlibres);

  // Función para ejecutar cuando el documento esté listo
  document.addEventListener('DOMContentLoaded', function() {
    obtenirLlibres(10); // Pasar 10 como parámetro para mostrar todos los libros al cargar la página

    // Manejar clic en los botones de tipo de contacto
    document.querySelectorAll('button[data-tipus]').forEach(function(button) {
      button.addEventListener('click', function() {
        var tipus = this.dataset.tipus;
        obtenirLlibres(tipus);

        // Remover la clase 'active' de todos los botones
        document.querySelectorAll('button[data-tipus]').forEach(function(btn) {
          btn.classList.remove('active');
        });
        // Agregar la clase 'active' solo al botón clicado
        this.classList.add('active');
      });
    });
  });

  function obtenirLlibres(tipus) {
    let devDirectory = "https://" + window.location.hostname;;
    let urlAjax = devDirectory + "/api/biblioteca/get/autors/?type=totsLlibres";
    if (tipus !== 10) {
      urlAjax = devDirectory + "/api/biblioteca/get/autors/?type=generes&genere=" + tipus;
    }

    fetch(urlAjax, {
        method: "GET",
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('token'),
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
        if (!Array.isArray(data)) {
          console.error('Datos inesperados:', data);
          return;
        }

        let llibres = ''; // Inicializar variable
        data.forEach(llibre => {
          llibres += `
        <div class="col-sm-4 col-md-4 card">
          <h6><span style="background-color:black;color:white;padding:5px;">${llibre.codiGenere}.${llibre.nomGenCat}</span></h6>
          <h6><span style="background-color:black;color:white;padding:5px;margin-top:5px">${llibre.codiSubGenere}.${llibre.sub_genere_cat}</span></h6>
          <h3 class="links-contactes" style="margin-top: 15px;">
            <a href="${window.location.origin}/gestio/biblioteca/fitxa-llibre/${llibre.slug}" title="Fitxa del llibre">${llibre.titol}</a>
          </h3>
          <p class="links-contactes autor"><strong>Autor/a:</strong> <a href="${window.location.origin}/gestio/biblioteca/fitxa-autor/${llibre.slugAuthor}">${llibre.AutNom} ${llibre.AutCognom1}</a></p>
          <p><strong>Any: </strong> ${llibre.any}</p>
          <p><strong>Editorial: </strong> ${llibre.editorial}</p>
          <p><strong>Idioma original: </strong> ${llibre.idioma_ca}</p>
          <p><button type='button' class='btn btn-light btn-sm'>${llibre.estat}</button></p>
          <a href="${window.location.origin}/gestio/biblioteca/llibre/modifica/${llibre.id}" class="btn btn-secondary btn-sm modificar-link">Modificar</a>
          <button type='button' class='btn btn-dark btn-sm' onclick='eliminaContacte(${llibre.id})'>Eliminar</button>
        </div>`;
        });

        document.getElementById('llibresContainer').innerHTML = llibres;
      })
      .catch(error => {
        console.error('Error en la solicitud:', error);
      });
  }

  // Función para buscar libros
  function cercarLlibres() {
    let textoBusqueda = normalizeText(document.getElementById('searchInput').value);

    // Filtrar libros según el texto de búsqueda normalizado
    document.querySelectorAll('#llibresContainer .quadre').forEach(function(quadre) {
      let titol = normalizeText(quadre.querySelector('h3').textContent);
      let autor = normalizeText(quadre.querySelector('.autor').textContent); // Obtener el texto del autor/a y apellidos
      if (titol.includes(textoBusqueda) || autor.includes(textoBusqueda)) {
        quadre.style.display = 'block';
      } else {
        quadre.style.display = 'none';
      }
    });
  }

  function normalizeText(text) {
    return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
  }
</script>

<style>
  /* Estilos para el contenedor de las fichas de libros */
  #llibresContainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
  }

  /* Estilos para cada ficha de libro */
  .card {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    padding: 30px;
    background-color: #fff1d0 !important;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  .card-img-top {
    height: 200px;
    object-fit: cover;
  }

  .card-body {
    padding: 1rem;
  }

  .card-title {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
  }

  .card-text {
    font-size: 1rem;
    color: #555;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }
</style>