// AJAX PROCESS > PHP API : PER ACTUALIZAR FORMULARIS A LA BD
export async function transmissioDadesDB(event: Event, tipus:string, formId: string, urlAjax: string): Promise<void> {
  event.preventDefault();

  const form = document.getElementById(formId) as HTMLFormElement;
  if (!form) {
    console.error(`Form with id ${formId} not found`);
    return;
  }

  // Crear un objeto para almacenar los datos del formulario
  const formData: { [key: string]: FormDataEntryValue } = {};
  new FormData(form).forEach((value, key) => {
    formData[key] = value; // Agregar cada campo al objeto formData
  });

  const jsonData = JSON.stringify(formData);

  try {
    const response = await fetch(urlAjax, {
      method: tipus,
      headers: {
        Accept: 'application/json',
      },
      body: jsonData,
    });

    if (!response.ok) {
      throw new Error('Error en la sol·licitud AJAX');
    }

    const data = await response.json();
    // Aquí pots afegir el codi per gestionar la resposta

    const missatgeOk = document.getElementById('missatgeOk');
    const missatgeErr = document.getElementById('missatgeErr');

    if (data.status === 'success') {
      if (missatgeOk && missatgeErr) {
        missatgeOk.style.display = 'block';
        missatgeErr.style.display = 'none';
        // Agregar texto dinámicamente al div de éxito
        missatgeOk.textContent = "L'operació s'ha realizat correctament a la base de dades.";
      }
    } else {
      if (missatgeOk && missatgeErr) {
        missatgeErr.style.display = 'block';
        missatgeOk.style.display = 'none';
        missatgeErr.textContent = "L'operació no s'ha pogut realizar correctament a la base de dades.";
      }
    }
  } catch (error) {
    const missatgeOk = document.getElementById('missatgeOk');
    const missatgeErr = document.getElementById('missatgeErr');
    if (missatgeOk && missatgeErr) {
      console.error('Error:', error);
      missatgeErr.style.display = 'block';
      missatgeOk.style.display = 'none';
    }
  }
}
