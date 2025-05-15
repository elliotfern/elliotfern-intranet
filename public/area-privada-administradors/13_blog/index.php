<div class="container">

    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">
            <h1>Blog</h1>

            <?php if (isUserAdmin()) {
                $urlGestio = "/gestio";
            ?>
                <p>
                    <button onclick="window.location.href='<?php echo APP_INTRANET . $url['blog']; ?>/nou-article/'" class="button btn-gran btn-secondari">Nou article</button>
                </p>
            <?php
            } else {
                $urlGestio = "";
            } ?>

            <div id="filters" class="filter-buttons"></div>
            <ul id="articleList" class="mb-3"></ul>
            <div id="pagination"></div>

        </div>
    </main>

</div>

<script>
    let allArticles = [];
    let filteredArticles = [];
    let currentPage = 1;
    const pageSize = 15;
    let currentFilterYear = null;

    async function fetchArticles() {
        const allowedOrigins = ['https://elliot.cat', 'https://historiaoberta.cat'];
        const currentOrigin = window.location.origin;

        if (!allowedOrigins.includes(currentOrigin)) {
            console.error('Acceso no permitido desde este origen');
            return;
        }

        try {
            const response = await fetch('/api/blog/get/?llistatArticles', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Origin': currentOrigin
                },
                credentials: 'include'
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            allArticles = await response.json();
            filteredArticles = [...allArticles];
            renderYearFilters(allArticles);
            displayArticles();
        } catch (error) {
            console.error('Error fetching articles:', error);
        }
    }

    function renderYearFilters(articles) {
        const years = [...new Set(articles.map(a => new Date(a.post_date).getFullYear()))].sort((a, b) => b - a);
        const filtersDiv = document.getElementById('filters');
        filtersDiv.innerHTML = '';

        const allBtn = document.createElement('button');
        allBtn.textContent = 'Tots';
        allBtn.className = `filter-btn${currentFilterYear === null ? ' active' : ''}`;
        allBtn.onclick = () => filterByYear(null);
        filtersDiv.appendChild(allBtn);

        years.forEach(year => {
            const yearBtn = document.createElement('button');
            yearBtn.textContent = year;
            yearBtn.className = `filter-btn${currentFilterYear === year ? ' active' : ''}`;
            yearBtn.onclick = () => filterByYear(year);
            filtersDiv.appendChild(yearBtn);
        });
    }

    function filterByYear(year) {
        currentFilterYear = year;
        currentPage = 1;
        filteredArticles = year ?
            allArticles.filter(a => new Date(a.post_date).getFullYear() === year) : [...allArticles];
        renderYearFilters(allArticles);
        displayArticles();
    }

    function displayArticles() {
        const urlIsAdmin = "<?php echo $urlGestio; ?>";
        const articleList = document.getElementById('articleList');
        articleList.innerHTML = '';

        const start = (currentPage - 1) * pageSize;
        const end = start + pageSize;
        const articlesToShow = filteredArticles.slice(start, end);

        articlesToShow.forEach(article => {
            const li = document.createElement('li');
            li.className = 'article-item';
            li.innerHTML = `
        <h3><a href="https://${window.location.host}${urlIsAdmin}/blog/article/${article.slug}">${article.post_title}</a></h3>
        <p><small>${new Date(article.post_date).toLocaleDateString()}</small></p>
        ${article.post_excerpt ? `<p>${article.post_excerpt}</p>` : ''}
        <p><strong>Categoria:</strong> ${article.tema_ca}</p>
      `;
            articleList.appendChild(li);
        });

        renderPagination();
    }

    function renderPagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        const totalPages = Math.ceil(filteredArticles.length / pageSize);
        for (let i = 1; i <= totalPages; i++) {
            const link = document.createElement('a');
            link.textContent = i;
            link.href = '#';
            link.className = `pagination-link${i === currentPage ? ' current-page' : ''}`;
            link.onclick = (e) => {
                e.preventDefault();
                currentPage = i;
                displayArticles();
            };
            pagination.appendChild(link);
        }
    }

    fetchArticles();
</script>

<style>
    #articleList {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #articleList li {
        border-bottom: 1px solid #ccc;
        padding: 15px 0;
    }

    #articleList li:last-child {
        border-bottom: none;
    }

    #articleList h3 {
        margin: 0 0 5px;
    }

    #articleList p {
        margin: 5px 0;
    }

    h3 {
        text-align: left !important;
    }

    h3 a:link,
    h3 a:visited,
    h3 a:hover {
        text-decoration: underline;
        color: #cb3414 !important;
    }
</style>