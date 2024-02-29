<?php
$id = $params['id'];
?>

<h6><a href="<?php echo APP_DEV;?>/biblioteca">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/llibres">Llibres </a></h6>
</div>

<div class="container-fluid form">
    <h2>Modificar les dades del llibre</h2>
    <h4 id="bookUpdateTitle"></h4>
          
<div class="alert alert-success" id="updateOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></strong></h4>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>
      
<div class="alert alert-danger" id="updateErr" style="display:none;" role="alert">
<h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT?></strong></h4>
<h6><?php echo ERROR_TYPE_MESSAGE?></h6>
</div>

<form method="POST" action="" id="modificaLlibre" class="row g-3">
<?php $timestamp = date('Y-m-d');?>
<input type="hidden" id="id" name="id" value="<?php echo $id;?>">

            <div class="col-md-4">
              <label>Títol original:</label>
              <input class="form-control" type="text" name="titol" id="titol" value="">
            </div>
          
          <div class="col-md-4">
            <label>Títol en anglés:</label>
            <input class="form-control" type="text" name="titolEng" id="titolEng" value="">
          </div>

          <div class="col-md-4">
            <label>Slug:</label>
            <input class="form-control" type="text" name="slug" id="slug" value="">
          </div>

            <div class="col-md-4">
              <label>Autor:</label>
              <select class="form-select" name="autor" id="autor" value="">
              </select>
            </div>

          <div class="col-md-4">
            <label>Imatge coberta:</label>
            <select class="form-select" name="img" id="img" value="">
            </select>
          </div>

            <div class="col-md-4">
              <label>Any de publicació:</label>
              <input class="form-control" type="text" name="any" id="any" value="">
            </div>
      
          <div class="col-md-4">
            <label> Editorial:</label>
            <select class="form-select" name="idEd" id="idEd" value="">
            </select>
          </div>
      
          <div class="col-md-4">
          <label>Gènere:</label>
          <select class="form-select" name="idGen" id="idGen" value="">
          </select>
         </div>

         <div class="col-md-4">
          <label>Sub-gènere:</label>
          <select class="form-select" name="subGen" id="subGen" value="">
          </select>
         </div>
      
          <div class="col-md-4">
          <label>Idioma:</label>
          <select class="form-select" name="lang" id="lang" value="">
          </select>
          </div>
      
          <div class="col-md-4">
          <label>Tipus:</label>
          <select class="form-select" name="tipus" id="tipus" value="">
          </select>
          </div>

          <div class="col-md-4">
          <label>Estat del llibre:</label>
          <select class="form-select" name="estat" id="estat">
          </select>
          </div>
              
          <div class="container" style="margin-top:25px">
            <div class="row">
              <div class="col-6 text-left">
              <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
              </div>
              <div class="col-6 text-right derecha">
              <button type="submit" class="btn btn-primary">Modifica llibre</button>
              </div>
            </div>
          </div>
    </form>

</div>

 <script>
evitarTancarFinestra();
bookInfoLibrary('<?php echo $id; ?>')

function bookInfoLibrary(id) {
  let urlAjax = "/api/biblioteca/get/?llibre-id=" + id;
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
        const newContent = "Llibre: " + data.titol;
        const h2Element = document.getElementById('bookUpdateTitle');
        h2Element.innerHTML = newContent;

        document.getElementById('titol').value = data.titol;
        document.getElementById('titolEng').value = data.titolEng;
        document.getElementById('slug').value = data.slug;
        document.getElementById('any').value = data.any;

        // (idAux, api, elementId, valorText) {
        auxiliarSelect("/api/biblioteca/auxiliars/?type=", data.autor, "autors", "autor", "nomComplet");
        auxiliarSelect("/api/biblioteca/auxiliars/?type=", data.img, "imatgesLlibres", "img", "alt");
        auxiliarSelect("/api/biblioteca/auxiliars/?type=", data.idEd, "editorials", "idEd", "editorial");
        auxiliarSelect("/api/biblioteca/auxiliars/?type=", data.idGen, "generes", "idGen", "genere_cat");
        auxiliarSelect("/api/biblioteca/auxiliars/?type=", data.subGen, "subgeneres", "subGen", "sub_genere_cat");
        auxiliarSelect("/api/biblioteca/auxiliars/?type=", data.lang, "llengues", "lang", "idioma_ca");
        auxiliarSelect("/api/biblioteca/auxiliars/?type=", data.tipus, "tipus", "tipus", "nomTipus");
        auxiliarSelect("/api/biblioteca/auxiliars/?type=", data.estat, "estatLlibre", "estat", "estat");

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

// llançar actualizador dades
document.getElementById("modificaLlibre").addEventListener("submit", function(event) {
    formulariActualizar(event, "modificaLlibre", "/api/biblioteca/put/?llibre");
});

</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');