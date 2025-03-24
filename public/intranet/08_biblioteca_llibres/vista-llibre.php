<?php
$slug = $routeParams[0];
?>

<h1>Biblioteca de llibres</h1>
<h3 id="titolBook"></h3>
<h6><a href="/gestio/biblioteca/">Biblioteca</a> > <a href="/biblioteca/llibres/">Llibres </a></h6>

<div class='row'>
  <div class='col-sm-8'>
    <img id="nameImg" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Llibre Photo' title='Llibre photo'>
  </div>
  <div class="col-sm-4">
    <p><a id="modificaLlibreUrl" href="" class="btn btn-warning btn-sm">Modifica les dades</a>
    <p>

    <div class="quadre-detalls">
      <p>
      <h3> <span id="titol"></span></h3>
      </p>
      <p><strong>Títol anglès: </strong> <span id="titolEng"></span></p>
      <p><strong>Autor: </strong> <a id="linkAutor" href=""> <span id="nom"></span> <span id="cognoms"></span></a></p>
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
<hr>

<h3>Col·lecció</h3>
<p><button type='button' class='btn btn-dark btn-sm' id='btnAddCollection' onclick='addCollectionBook("<?php echo $slug; ?>")' data-bs-toggle='modal' data-bs-target='#modalCreateBookCollection'>Add new collection</button></p>

<div class="table-responsive">
  <table id="tabla" class="table table-striped"></table>
</div>

<script>
  // Función para realizar la solicitud a la API
  function fetchApiData(url) {
    fetch(url, {
        method: "GET",
        headers: {
          'Content-Type': 'application/json',
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        console.log('Datos recibidos:', data); // Ver los datos recibidos
        // Procesar la respuesta JSON
        if (Array.isArray(data) && data.length > 0) {
          data = data[0];
        }
        try {
          // Actualizar el DOM con los datos recibidos
          document.getElementById('titolBook').textContent = data.titol;
          document.getElementById('nameImg').src = `https://media.elliot.cat/img/library-book/${data.nameImg}.jpg`;
          document.getElementById('modificaLlibreUrl').href = `${window.location.origin}/gestio/biblioteca/llibre/modifica/${data.id}`;
          document.getElementById('modificaLlibreUrl').href = `${window.location.origin}/gestio/biblioteca/modifica/llibre/${data.id}`;
          document.getElementById('linkAutor').href = `${window.location.origin}/gestio/biblioteca/autor/fitxa/${data.slugAutor}`;
          document.getElementById('titol').textContent = data.titol;
          document.getElementById('titolEng').textContent = data.titolEng;
          document.getElementById('nom').textContent = data.nom;
          document.getElementById('cognoms').textContent = data.cognoms;
          document.getElementById('any').textContent = data.any;
          document.getElementById('editorial').textContent = data.editorial;
          document.getElementById('genere_cat').textContent = data.genere_cat;
          document.getElementById('sub_genere_cat').textContent = data.sub_genere_cat;
          document.getElementById('idioma_ca').textContent = data.idioma_ca;
          document.getElementById('nomTipus').textContent = data.nomTipus;
          document.getElementById('dateCreated').textContent = data.dateCreated;
          document.getElementById('dateModified').textContent = data.dateModified;
        } catch (error) {
          console.error('Error al parsear JSON:', error);
        }
      })
      .catch(error => {
        console.error('Error en la solicitud:', error);
      });
  }

  // Llamar a la función fetchApiData con la URL de la API y el slug del libro
  fetchApiData("/api/biblioteca/get/autors/?type=llibreSlug&slug=<?php echo $slug; ?>");
</script>