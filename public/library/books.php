<?php

# conectare la base de datos
$activePage = "library";

echo '<div class="container">';
echo '<h1>Database</h1>';
echo '<h2>Welcome!</h2>';

echo "<input type='hidden' id='url' value='".APP_SERVER."'/>";

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_BOOKS_ADD."</button>
        <button type='button' class='btn btn-dark btn-sm' id='btnAddAuthor2' onclick='btnCreateAuthor()' data-bs-toggle='modal' data-bs-target='#modalCreateAuthor'>".LIBRARY_AUTHORS_ADD."</button></p>
        
        <p><button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_PUBLISHER_ADD."</button>
        <button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_GENRE_ADD."</button>
        <button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_TOPIC_ADD."</button></p>";

echo "<hr>";
echo "<p><a href='".BIBLIOTECA_LLISTAT_EDITORIALS."' class='btn btn-info btn-sm' role='button' aria-pressed='true'>".LIBRARY_PUBLISHER_LIST."</a>
    <a href='".BIBLIOTECA_LLISTAT_GENERES."' class='btn btn-info btn-sm' role='button' aria-pressed='true'>".LIBRARY_GENRE_LIST."</a>
    <a href='".BIBLIOTECA_LLISTAT_TEMES."' class='btn btn-info btn-sm' role='button' aria-pressed='true'>".LIBRARY_TOPIC_LIST."</a>
    <a href='".BIBLIOTECA_LLISTAT_LLIBRES_SENSE_TEMA."' class='btn btn-info btn-sm' role='button' aria-pressed='true'>".LIBRARY_BOOKS_WITHOUT_TOPIC."</a>
    <a href='authors.php' class='btn btn-primary btn-sm' role='button' aria-pressed='true'>Authors</a></p>";

    ?>
        <div class="table-responsive">
            <table class="table table-striped" id="books">
                <thead class="table-primary">
        <tr>
            <th>Book</th>
            <th>Author</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Collection</th>
            <th></th>
            <th></th>
    </tr>
    </thead>
    <tbody></tbody>
    </table>
    
    <script>
        $(document).ready(function(){
            function fetch_data(){
                var urlRoot = $("#url").val();
                var controller = "/controller/library.php?type=books";
                var urlAjax = urlRoot + controller;
                $.ajax({
                    url:urlAjax,
                    method:"POST",
                    dataType:"json",
                    success:function(data){
                        var html = '';
                        for(var i=0; i<data.length; i++){
                            html += '<tr>';
                            html += '<td> <a id="'+data[i].id+'" title="Show book details" data-bs-toggle="modal" data-bs-target="#modalViewBook" href="#" onclick="viewDetailBook('+data[i].id+');return false;\">'+data[i].titol+'</a></td>';
                            html += '<td> <a id="'+data[i].idAutor+'" title="Show Author" data-bs-toggle="modal" data-bs-target="#modalViewAuthor" href="#" onclick="viewDetailAuthor('+data[i].idAutor+','+data[i].AutNom+','+data[i].AutCognom1+');return false;\">'+data[i].AutNom+' '+data[i].AutCognom1+'</a></td>';
                            html += '<td></td>';
                            html += '<td></td>';
                            html += '<td></td>';
                            html += '<td></td>';
                            html += '<td></td>';
                            html += '</tr>';
                        }
                        $('#books tbody').html(html);
                    }
                });
            }
                fetch_data();
                setInterval(function(){
                    fetch_data();
                }, 5000);
            });
        </script>
    </div>

</div>

<?php

include_once('modals-library.php');

# footer
include_once(APP_ROOT . '/inc/footer.php');