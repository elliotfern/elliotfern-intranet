<?php
$slugArticles = $params['slug'];
?>

<h2 id="titol"></h2>
<h6 id="date"></h6>
<p id="content"></p>

<hr>


</div>

<script>

    // author page info
function articleBlog(slug) {
  let urlAjax = "/api/blog/get/" + slug;
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function (xhr) {
      // Obtener el token del localStorage
      let token = localStorage.getItem('token');

      // Incluir el token en el encabezado de autorización
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },

    success: function (data) {
      try {
        // DOM modifications
        document.getElementById('titol').innerHTML = data.post_title;
        document.getElementById('content').innerHTML = data.post_content;
        document.getElementById('date').innerHTML = formatDate(data.post_date);

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}
articleBlog('<?php echo $slugArticles; ?>')

function formatDate(inputDate) {
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

</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');