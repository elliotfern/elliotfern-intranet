<main>
    <div class="container">
        <h2><a href="/gestio/blog">Blog</a> > <a href="/vault">Elliot</a></h2>
        <p><a href='/gestio/vault/nova'><button type='button' class='btn btn-light btn-sm' id='btnAddVault'>Nou article</button></a></p>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Id</th>
                        <th>Article</th>
                        <th>Data publicació</th>
                        <th>Tipus</th>
                        <th>idioma</th>
                        <th>Modifica</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody> <!-- Aquí se agregarán las filas dinámicamente -->
                </tbody>
            </table>
        </div>


    </div>
</main>
<script>
    async function fetchArticles() {
        const allowedOrigins = ['https://elliot.cat', 'https://historiaoberta.cat'];
        const currentOrigin = window.location.origin;

        if (!allowedOrigins.includes(currentOrigin)) {
            console.error('Acceso no permitido desde este origen');
            return;
        }

        try {
            const response = await fetch('/api/historia-oberta/get/?type=llistat-articles', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Origin': currentOrigin
                },
                credentials: 'include' // Incluir credenciales si es necesario
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const articles = await response.json();
            displayArticles(articles);
        } catch (error) {
            console.error('Error fetching articles:', error);
        }
    }

    function displayArticles(articles) {
        const tbody = document.querySelector('.table tbody');
        tbody.innerHTML = ''; // Limpiar el contenido existente

        articles.forEach(article => {
            const row = document.createElement('tr');

            const idCell = document.createElement('td');
            idCell.textContent = article.id;
            row.appendChild(idCell);

            const titleCell = document.createElement('td');
            titleCell.textContent = article.post_title;
            row.appendChild(titleCell);

            const dateCell = document.createElement('td');
            dateCell.textContent = new Date(article.postData).toLocaleDateString();
            row.appendChild(dateCell);

            const typeCell = document.createElement('td');
            typeCell.textContent = article.post_name; // Asumiendo que post_name es el tipo
            row.appendChild(typeCell);

            const idiomaCell = document.createElement('td');
            idiomaCell.textContent = article.idioma; // Asumiendo que post_name es el tipo
            row.appendChild(idiomaCell);

            const modifyCell = document.createElement('td');
            modifyCell.innerHTML = `<a href="/gestio/blog/modifica-article/${article.ID}"><button type="button" class="btn-primari btn-petit">Modifica</button></a>`;
            row.appendChild(modifyCell);

            const deleteCell = document.createElement('td');
            deleteCell.innerHTML = `<button type="button" class="btn-secondari btn-petit " onclick="deleteArticle(${article.ID})">Elimina</button>`;
            row.appendChild(deleteCell);

            tbody.appendChild(row);
        });
    }

    async function deleteArticle(id) {
        try {
            const response = await fetch(`URL_DE_TU_API/${id}`, {
                method: 'DELETE',
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            fetchArticles(); // Refrescar la tabla después de eliminar
        } catch (error) {
            console.error('Error deleting article:', error);
        }
    }

    // Llamar a la función para cargar los artículos al cargar la página
    fetchArticles();
</script>