<?php
$slug = $routeParams[0];
?>

<div class="container">
  <div class="barraNavegacio">
    <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>">Biblioteca</a> > <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>/llistat-llibres">LListat de llibres</a> </h6>
  </div>

  <main>
    <div class="container contingut">
      <h1>Biblioteca de llibres: <span id="titolBook"></span></h1>

      <button onclick="window.location.href='<?php echo APP_INTRANET . $url['biblioteca']; ?>/modifica-llibre/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica fitxa</button>

      <div class="dadesFitxa">
        <strong>Aquesta fitxa ha estat creada el: </strong><span id="dateCreated"></span> <span id="dateModified"></span>
      </div>

      <div class='fixaDades'>

        <div class='columna imatge'>
          <img id="nameImg" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' alt='Llibre Photo' title='Llibre photo'>
        </div>

        <div class="columna">

          <div class="quadre-detalls">
            <p><strong>Títol anglès: </strong> <span id="titolEng"></span></p>
            <p><strong>Autor: </strong> <a id="linkAutor" href=""> <span id="nom"></span> <span id="cognoms"></span></a></p>
            <p><strong>Any de publicació: </strong> <span id="any"></span></p>
            <p><strong>Editorial: </strong> <span id="editorial"></span></p>
            <p><strong>Gènere: </strong> <span id="genere_cat"></span></p>
            <p><strong>Sub-gènere: </strong> <span id="sub_genere_cat"></span></p>
            <p><strong>Idioma original: </strong> <span id="idioma_ca"></span></p>
            <p><strong>Tipus d'obra: </strong> <span id="nomTipus"></span></p>
            <p><button type='button' class='button btn-petit'><span id="estat"></span></button></p>
          </div>
        </div>
      </div>


    </div>
  </main>
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

          const fecha = new Date(data.dateCreated);
          const fechaFormateada = fecha.toLocaleDateString('es-ES');
          const fechaFormateada_net = fechaFormateada.replace(/\//g, "-");

          const fecha2 = new Date(data.dateModified);
          const fechaFormateada2 = fecha2.toLocaleDateString('es-ES');
          const fechaFormateada2_net = fechaFormateada2.replace(/\//g, "-");

          // Actualizar el DOM con los datos recibidos
          document.getElementById('titolBook').textContent = data.titol;
          document.getElementById('nameImg').src = `https://media.elliot.cat/img/biblioteca-llibre/${data.nameImg}.jpg`;
          document.getElementById('linkAutor').href = `${window.location.origin}/gestio/biblioteca/fitxa-autor/${data.slugAutor}`;
          document.getElementById('titolEng').textContent = data.titolEng;
          document.getElementById('nom').textContent = data.nom;
          document.getElementById('cognoms').textContent = data.cognoms;
          document.getElementById('any').textContent = data.any;
          document.getElementById('editorial').textContent = data.editorial;
          document.getElementById('genere_cat').textContent = data.genere_cat;
          document.getElementById('sub_genere_cat').textContent = data.sub_genere_cat;
          document.getElementById('idioma_ca').textContent = data.idioma_ca;
          document.getElementById('nomTipus').textContent = data.nomTipus;
          document.getElementById('estat').textContent = data.estat;

          const dateElement = document.getElementById('dateCreated');
          const dateElement2 = document.getElementById('dateModified');
          dateElement.textContent = `${fechaFormateada_net}`;

          // Verifica si la fecha es válida
          if (fechaFormateada2_net == '0000-00-00') {
            dateElement2.textContent = ''; // No mostrar nada si no es válida
          } else if (fechaFormateada_net == fechaFormateada2_net) {
            dateElement2.textContent = '';
          } else {
            dateElement2.innerHTML = `| <strong> Darrera modificació: </strong> ${fechaFormateada2_net}`;

          }


        } catch (error) {
          console.error('Error al parsear JSON:', error);
        }
      })
      .catch(error => {
        console.error('Error en la solicitud:', error);
      });
  }

  // Llamar a la función fetchApiData con la URL de la API y el slug del libro
  fetchApiData("/api/biblioteca/get/?llibreSlug=<?php echo $slug; ?>");
</script>