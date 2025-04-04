<div class="container">
  <main>
    <div class="container">

      <h1>Arts escèniques, cinema i televisió: llistat pel·lícules</h1>
      <h6><a href="<?php echo APP_INTRANET . $url['cinema']; ?>">Arts escèniques, cinema i televisió</a> > <a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-pelicules">LListat pel·lícules</a></h6>

      <p>
        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['cinema']; ?>/nova-pelicula/'" class="button btn-gran btn-secondari">Afegir pel·lícula</button>

        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir actor/a</button>
      </p>

      <!-- Tabla de Películas -->
      <div class="table-responsive">
        <table class="table table-striped" id="moviesTable">
          <thead class="table-primary">
            <tr>
              <th>Pel·lícula</th>
              <th>Any</th>
              <th>Director</th>
              <th>País</th>
              <th>Gènere</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <!-- Las filas de la tabla serán agregadas dinámicamente con JavaScript -->
          </tbody>
        </table>
      </div>

    </div>
  </main>
</div>

<script>
  loadTableMovies()
  async function loadTableMovies() {
    const table = document.getElementById("moviesTable"); // Suponiendo que la tabla tiene el id 'moviesTable'
    const tbody = table.querySelector("tbody");
    tbody.innerHTML = ""; // Limpiar cualquier fila existente

    try {
      // Realizar la solicitud fetch para obtener los datos
      const response = await fetch("/api/cinema/get/?pelicules");

      // Verificar si la respuesta es válida
      if (!response.ok) {
        throw new Error('Error al cargar los datos');
      }

      const data = await response.json(); // Convertir la respuesta en JSON

      // Recorrer los datos y crear las filas de la tabla
      data.forEach(row => {
        const tr = document.createElement("tr");

        // Columna 1: nameMovie con enlace
        const tdNameMovie = document.createElement("td");
        tdNameMovie.innerHTML = `<a id="${row.id}" title="Show movie details" href="https://${window.location.hostname}/gestio/cinema/fitxa-pelicula/${row.slug}">${row.pelicula}</a>`;
        tr.appendChild(tdNameMovie);

        // Columna 2: yearMovie
        const tdYearMovie = document.createElement("td");
        tdYearMovie.textContent = row.any;
        tr.appendChild(tdYearMovie);

        // Columna 3: nomDirector + lastName
        const tdDirector = document.createElement("td");
        tdDirector.textContent = `${row.nom} ${row.cognoms}`;
        tr.appendChild(tdDirector);

        // Columna 4: countryName
        const tdCountryName = document.createElement("td");
        tdCountryName.textContent = row.pais_cat;
        tr.appendChild(tdCountryName);

        // Columna 5: gènere
        const tdGenere = document.createElement("td");
        tdGenere.textContent = row.genere_ca;
        tr.appendChild(tdGenere);

        // Columna 5: Botón de Update
        const tdNameUpdate = document.createElement("td");
        tdNameUpdate.innerHTML = `<a id="${row.id}" title="Show movie details" href="https://${window.location.hostname}/gestio/cinema/modifica-pelicula/${row.slug}">Modifica</a>`;
        tr.appendChild(tdNameUpdate);

        // Columna 6: Botón de Delete
        const tdNameElimina = document.createElement("td");
        tdNameElimina.innerHTML = `<a id="${row.id}" title="Show movie details" href="https://${window.location.hostname}/gestio/cinema/modifica-pelicula/${row.slug}">Elimina</a>`;
        tr.appendChild(tdNameElimina);

        // Agregar la fila al cuerpo de la tabla
        tbody.appendChild(tr);
      });
    } catch (error) {
      console.error("Error al cargar las películas:", error);
    }
  }
</script>