import { getIsAdmin } from '../../services/auth/isAdmin';

// Función para capitalizar la primera letra de cada palabra
function capitalizeWords(str: string) {
  return str
    .replace(/-/g, ' ') // Reemplaza todos los guiones por espacios
    .split(' ') // Separa por palabras
    .map((word) => {
      // Capitaliza la primera letra de cada palabra, manteniendo el resto en minúsculas
      return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
    })
    .join(' '); // Vuelve a juntar las palabras con espacio
}

export async function barraNavegacio() {
  // Verificamos si el usuario es admin
  const isAdmin = await getIsAdmin();

  // Obtenemos la URL actual del navegador
  const currentUrl = window.location.href;

  // Definir las rutas base
  const baseAdminUrl = 'https://elliot.cat/gestio';
  const baseUserUrl = 'https://elliot.cat';

  // Si el usuario es admin, usamos una URL diferente
  const baseUrl = isAdmin ? baseAdminUrl : baseUserUrl;

  // Obtener los diferentes fragmentos de la URL para construir los enlaces
  const urlParts = currentUrl
    .replace(baseUrl, '')
    .split('/')
    .filter((part) => part);

  // Determinamos qué enlaces mostrar
  let breadcrumbHtml = '<div class="barraNavegacio">';

  // Si el usuario es admin, mostramos "Intranet" y el enlace a la intranet
  if (isAdmin) {
    breadcrumbHtml += `<h6><a href="${baseAdminUrl}">Intranet</a> > `;
  } else {
    // Si no es admin, mostramos "Inici" y el enlace a la página principal
    breadcrumbHtml += `<h6><a href="${baseUserUrl}">Inici</a> > `;
  }

  // Añadimos los enlaces de navegación basados en la URL actual
  if (urlParts.length > 0) {
    urlParts.forEach((part, index) => {
      // Si el fragmento contiene "fitxa", lo ignoramos
      if (part.includes('fitxa')) {
        return;
      }

      // Capitalizamos cada palabra del fragmento
      const capitalizedPart = capitalizeWords(part);

      // Generamos un enlace para cada fragmento de la URL
      const partUrl = `${baseUrl}/${urlParts.slice(0, index + 1).join('/')}`;
      breadcrumbHtml += `<a href="${partUrl}">${capitalizedPart}</a>`;

      // Si no es el último fragmento, añadimos el separador ">"
      if (index < urlParts.length - 1) {
        breadcrumbHtml += ' > ';
      }
    });
  }

  breadcrumbHtml += '</h6></div>';

  // Insertamos el HTML generado en el contenedor adecuado
  const elementHTML = document.getElementById('barraNavegacioContenidor');
  if (elementHTML) {
    elementHTML.innerHTML = breadcrumbHtml;
  }
}
