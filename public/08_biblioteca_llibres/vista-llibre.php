<?php
$slug = $params['slug'];
?>

<script type="module">
    bookInfoLibrary('<?php echo $slug; ?>')
</script>

    <h1>Library database</h1>
    <h2 id="titolBook"></h2>

    

        <div class="book-info">
            <p id="titolBook"></p>
        
        </div>

        <script>
            // info book
function bookInfoLibrary(slug) {
  let urlAjax = devDirectory + "/api/library/book/" + slug;
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

        const newContent = "Book: " + data.titol;
        const h2Element = document.getElementById('titolBook');
        h2Element.innerHTML = newContent;
      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');