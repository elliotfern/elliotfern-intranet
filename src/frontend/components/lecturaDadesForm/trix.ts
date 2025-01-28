/**
 * Funció per inicialitzar l'editor Trix.
 * @param elementId - L'ID de l'element HTML on s'inicialitzarà l'editor Trix.
 */

interface TrixEditorElement extends HTMLElement {
  editor: {
    loadHTML: (html: string) => void;
  };
}

export function initializeTrixEditor(elementId: string): void {
  const element = document.getElementById(elementId) as HTMLElement;
  if (!element) {
    console.error(`Element with id ${elementId} not found`);
    return;
  }

  // Comprovar si l'editor Trix ja existeix
  if (element.nextElementSibling && element.nextElementSibling.tagName === 'TRIX-EDITOR') {
    console.warn(`Trix editor already initialized for element with id ${elementId}`);
    return;
  }

  // Crear l'element Trix editor
  const trixEditor = document.createElement('trix-editor') as TrixEditorElement;
  trixEditor.setAttribute('input', elementId);

  // Afegir l'element Trix editor al DOM
  element.parentNode?.insertBefore(trixEditor, element.nextSibling);
}
