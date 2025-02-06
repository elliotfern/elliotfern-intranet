<main>
    <div class="container">
        <h1>Lectura de Feeds RSS</h1>

        <!-- Botones de categorías -->
        <div id="botones" class="requadre">
            <button id="btnBlogs" class="btn-gran btn-primari">Blogs</button>
            <button id="btnMedios" class="btn-gran btn-primari">Mitjans de comunicació</button>
        </div>

        <!-- Botones de feeds agrupados por categoría -->
        <div id="grupoBlogs" class="hidden requadre">
            <button id="btnFeed1" class="btn-gran btn-secondari">Jaime Gómez-Obregon</button>
            <button id="btnFeed7" class="btn-gran btn-secondari">The Cheis</button>

        </div>

        <div id="grupoMedios" class="hidden requadre">
            <button id="btnFeed2" class="btn-gran btn-secondari">Vilaweb</button>
            <button id="btnFeed3" class="btn-gran btn-secondari">El Pais</button>
            <button id="btnFeed4" class="btn-gran btn-secondari">La Vanguardia</button>
            <button id="btnFeed5" class="btn-gran btn-secondari">BBC World</button>
            <button id="btnFeed6" class="btn-gran btn-secondari">Ara</button>
        </div>

        <div id="feed"></div>
    </div>
</main>

<style>
    .requadre {
        margin-bottom: 30px;
    }

    #feed {
        margin-top: 20px;
        text-align: left;
        display: inline-block;
        width: 80%;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .hidden {
        display: none;
    }

    /* Asegura que las imágenes no se desborden del contenedor */
    img {
        max-width: 100%;
        /* La imagen no puede exceder el ancho del contenedor */
        height: auto;
        /* Mantiene la relación de aspecto original de la imagen */
        object-fit: contain;
        /* Ajusta la imagen para que se ajuste dentro del contenedor sin recortar */
    }
</style>

<script>
    const feeds = [{
            url: "https://jaime.gomezobregon.com/feed",
            buttonId: "btnFeed1",
            categoria: "blogs"
        },
        {
            url: "https://www.vilaweb.cat/feed/",
            buttonId: "btnFeed2",
            categoria: "medios"
        },
        {
            url: "https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/portada",
            buttonId: "btnFeed3",
            categoria: "medios"
        },
        {
            url: "https://www.lavanguardia.com/rss/home.xml",
            buttonId: "btnFeed4",
            categoria: "medios"
        },
        {
            url: "https://feeds.bbci.co.uk/news/world/rss.xml",
            buttonId: "btnFeed5",
            categoria: "medios"
        },
        {
            url: "https://ara.cat/rss",
            buttonId: "btnFeed6",
            categoria: "medios"
        },

        {
            url: "https://thecheis.com/feed/",
            buttonId: "btnFeed7",
            categoria: "blogs"
        }
    ];

    function cargarFeed(url, targetElement) {
        document.getElementById(targetElement).innerHTML = "<p>Cargando...</p>";

        fetch(`/api/lector-rss/get/?url=${encodeURIComponent(url)}`)
            .then(response => {
                const contentType = response.headers.get("Content-Type");
                return contentType.includes("application/json") ? response.json() : response.text();
            })
            .then(data => {
                if (typeof data === "string") {
                    const parser = new DOMParser();
                    const xmlDoc = parser.parseFromString(data, "application/xml");
                    data = procesarXML(xmlDoc);
                }

                let html = "<ul>";
                data.forEach(item => {
                    html += `
                        <li>
                            <a href="${item.link}" target="_blank">${item.title}</a>
                            <p><strong>${item.date}</strong></p>
                            <p>${item.description}</p>
                        </li>`;
                });
                html += "</ul>";

                document.getElementById(targetElement).innerHTML = html;
            })
            .catch(error => {
                console.error(`Error al obtener el feed: ${url}`, error);
                document.getElementById(targetElement).innerHTML = "<p>Error al cargar el feed.</p>";
            });
    }

    feeds.forEach(feed => {
        document.getElementById(feed.buttonId).addEventListener("click", function() {
            cargarFeed(feed.url, "feed");
        });
    });

    // Mostrar u ocultar los feeds según la categoría seleccionada
    document.getElementById("btnBlogs").addEventListener("click", () => {
        document.getElementById("grupoBlogs").classList.toggle("hidden");
        document.getElementById("grupoMedios").classList.add("hidden");
    });

    document.getElementById("btnMedios").addEventListener("click", () => {
        document.getElementById("grupoMedios").classList.toggle("hidden");
        document.getElementById("grupoBlogs").classList.add("hidden");
    });
</script>