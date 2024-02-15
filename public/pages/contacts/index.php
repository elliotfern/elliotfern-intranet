<div class="container">
  <h2>Agenda de contactes</h2>

  <p><button type='button' class='btn btn-outline-secondary' id='btnCreateLink' onclick='btnCrearContacte()'>Afegir nou contacte &rarr;</button></p>

  <hr>

  <!-- Botones para seleccionar el tipo de contacto -->
  <div class="btn-group" role="group" aria-label="Tipus de contacte" style="margin-bottom:25px">
  <button type="button" class="btn btn-outline-primary active" data-tipus="1">Familia</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="2">Amics</button>
  <button type="button" class="btn btn-outline-primary" data-tipus="3">Feina (HispanTIC)</button>
</div>

  <div class="container d-flex">
    <div class="row gap-3 justify-content-center" id="contactsContainer">
      <!-- Aquí se muestran los contactos -->
    </div>
  </div>
</div>

<script>

  // Función para cargar contactos cada vez que la página se carga
  window.onload = function() {
    // Obtener el tipo de contacto activo
    var tipoActivo = $('.btn-outline-primary.active').data('tipus');
    
    // Obtener los contactos correspondientes al tipo activo
    obtenirContactes(tipoActivo);
  };

   $(document).ready(function() {
    // Manejar clic en los botones de tipo de contacto
    $('button[data-tipus]').click(function() {
      var tipus = $(this).data('tipus');
      obtenirContactes(tipus);

      // Remover la clase 'active' de todos los botones
      $('button[data-tipus]').removeClass('active');
      // Agregar la clase 'active' solo al botón clicado
      $(this).addClass('active');
    });
  });

  function obtenirContactes(tipus) {
    let urlAjax = devDirectory + "/api/contactes/get/?type=contactes&tipus=" + tipus;
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
          let contactsHTML = '';
          data.forEach(contact => {
            contactsHTML += `
              <div class="col-sm-3 quadre">
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
      }
    });
  }

  function cambiarFormatoFecha(fecha) {
  // Dividir la fecha en partes: año, mes y día
  const [any, mes, dia] = fecha.split('-');
  
  // Crear un nuevo objeto Date con el formato "YYYY-MM-DD"
  const fechaObj = new Date(any, mes - 1, dia);
  
  // Formatear la fecha en formato "DD-MM-YYYY" usando Intl.DateTimeFormat
  const formatoFecha = new Intl.DateTimeFormat('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });
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

// Cargar contactos al inicio
obtenirContactes(1); // Mostrar contactos de tipo 1 por defecto
</script>

<?php
# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');

?>