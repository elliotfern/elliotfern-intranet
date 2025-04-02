<?php
if (isset($routeParams[0])) {
    $id = $routeParams[0];
}

?>

<div class="container">
    <main>
        <div class="container">
            <h1>Adreces d'interés: llistat categories</h1>
            <h2 id="titolCategoria"></h2>
            <h6><a href="<?php echo APP_INTRANET . $url['adreces']; ?>">Adreces</a> > <a href="<?php echo APP_INTRANET . $url['adreces']; ?>/llistat-categories/">Llistat categories</a></h6>
            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['adreces']; ?>/nou-link/'" class="button btn-gran btn-secondari">Afegir enllaç</button>

            </p>

            <div class="table-responsive">
                <table class="table table-striped" id="categoriaLinks">
                    <thead class="table-primary">
                        <tr>
                            <th>Tema</th>
                            <th>Accions</th>
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
                    <td>
                        <button type="button" onclick="btnUpdateBook(${item.id})" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="${item.id}">Update</button>
                        <button type="button" onclick="btnDeleteBook(${item.id})" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBook" data-id="${item.id}">Delete</button>
                    </td>
                </tr>
            `;
            });

            document.querySelector('#categoriaLinks tbody').innerHTML = html;
        } catch (error) {
            console.error('Error en la solicitud:', error);
        }
    }
</script>