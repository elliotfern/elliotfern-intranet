interface TrixEditorElement extends HTMLElement {
    editor: {
      loadHTML: (html: string) => void;
    };
  }
  
/**
 * Funció per omplir els inputs text i select de les pàgines de formularis de modificació.
 * @param url - L'URL de l'API per obtenir les dades.
 * @param id - L'ID de l'element a obtenir.
 * @param formId - L'ID del formulari HTML que s'omplirà.
 * @param callback - La funció de callback que es cridarà amb les dades obtingudes.
 */
export async function omplirDadesForm(url: string, id: number, formId: string, callback: (data: any) => void): Promise<void> {
  const urlAjax = `${url}${id}`;

  try {
    const response = await fetch(urlAjax, {
      method: 'GET',
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${localStorage.getItem('token') || ''}`,
      },
    });

    if (!response.ok) {
      throw new Error('Error en la sol·licitud AJAX');
    }

    const data = await response.json();
    callback(data);

    // Omplir el formulari amb les dades obtingudes
    const form = document.getElementById(formId) as HTMLFormElement;
    if (!form) {
      console.error(`Form with id ${formId} not found`);
      return;
    }

    Object.keys(data[0]).forEach((key) => {
      const input = form.querySelector(`[name="${key}"]`) as HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement;
      if (input) {
        input.value = data[0][key];
      }
    });

    // Carregar contingut en l'editor Trix si està present
    const trixEditor = document.querySelector('trix-editor') as TrixEditorElement;
    if (trixEditor) {
      const trixInput = document.querySelector('input[name="descripcio"]') as HTMLInputElement;
      if (trixInput) {
        trixInput.value = data[0]['descripcio'];
        trixEditor.editor.loadHTML(data[0]['descripcio']);
      }
    }
  } catch (error) {
    console.error('Error:', error);
  }
}