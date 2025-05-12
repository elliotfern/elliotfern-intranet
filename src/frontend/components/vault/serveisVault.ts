import { renderDynamicTable } from '../../components/renderTaula/taulaRender';
import { formatData } from '../../utils/formataData';
import { getIsAdmin } from '../../services/auth/isAdmin';

// Definir la interfaz del tipo de dato que esperamos de la API
interface PasswordRecord {
  servei: string;
  usuari: string;
  password: string;
  tipus: string;
  dateModified: string;
  web: string;
  id: number;
}

export async function serveisVaultApi() {
  const isAdmin = await getIsAdmin(); // Comprovar si és admin
  let gestioUrl: string = '';

  if (isAdmin) {
    gestioUrl = '/gestio';
  }

  const columns = [
    {
      header: 'Servei',
      field: 'servei',
      render: (_: unknown, row: PasswordRecord) => `<a id="${row.id}" href="${row.web}" target="_blank">${row.servei}</a>`,
    },
    { header: 'Usuari', field: 'usuari' },
    {
      header: 'Contrasenya',
      field: 'id',
      render: (_: unknown, row: PasswordRecord) => `
        <div class="input-group">
          <input class="form-control input-petit" type="password" name="role" id="passw-${row.id}" value="*******" readonly>
         <button type="button" class="btn-petit btn-primari show-pass-btn" data-id="${row.id}">Show</button>
        </div>
      `,
    },
    { header: 'Tipus', field: 'tipus' },
    {
      header: 'Data modificació',
      field: 'dataVisita',
      render: (_: unknown, row: PasswordRecord) => {
        const inici = formatData(row.dateModified);
        return `${inici}`;
      },
    },
  ];

  if (isAdmin) {
    columns.push({
      header: '',
      field: 'id',
      render: (_: unknown, row: PasswordRecord) => `
        <a href="https://${window.location.host}${gestioUrl}/claus-privades/modifica-vault/${row.id}">
           <button type="button" class="button btn-petit">Modifica</button></a>`,
    });

    columns.push({
      header: '',
      field: 'id',
      render: (_: unknown, row: PasswordRecord) => `
        <a href="https://${window.location.host}${gestioUrl}/claus-privades/modifica-vault/${row.id}">
           <button type="button" class="btn-petit btn-secondari">Elimina</button></a>`,
    });
  }

  renderDynamicTable({
    url: `https://${window.location.host}/api/vault/get/?llistat_serveis`,
    containerId: 'taulaLlistatVault',
    columns,
    filterKeys: ['servei'],
    filterByField: 'tipus',
  });

  setTimeout(() => {
    const buttons = document.querySelectorAll('.show-pass-btn');
    buttons.forEach((button) => {
      button.addEventListener('click', (event) => {
        const target = event.currentTarget as HTMLElement;
        const id = parseInt(target.getAttribute('data-id') || '', 10);
        if (!isNaN(id)) {
          showPass(id);
        }
      });
    });
  }, 500);
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
          navigator.clipboard.writeText(data.password).catch((err) => {
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
