  <h2>Agenda de contactes</h2>

  <p><button type='button' class='btn btn-outline-secondary' id='btnCreateLink' onclick='btnCrearContacte()'>Afegir nou contacte &rarr;</button></p>

  <hr>

  <!-- Campo de búsqueda -->
  <div class="input-group mb-3 quadre-cercador">
    <input type="text" class="form-control" placeholder="Cercar contacte" id="searchInput">
    <button class="btn btn-outline-secondary" type="button" onclick="buscarContactos()">Cercar</button>
  </div>

  <!-- Botones para seleccionar el tipo de contacto -->
  <div class="btn-group" role="group" aria-label="Tipus de contacte" style="margin-bottom:25px">
    <button type="button" class="btn btn-outline-primary active" data-tipus="0">Tots els contactes</button>
    <button type="button" class="btn btn-outline-primary" data-tipus="1">Familia</button>
    <button type="button" class="btn btn-outline-primary" data-tipus="2">Amics</button>
    <button type="button" class="btn btn-outline-primary" data-tipus="3">Feina (HispanTIC)</button>
  </div>

  <div class="container">
    <div class="row gap-3 justify-content-center" id="contactsContainer">
      <!-- Aquí se muestran los contactos -->
    </div>
  </div>
  </div>

  <script>
    // Función para cargar contactos cada vez que la página se carga
    window.onload = function() {
      // Obtener el tipo de contacto activo
      var tipoActivo = document.querySelector('.btn-outline-primary.active').dataset.tipus;

      // Obtener los contactos correspondientes al tipo activo
      obtenirContactes(tipoActivo);

      // Escuchar el evento de entrada en el campo de búsqueda
      document.getElementById('searchInput').addEventListener('input', buscarContactos);

      // Manejar clic en los botones de tipo de contacto
      document.querySelectorAll('button[data-tipus]').forEach(function(button) {
        button.addEventListener('click', function() {
          var tipus = this.dataset.tipus;
          obtenirContactes(tipus);

          // Remover la clase 'active' de todos los botones
          document.querySelectorAll('button[data-tipus]').forEach(function(btn) {
            btn.classList.remove('active');
          });
          // Agregar la clase 'active' solo al botón clicado
          this.classList.add('active');
        });
      });
    };

    function obtenirContactes(tipus) {
      // Si se selecciona "Tots", no pasamos ningún tipo de contacto como parámetro
      let devDirectory = "https://" + window.location.hostname;
      let urlAjax = devDirectory + "/api/contactes/get/?type=contactes";
      if (tipus !== 0) {
        urlAjax += "&tipus=" + tipus;
      }

      fetch(urlAjax, {
          method: "GET",
          headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
          }
        })
        .then(response => response.json())
        .then(data => {
          try {
            // Modificaciones del DOM
            let contactsHTML = '';
            data.forEach(contact => {
              contactsHTML += `
          <div class="col-sm-3 col-md-3 quadre">
            <h6 style="background-color:black;color:white;padding:5px;display:inline;">${contact.tipus}</h6>
            <h3 style="margin-top: 15px;">${contact.nom} ${contact.cognoms}</h3>`;
              if (contact.email !== null) {
                contactsHTML += `<p class="links-contactes"><strong>Email:</strong> <a href='mailto:${contact.email}'>${contact.email}</a></p>`;
              }
              contactsHTML += `<p><strong>Telèfon 1:</strong> ${contact.tel_1}</p>`;

              if (contact.tel_2 !== null) {
                contactsHTML += `<p><strong>Telèfon 2: </strong> ${contact.tel_2}</p>`;
              }

              if (contact.tel_3 !== null) {
                contactsHTML += `<p><strong>Telèfon 3: </strong> ${contact.tel_3}</p>`;
              }

              if (contact.data_naixement !== null) {
                const fechaFormateada = cambiarFormatoFecha(contact.data_naixement);
                contactsHTML += `<p><strong>Aniversari:</strong> ${fechaFormateada}</p>`;
              }

              if (contact.adreca !== null) {
                contactsHTML += `<p><strong>Adreça:</strong> ${contact.adreca}</p>`;
              }

              contactsHTML += `<p><strong>País:</strong> ${contact.country}</p>`;
              contactsHTML += `
        <button type='button' class='btn btn-secondary btn-sm' onclick='modificaContacte(${contact.id})'>Modificar</button>
        <button type='button' class='btn btn-dark btn-sm' onclick='eliminaContacte(${contact.id})'>Eliminar</button>
        </div>`;
            });
            document.getElementById('contactsContainer').innerHTML = contactsHTML;
          } catch (error) {
            console.error('Error al parsear JSON:', error); // Muestra el error de parsing
          }
        })
        .catch(error => console.error('Error en la solicitud:', error));
    }

    function cambiarFormatoFecha(fecha) {
      // Dividir la fecha en partes: año, mes y día
      const [any, mes, dia] = fecha.split('-');

      // Crear un nuevo objeto Date con el formato "YYYY-MM-DD"
      const fechaObj = new Date(any, mes - 1, dia);

      // Formatear la fecha en formato "DD-MM-YYYY" usando Intl.DateTimeFormat
      const formatoFecha = new Intl.DateTimeFormat('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
      });
      const fechaFormateada = formatoFecha.format(fechaObj);

      return fechaFormateada;
    }

    // INPUT BOTO - CREAR CONTACTE
    function btnCrearContacte() {
      let url = '/contactes/nou/';

      // Redirigir a la URL especificada
      window.location.href = url;
    }

    // INPUT BOTO - MODIFICAR CONTACTE
    function modificaContacte(id) {
      let url = '/contactes/modifica/' + id;

      // Redirigir a la URL especificada
      window.location.href = url;
    }

    // Función para buscar contactos
    function buscarContactos() {
      var textoBusqueda = normalizeText(document.getElementById('searchInput').value);

      // Filtrar contactos según el texto de búsqueda normalizado
      document.querySelectorAll('#contactsContainer .quadre').forEach(function(quadre) {
        var nombre = normalizeText(quadre.querySelector('h3').textContent);
        var apellidos = normalizeText(quadre.querySelector('p:nth-of-type(2)')?.textContent || '');
        if (nombre.includes(textoBusqueda) || apellidos.includes(textoBusqueda)) {
          quadre.style.display = 'block';
        } else {
          quadre.style.display = 'none';
        }
      });
    }

    function normalizeText(text) {
      return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    // Cargar contactos al inicio
    obtenirContactes(1); // Mostrar contactos de tipo 1 por defecto
  </script>