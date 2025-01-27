export function formatData(inputDate: string): string {
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
