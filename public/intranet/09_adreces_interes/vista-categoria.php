<?php
if (isset($routeParams[0])) {
    $id = $routeParams[0];
}

?>

<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['adreces']; ?>">Adreces d'interès</a> > <a href="<?php echo APP_INTRANET . $url['adreces']; ?>/llistat-categories">Llistat de categories</a></h6>
    </div>

    <main>
        <div class="container">
            <h1>Adreces d'interés: llistat categories</h1>
            <h2 id="titolCategoria"></h2>
            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['adreces']; ?>/nou-link/'" class="button btn-gran btn-secondari">Afegir enllaç</button>

            </p>

            <div class="table-responsive">
                <table class="table table-striped" id="categoriaLinks">
                    <thead class="table-primary">
                        <tr>
                            <th>Tema</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    categoriaAllTopics('<?php echo $id; ?>');

    async function categoriaAllTopics(idCategoria) {
        const urlAjax = `/api/adreces/get/?type=categoria&id=${idCategoria}`;


        try {
            const response = await fetch(urlAjax, {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

            if (data.length > 0) {
                const newContent = `Categoria: ${data[0].genre}`;
                document.getElementById('titolCategoria').innerHTML = newContent;
            }

            let html = '';
            data.forEach(item => {
                html += `
                <tr>
                    <td><a id="${item.id}" title="Show category" href="../tema/${item.idTema}">${item.tema}</a></td>
                </tr>
            `;
            });

            document.querySelector('#categoriaLinks tbody').innerHTML = html;
        } catch (error) {
            console.error('Error en la solicitud:', error);
        }
    }
</script>