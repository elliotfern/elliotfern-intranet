<?php
$slug = $params['slug'];
?>

<h1>Biblioteca de llibres</h1>
<h3 id="titolBook"></h3>
<h6><a href="<?php echo APP_DEV;?>/biblioteca/">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/llibres/">Llibres </a></h6>

<div class='row'>
             <div class='col-sm-8'>
             <img id="nameImg" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Llibre Photo' title='Llibre photo'>
            
       </div>
       <div class="col-sm-4">
       <p><a id="modificaLlibreUrl" href="" class="btn btn-warning btn-sm">Modifica les dades</a><p>

               <div class="alert alert-primary" role="alert" style="margin-top:10px">
                  <p><h3> <span id="titol"></span></h3></p>
                  <p><strong>Títol anglès: </strong> <span id="titolEng"></span></p>
                  <p><strong>Autor: </strong> <a id="linkAutor" href=""> <span id="nom"></span>  <span id="cognoms"></span></a></p>
                  <p><strong>Any de publicació: </strong> <span id="any"></span></p>
                  <p><strong>Editorial: </strong> <span id="editorial"></span></p>
                  <p><strong>Gènere: </strong> <span id="genere_cat"></span></p>
                  <p><strong>Sub-gènere: </strong> <span id="sub_genere_cat"></span></p>
                  <p><strong>Idioma original: </strong> <span id="idioma_ca"></span></p>
                  <p><strong>Tipus d'obra: </strong> <span id="nomTipus"></span></p>
                  <p><strong>Fitxa creada: </strong> <span id="dateCreated"></span></p>
                  <p><strong>Fitxa actualizada: </strong> <span id="dateModified"></span></p>
              </div>
           </div>
      </div>
      </div>
<hr>

     <h3>Col·lecció</h3>
     <p><button type='button' class='btn btn-dark btn-sm' id='btnAddCollection' onclick='addCollectionBook(".$id.")' data-bs-toggle='modal' data-bs-target='#modalCreateBookCollection'>Add new collection</button></p>
     
    <div class="table-responsive">
      <table id="tabla" class="table table-striped"></table>
      </table>
    </div>

</div>

<script>
connexioApiGetDades("/api/biblioteca/get/?llibre-slug=", "<?php echo $slug;?>", "08_biblioteca_llibres", "llibres", function(data) {
  
  // Actualiza el atributo href del enlace con el idDirector
 //document.getElementById('wikipediaLink').href = `${data.AutWikipedia}`;
 //document.getElementById('movimentLink').href = `${window.location.origin}/biblioteca/autors/moviment/${data.idMovement}`;
 //document.getElementById('ocupacioLink').href = `${window.location.origin}/biblioteca/autors/professio/${data.AutOcupacio}`;
 document.getElementById('linkAutor').href = `${window.location.origin}/biblioteca/autor/${data.slugAutor}`;
 //authorBookListLibrary(data.id)
 document.getElementById('modificaLlibreUrl').href = `${window.location.origin}/biblioteca/modifica/llibre/${data.id}`;

 construirTablaFromAPI("/api/biblioteca/get/?colleccio=", data.id, ['Nom', 'Ordre', 'Accions'], function(fila, columna) {
      if (columna === 'Nom') {
        // Manejar el caso del título
        return '<a href="' + window.location.origin + '/biblioteca/llibre/' + fila['slug'] + '">' + fila['Nom'] + '</a>';
      } else if (columna === 'Accions') {
        return '<a href="'+window.location.origin+'/biblioteca/modifica/llibre/' + fila['Ordre'] + '" class="btn btn-secondary btn-sm modificar-link">Modificar</a>';
      } else {
        // Manejar otros casos
        return fila[columna];
      }
  });

});

</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');