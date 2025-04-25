<div class="container">

  <div class="barraNavegacio">
    <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['cinema']; ?>">Arts escèniques, cinema i televisió</a> > <a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-series">LListat sèries tv</a></h6>
  </div>

  <main>
    <div class="container contingut">

      <h1>Arts escèniques, cinema i televisió: llistat pel·lícules</h1>
      <p>
        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['cinema']; ?>/nova-serie/'" class="button btn-gran btn-secondari">Afegir sèrie tv</button>

        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir actor/a</button>
      </p>

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
        <div class="row gap-3 justify-content-center llibresContainer" id="seriesContainer">
          <!-- aqui es mostren les pelicules -->
        </div>


      </div>
  </main>
</div>

<script>
  // Escuchar el evento de entrada en el campo de búsqueda
  document.getElementById("searchInput").addEventListener("input", cercarLlibres);

  document.addEventListener("DOMContentLoaded", function() {
    obtenirPelicules(10); // Mostrar todas las películas al cargar

    // Manejar clic en los botones de tipo de contacto
    document.querySelectorAll("button[data-tipus]").forEach((button) => {
      button.addEventListener("click", function() {
        let tipus = this.getAttribute("data-tipus");
        obtenirPelicules(tipus);

        // Remover la clase 'active' de todos los botones
        document.querySelectorAll("button[data-tipus]").forEach((btn) => btn.classList.remove("active"));
        // Agregar la clase 'active' solo al botón clicado
        this.classList.add("active");
      });
    });
  });

  function obtenirPelicules(tipus) {
    let urlAjax = "/api/cinema/get/";

    if (tipus === 10) {
      urlAjax += "?series";
    } else {
      urlAjax += "?type=generes&generes=" + tipus;
    }

    fetch(urlAjax, {
        method: "GET",
        headers: {
          "Authorization": "Bearer " + localStorage.getItem("token"),
        },
      })
      .then((response) => response.json())
      .then((data) => {
        try {
          let pelicules = "";
          data.forEach((pelicula) => {
            pelicules += `
             <div class="col-sm-4 col-md-4 card">
              <h6><span style="background-color:black;color:white;padding:5px;">${pelicula.genre}</span></h6>
              <h3 class="links-contactes" style="margin-top: 15px;">
                <a href="${window.location.origin}/gestio/cinema/fitxa-serie/${pelicula.slug}" title="Fitxa de la pel·lícula">${pelicula.name}</a>
              </h3>
              <p class="links-contactes autor"><strong>Director/a:</strong> 
                <a href="${window.location.origin}/gestio/cinema/fitxa-director/${pelicula.slugDirector}">${pelicula.nom} ${pelicula.cognoms}</a>
              </p>
              <p><strong>Any: </strong> ${pelicula.startYear}</p>
              <p><strong>País: </strong> ${pelicula.country}</p>
              <p><strong>Idioma original: </strong> ${pelicula.lang}</p>
              <a href="${window.location.origin}/cinema/modifica/serie/${pelicula.id}" class="btn btn-secondary btn-sm modificar-link">Modificar</a>
              <button type='button' class='btn btn-dark btn-sm' onclick='eliminaContacte(${pelicula.id})'>Eliminar</button>
            </div>`;
          });
          document.getElementById("seriesContainer").innerHTML = pelicules;
        } catch (error) {
          console.error("Error al parsear JSON:", error);
        }
      })
      .catch((error) => console.error("Error en la petición:", error));
  }

  // Función para buscar libros
  function cercarLlibres() {
    let textoBusqueda = normalizeText(document.getElementById("searchInput").value);

    document.querySelectorAll("#llibresContainer .quadre").forEach((quadre) => {
      let titol = normalizeText(quadre.querySelector("h3").textContent);
      let autor = normalizeText(quadre.querySelector(".autor")?.textContent || "");

      quadre.style.display = titol.includes(textoBusqueda) || autor.includes(textoBusqueda) ? "block" : "none";
    });
  }

  // Asegurar que la función normalizeText existe
  function normalizeText(text) {
    return text ? text.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") : "";
  }
</script>