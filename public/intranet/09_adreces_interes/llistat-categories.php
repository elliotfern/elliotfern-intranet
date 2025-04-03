<script type="module">
    categoriesLinks();
</script>

<div class="container">
    <main>
        <div class="container">
            <h1>Adreces d'interés: llistat categories</h1>
            <h6><a href="<?php echo APP_INTRANET . $url['adreces']; ?>">Adreces</a> > Llistat categories </h6>
            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['adreces']; ?>/nou-link/'" class="button btn-gran btn-secondari">Afegir enllaç</button>

            </p>

            <div class="table-responsive">
                <table class="table table-striped" id="categoriesLinks">
                    <thead class="table-primary">
                        <tr>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div>
    </main>
</div>
<script>
    async function categoriesLinks() {
        const urlAjax = `/api/adreces/get/?type=categories`;


        try {
            const response = await fetch(urlAjax, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json"
                }
            });

            if (!response.ok) {
                throw new Error(`Error en la API: ${response.statusText}`);
            }

            const data = await response.json();
            let html = '';

            data.forEach(item => {
                html += `
                <tr>
                    <td><a id="${item.id}" title="Show category" href="https://${window.location.host}/gestio/adreces/categoria/${item.id}">${item.genre}</a></td>
                </tr>`;
            });

            document.querySelector('#categoriesLinks tbody').innerHTML = html;
        } catch (error) {
            console.error("Error en la solicitud:", error);
        }
    }
</script>