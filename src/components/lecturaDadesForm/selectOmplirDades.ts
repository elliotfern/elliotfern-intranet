/**
 * Funció per omplir un select amb dades auxiliars.
 * @param url - L'URL de l'API per obtenir les dades auxiliars.
 * @param selectedValue - El valor seleccionat actualment.
 * @param selectId - L'ID del select HTML que s'omplirà.
 * @param valueField - El camp de les dades que s'utilitzarà com a valor del select.
 * @param textField - El camp de les dades que s'utilitzarà com a text del select.
 */
export async function selectOmplirDades(url: string, selectedValue: number, selectId: string, textField: string): Promise<void> {
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error('Error en la sol·licitud AJAX');
    }

    const data = await response.json();
    const selectElement = document.getElementById(selectId) as HTMLSelectElement;
    if (!selectElement) {
      console.error(`Select element with id ${selectId} not found`);
      return;
    }

    // Netejar les opcions actuals
    selectElement.innerHTML = '';

    // Afegir les noves opcions
    data.forEach((item: any) => {
      const option = document.createElement('option');
      option.value = item.id;
      option.text = item[textField];
      if (item.id === selectedValue) {
        option.selected = true;
      }
      selectElement.appendChild(option);
    });
  } catch (error) {
    console.error('Error:', error);
  }
}
