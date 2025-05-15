<?php
$slug = $routeParams[0];
?>

<div class="container">

    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">
            <h1>Blog</h1>

            <?php if (isUserAdmin()) : ?>
                <p>
                    <button onclick="window.location.href='<?php echo APP_INTRANET . $url['blog']; ?>/modifica-article/<?php echo $slug ?>'" class="button btn-gran btn-secondari">Modifica article</button>
                </p>
            <?php endif; ?>

            <article id="articleContent">
                <h2 id="postTitle"></h2>
                <p id="postDate" style="font-style: italic; color: #555;"></p>

                <div id="postCategory" style="margin-bottom: 10px; color: #007bff;"></div>
                <div id="postBody"></div>
            </article>

        </div>
    </main>

</div>

<script>
    document.addEventListener("DOMContentLoaded", async () => {
        const slug = "<?php echo $slug; ?>";

        try {
            const response = await fetch(`/api/blog/get/?articleSlug=${slug}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) throw new Error("Error al cargar el artículo");

            const article = await response.json();

            // Asignar contenido
            document.getElementById("postTitle").textContent = article.post_title;
            document.getElementById("postDate").innerHTML = `Publicat el: ${new Date(article.post_date).toLocaleDateString()} / Darrera modificació: ${ new Date(article.post_modified).toLocaleDateString()}`;
            document.getElementById("postCategory").textContent = `Categoria: ${article.categoria || 'Sense categoria'}`;
            document.getElementById("postBody").innerHTML = article.post_content;

        } catch (error) {
            console.error("Error cargando el artículo:", error);
            document.getElementById("articleContent").innerHTML = "<p>Error carregant l'article.</p>";
        }
    });
</script>