// globals.js
const server = window.location.hostname;
const devDirectory = "";

// FUNCIONS PER MODIFICAR CADENES DE TEXT I DATES
function normalizeText(text) {
  return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
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

function decodificarEntidadesHTML(texto) {
    var temp = document.createElement("div");
    temp.innerHTML = texto;
    return temp.textContent || temp.innerText || "";
}

// UTILITATS
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

// FUNCIONS PER CONNECTAR AMB L'API I MOSTRAR DADES
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

  // FUNCIÓ PER DEMANAR PER GET INFORMACIO A LA BD I MOSTRAR-LA EN PANTALLA
  function connexioApiGetDades(url, id, urlImg1, urlImg2, callback) {
    let urlAjax = url + id;
    $.ajax({
      url: urlAjax,
      method: "GET",
      dataType: "json",
      beforeSend: function(xhr) {
        // Obtener el token del localStorage
        let token = localStorage.getItem('token');
        // Incluir el token en el encabezado de autorización
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
      },
      success: function(data) {
         // Si la data es un array y tiene al menos un elemento
         if (Array.isArray(data) && data.length > 0) {
          // Utiliza el primer elemento del array
          data = data[0];
        }
        
        try {
           /// Iterar sobre todas las propiedades del objeto data
        for (let key in data) {
            if (data.hasOwnProperty(key)) {
              let value = data[key];
              // Si la propiedad es una fecha, formatearla utilizando la función formatData
              if (key === "dateCreated" || key === "dateModified" || key === "dataVista") {
                value = formatData(value);
              }
              // Verificar si existe un elemento con el ID correspondiente en el DOM
              let element = document.getElementById(key);
              if (element) {
                // Decodificar entidades HTML
                value = decodificarEntidadesHTML(value);
                // Actualizar el DOM con la información recibida
                if (key === "nameImg") {
                    element.src = `${window.location.origin}/public/00_inc/img/${urlImg1}/${urlImg2}/${value}.jpg`;
                } else {
                    element.innerHTML = value;
                }
              }
            }
          }
          
          // Ejecutar la función de devolución de llamada si se proporciona
          if (typeof callback === 'function') {
            callback(data);
          }
        } catch (error) {
          console.error('Error al parsear JSON:', error); // Muestra el error de parsing
        }
      }
    });
  }

// FUNCIO PER CONSTRUIR TAULES QUE DEPENEN D'UNA ALTRA API
function construirTablaFromAPI(url, id, columnas, callback) {
  let urlAjax = url + id;
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function(xhr) {
      // Obtener el token del localStorage si es necesario
      let token = localStorage.getItem('token');
      if (token) {
        // Incluir el token en el encabezado de autorización si está presente
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);
      }
    },
    success: function(data) {
      try {
        // Verificar si hay datos recibidos desde la API
        if (data && data.length > 0) {
          let html = '<table class="table table-striped" id="booksAuthor">';
          html += '<thead class="table-primary"><tr>';

          // Agregar las cabeceras de las columnas
          columnas.forEach(columna => {
            html += '<th>' + columna + '</th>';
          });

          html += '</tr></thead><tbody>';

          // Agregar los datos a la tabla
          data.forEach(fila => {
            html += '<tr>';
            columnas.forEach(columna => {
              if (callback && typeof callback === 'function') {
                html += '<td>' + callback(fila, columna) + '</td>';
              } else {
                html += '<td>' + fila[columna.toLowerCase()] + '</td>';
              }
            });
            html += '</tr>';
          });

          html += '</tbody></table>';

          // Insertar la tabla en el elemento con el ID 'tabla'
          document.getElementById('tabla').innerHTML = html;
        } else {
          // No se hace nada si no hay datos recibidos desde la API
          console.log('No se han recibido datos desde la API.');
        }
      } catch (error) {
        console.error('Error al parsear JSON:', error); // Mostrar el error de parsing
      }
    }
  });
}