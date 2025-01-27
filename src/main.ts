import { cinema } from './pages/cinema/funcions';

document.addEventListener('DOMContentLoaded', () => {
  // Verificar la URL y llamar a las funciones correspondientes
  const normalizedPath = window.location.pathname.replace(/\/$/, '');
  const pathArray = normalizedPath.split('/');
  const pageType = pathArray[pathArray.length - 3]; // Obtenemos el nombre de la página

  if (pageType === 'cinema') {
    cinema();
  }
});

// AJAX PROCESS > PHP API : PER INSERIR FORMULARIS A LA BD
/*
function formulariInserir(event, formId, urlAjax) {
  // Stop form from submitting normally
  event.preventDefault();
  let formData = $('#' + formId).serialize();

  $.ajax({
    type: 'POST',
    url: urlAjax,
    dataType: 'json',
    beforeSend: function (xhr) {
      // Obtener el token del localStorage
      let token = localStorage.getItem('token');

      // Incluir el token en el encabezado de autorización
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },
    data: formData,
    success: function (response) {
      if (response.status == 'success') {
        // Add response in Modal body
        $('#creaOk').show();
        $('#creaErr').hide();
      } else {
        $('#creaErr').show();
        $('#creaOk').hide();
      }
    },
  });
}
*/
