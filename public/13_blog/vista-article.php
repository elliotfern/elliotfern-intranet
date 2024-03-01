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
        document.getElementById('date').innerHTML =  formatData(data.post_date);

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}
articleBlog('<?php echo $slugArticles; ?>')

</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');