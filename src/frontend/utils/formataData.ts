export function formatData(inputDate: string): string {
  // Primero intentamos crear una fecha a partir del input
  let date = new Date(inputDate);

  // Si la fecha no es válida, intentamos otros formatos
  if (isNaN(date.getTime())) {
    // Intenta parsear formato YYYY/MM/DD
    date = new Date(inputDate.replace(/-/g, '/'));

    // Si sigue siendo inválido, intentamos un timestamp
    if (isNaN(date.getTime())) {
      return 'Data no vàlida';
    }
  }

  // Verifica si la fecha es de tipo '0000-00-00'
  if (inputDate === '0000-00-00') {
    return 'Data no vàlida';
  }

  // Extrae los componentes de la fecha
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();

  return `${day}-${month}-${year}`;
}
