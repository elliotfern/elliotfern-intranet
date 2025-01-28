// Verificar la URL y llamar a las funciones correspondientes

export function getPageType(num: number): string {
  const normalizedPath = window.location.pathname.replace(/\/$/, '');
  const pathArray = normalizedPath.split('/');
  const pageType = pathArray[pathArray.length - num]; // Obtenemos el nombre de la página
  return pageType;
}
