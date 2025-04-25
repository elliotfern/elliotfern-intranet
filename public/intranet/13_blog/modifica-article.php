<?php
$id = $routeParams[0];
?>

<h6><a href="/cinema/">Cinema i sèries TV</a> > <a href="/cinema/pelicules">Pel·lícules </a></h6>
</div>

<div class="container-fluid form">
    <h2>Modificar pel·lícula</h2>
    <h4 id="titolPeli"></h4>

    <form method="POST" action="" id="modificarPeli" class="row g-3">
        <div class="alert alert-success" id="missatgeOk" style="display:none" role="alert">
            <h4 class="alert-heading"><strong>Dades desades correctament</strong></h4>
            <h6>Les dades s'han desat a la base de dades.</h6>
        </div>

        <div class="alert alert-danger" id="missatgeErr" style="display:none;" role="alert">
            <h4 class="alert-heading"><strong>Error amb les dades</strong></h4>
            <h6></h6>
        </div>

        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

        <div class="col-md-4">
            <label>Títol:</label>
            <input class="form-control" type="text" name="post_title" id="post_title" value="">
        </div>

        <div class="col-md-4">
            <label>Títol en espanyol:</label>
            <input class="form-control" type="text" name="pelicula_es" id="pelicula_es" value="">
        </div>

        <div class="col-md-12">
            <label><strong>Article:</strong></label>
            <!-- Crea un área de texto para Trix -->
            <input type="hidden" id="descripcio" name="descripcio" value="">
            <trix-editor input="descripcio"></trix-editor>
        </div>

        <div class="container" style="margin-top:25px">
            <div class="row">
                <div class="col-6 text-left">
                    <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
                </div>
                <div class="col-6 text-right derecha">
                    <button type="submit" class="btn btn-primary">Actualizar dades</button>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    // cridem funcions externes:
    document.addEventListener('DOMContentLoaded', function() {

        //



        // llançar actualizador dades
        document.getElementById("modificarPeli").addEventListener("submit", function(event) {
            formulariActualizar(event, "modificarPeli", "/api/cinema/put/?peli");
        });
    });
</script>