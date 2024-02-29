// globals.js
const server = window.location.hostname;
const devDirectory = "";

function formatoFecha(fecha) {
    // Convierte la fecha al objeto Date
    var date = new Date(fecha);
    
    // Obtiene los componentes de la fecha
    var dia = date.getDate();
    var mes = date.getMonth() + 1; // Los meses comienzan desde 0
    var anio = date.getFullYear();
    
    // Agrega un cero inicial si el día o el mes son menores que 10
    dia = dia < 10 ? '0' + dia : dia;
    mes = mes < 10 ? '0' + mes : mes;
    
    // Formatea la fecha al formato DD-MM-YYYY
    var fecha_formateada = dia + '-' + mes + '-' + anio;
    
    return fecha_formateada;
}

function formatData(inputDate) {
    // Analizar la fecha en formato 'YYYY-MM-DD HH:mm:ss'
    const date = new Date(inputDate);

    // Extraer los componentes de la fecha
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();

    // Formatear la fecha en formato 'DD-MM-YYYY'
    const formattedDate = `${day}-${month}-${year}`;

    return formattedDate;
}

// FUNCIO PER MOSTRAR ELS INPUTS DE TIPUS SELECT
function auxiliarSelect(urlApi, idAux, api, elementId, valorText) {
    let urlAjax = "https://" + server + urlApi + api;
    $.ajax({
      url: urlAjax,
      method: "GET",
      dataType: "json",
      beforeSend: function (xhr) {
        // Obtener el token del localStorage
        let token = localStorage.getItem('token');
  
        // Incluir el token en el encabezado de autorización
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
      },
  
      success: function (data) {
         try {
          // Obtener la referencia al elemento select
          var selectElement = document.getElementById(elementId);
  
          // Limpiar el select por si ya tenía opciones anteriores
          selectElement.innerHTML = "";
  
          // Agregar una opción predeterminada "Selecciona una opción"
          var defaultOption = document.createElement("option");
          defaultOption.text = "Selecciona una opció:";
          defaultOption.value = ""; // Valor vacío
          selectElement.appendChild(defaultOption);
  
          // Iterar sobre los datos obtenidos de la API
          data.forEach(function (item) {
            // Crear una opción y agregarla al select
           // console.log(item.ciutat)
            var option = document.createElement("option");
            option.value = item.id; // Establecer el valor de la opción
            option.text = item[valorText]; // Establecer el texto visible de la opción
            selectElement.appendChild(option);
          });
  
          // Seleccionar automáticamente el valor
          if (idAux) {
            selectElement.value = idAux;
          }
  
        } catch (error) {
          console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
        }
      }
    })
  }


  // FUNCIÓ PER INICIALITZAR L'EDITOR DE PHP ENRIQUIT TRIX
  function initializeTrixEditor(querySelector) {
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el editor Trix
        var editor = document.querySelector('#'+querySelector);

        // Verificar si el editor Trix se encontró correctamente
        if (editor) {
            // Escuchar el evento 'trix-change' para detectar cambios en el editor Trix
            editor.addEventListener('trix-change', function(event) {
                // Obtener el contenido actual del editor Trix
                var descripcio = editor.value;

                // Actualizar el valor del campo oculto con el contenido del editor Trix
                document.getElementById(querySelector).value = descripcio;
            });
        } else {
            console.error('No se encontró el editor Trix en el documento.');
        }
    });
}
// AJAX PROCESS > PHP API : PER INSERIR FORMULARIS A LA BD
function formulariInserir(event, formId, urlAjax) {

  // Stop form from submitting normally
  event.preventDefault();
  let formData = $("#" + formId).serialize();

  $.ajax({
    type: "POST",
    url: urlAjax,
    dataType: "json",
    beforeSend: function (xhr) {
      // Obtener el token del localStorage
      let token = localStorage.getItem('token');

      // Incluir el token en el encabezado de autorización
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },
    data: formData,
    success: function (response) {
      if (response.status == "success") {
        // Add response in Modal body
        $("#creaOk").show();
        $("#creaErr").hide();
      } else {
        $("#creaErr").show();
        $("#creaOk").hide();
      }
    },
  });
}

// AJAX PROCESS > PHP API : PER ACTUALIZAR FORMULARIS A LA BD
function formulariActualizar(event, formId, urlAjax) {

    // Stop form from submitting normally
    event.preventDefault();

    // Obtener los datos del formulario como un objeto JSON
    var formData = Object.fromEntries(new FormData(document.getElementById(formId)));
    
    // Convertir el objeto en una cadena JSON
    var jsonData = JSON.stringify(formData);
        
    
    $.ajax({
      contentType: "application/json", // Establecer el tipo de contenido como JSON
      type: "PUT",
      url: urlAjax,
      dataType: "JSON",
      beforeSend: function (xhr) {
        // Obtener el token del localStorage
        let token = localStorage.getItem('token');
    
        // Incluir el token en el encabezado de autorización
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
      },
      data: jsonData,
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#updateOk").show();
          $("#updateErr").hide();
        } else {
          $("#updateErr").show();
          $("#updateOk").hide();
        }
      },
    });
}

function evitarTancarFinestra() {
  window.addEventListener('beforeunload', function(event) {
    // Cancela el evento de cierre predeterminado
    event.preventDefault();
    // Mensaje de advertencia
    event.returnValue = '';
    // Muestra el mensaje de advertencia
    alert('¿Estás seguro que quieres cerrar la ventana?');
});  
}


function formNomesNumeros(){
    const inputs = document.querySelectorAll('.soloNumeros');

    inputs.forEach(input => {
    input.addEventListener('input', function() {
        if (isNaN(this.value)) {
        this.value = ''; // Limpiar el valor si no es un número
        }
    });
    });
}

  // FUNCIÓ PER OMPLIR ELS INPUTS TEXT I SELECT DE LES PAGINES DE FORMULARIS MODIFICACIO
  function formulariOmplirDades(url, id, formId, callback) {
    let urlAjax = url + id;
    $.ajax({
      url: urlAjax,
      method: "GET",
      dataType: "json",
      beforeSend: function (xhr) {
        // Obtener el token del localStorage
        let token = localStorage.getItem('token');
        // Incluir el token en el encabezado de autorización
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
      },
      success: function (data) {
        try {
          // Llenar el formulario con los datos obtenidos
          $('#' + formId).find('input, textarea').each(function() {
            let campo = $(this).attr('name');
            $(this).val(data[0][campo]);
          });
  
          // Cargar contenido en el editor Trix si está presente
          if (document.querySelector("trix-editor")) {
            var texto_desde_bd = data[0].descripcio;
            var editor = document.querySelector("trix-editor");
            editor.editor.loadHTML(texto_desde_bd);
          }
         
          // Ejecutar la función de devolución de llamada si se proporciona
          if (typeof callback === 'function') {
            callback(data);
          }
  
        } catch (error) {
          console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
        }
      }
    });
  }
  