// Definir la interfaz del tipo de dato que esperamos de la API
interface PasswordRecord {
  service_name: string;
  user_name: string;
  password: string;
  type: string;
  modified_at: string;
}

// Función para obtener los datos de la API
export async function serveisVaultApi() {
  try {
    const response = await fetch('https://elliotfern.com/api/vault/get/?llistat_serveis');

    if (!response.ok) {
      throw new Error('Error al obtener los datos de la API');
    }

    // Recibimos la respuesta como texto
    let responseText = await response.text();

    // Eliminar las comillas simples iniciales y finales
    if (responseText.startsWith("'") && responseText.endsWith("'")) {
      responseText = responseText.slice(1, -1); // Elimina las comillas simples del principio y el final
    }

    // Ahora, parseamos el JSON correctamente
    let data = JSON.parse(responseText);

    // Verifica si 'data' es un array
    if (Array.isArray(data)) {
      renderTable(data); // Llama a la función para renderizar la tabla
    } else {
      console.error('Los datos no son un array');
    }
  } catch (error) {
    console.error('Error al parsear JSON:', error);
  }
}
// Función para renderizar los datos en la tabla
// Función para renderizar los datos en la tabla
function renderTable(data: any[]) {
  const tbody = document.querySelector('tbody') as HTMLElement; // Seleccionamos el tbody de la tabla
  tbody.innerHTML = ''; // Limpiamos el contenido actual de la tabla

  // Iteramos sobre los datos y generamos una fila por cada registro
  data.forEach((record) => {
    const row = document.createElement('tr');

    // Celda para "servei", con enlace
    const serviceCell = document.createElement('td');
    const serviceLink = document.createElement('a');
    serviceLink.href = record.web; // Aquí asumes que "web" es el enlace
    serviceLink.target = '_blank'; // Abre en una nueva pestaña
    serviceLink.textContent = record.servei; // El nombre del servicio
    serviceCell.appendChild(serviceLink); // Añadimos el enlace a la celda
    row.appendChild(serviceCell);

    const userCell = document.createElement('td');
    userCell.textContent = record.usuari;
    row.appendChild(userCell);

    // Crear celda para la contraseña con el campo de input tipo password
    const passwordCell = document.createElement('td');
    const passwordInput = document.createElement('input');
    passwordInput.type = 'password';
    passwordInput.id = `passw-${record.id}`; // ID único para cada contraseña
    passwordInput.value = '**********'; // Mostrar asteriscos
    passwordInput.readOnly = true; // Deshabilitar edición

    // Crear el botón "Show" para mostrar/ocultar la contraseña
    const showButton = document.createElement('button');
    showButton.type = 'button';
    showButton.classList.add('btn', 'btn-sm', 'btn-secondary');
    showButton.textContent = 'Show';
    showButton.onclick = function () {
      showPass(record.id);
    };

    // Añadir el campo de contraseña y el botón a la celda
    passwordCell.appendChild(passwordInput);
    passwordCell.appendChild(showButton);
    row.appendChild(passwordCell);

    const typeCell = document.createElement('td');
    typeCell.textContent = record.tipus;
    row.appendChild(typeCell);

    const modifiedCell = document.createElement('td');
    modifiedCell.textContent = record.dateModified;
    row.appendChild(modifiedCell);

    // Crear columnas vacías para los botones de acción
    const editCell = document.createElement('td');
    editCell.innerHTML = `<button class="btn btn-primary">Editar</button>`;
    row.appendChild(editCell);

    const deleteCell = document.createElement('td');
    deleteCell.innerHTML = `<button class="btn btn-danger">Eliminar</button>`;
    row.appendChild(deleteCell);

    // Añadir la fila completa al tbody
    tbody.appendChild(row);
  });
}

// Función para mostrar/ocultar la contraseña
function showPass(id: number): void {
  // Selecciona el campo de entrada de contraseña por su ID
  const inputField = document.getElementById(`passw-${id}`) as HTMLInputElement;

  // Define la URL para la solicitud AJAX
  const urlAjax = `/api/vault/get/?id=${id}`;

  // Verifica si el campo de entrada está ocultando la contraseña (type="password")
  if (inputField.type === 'password') {
    fetch(urlAjax, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
      },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error('Error en la solicitud AJAX');
        }
        return response.json();
      })
      .then((data: { password?: string; error?: string }) => {
        if (data.password) {
          // Si la contraseña está disponible, la muestra
          inputField.value = data.password;
          inputField.type = 'text';

          // Copiar la contraseña al portapapeles
          navigator.clipboard
            .writeText(data.password)
            .then(() => {
              console.log('Contraseña copiada al portapapeles');
            })
            .catch((err) => {
              console.error('Error al copiar al portapapeles: ', err);
            });

          // Ocultar la contraseña después de 5 segundos
          setTimeout(() => {
            inputField.value = '**********'; // Volver al placeholder
            inputField.type = 'password';
          }, 5000);
        } else {
          // Si no se encuentra la contraseña, muestra el error
          inputField.value = data.error || 'Error desconocido';
          inputField.type = 'text';
        }
      })
      .catch((error) => {
        console.error('Error en la solicitud AJAX:', error);
        alert('Hubo un problema al intentar obtener la contraseña.');
      });
  }
}
