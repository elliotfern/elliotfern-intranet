<h2>Blog</h2>

<p><button type='button' class='btn btn-outline-secondary' id='btnCreateLink' onclick='btnCrearLlibre()'>Afegir nou llibre &rarr;</button></p>

<hr>
        <div class="table-responsive">
            <table class="table table-striped" id="blog">
                <thead class="table-primary">
                <tr>
                <th>ID</th>
                <th>Tipus</th>
                <th>Títol</th>
                <th>Data</th>
                <th>Idioma</th>
                <th></th>
                <th></th>
    
            </thead>
            <tbody></tbody>
        </table>
</div>

</div>
<script>
$(document).ready(function(){
                function fetch_data(){

                    var urlAjax = "api/blog/get/?llistat-articles";
                    $.ajax({
                        url:urlAjax,
                        method:"GET",
                        dataType:"json",
                        beforeSend: function(xhr) {
                            // Obtener el token del localStorage
                            let token = localStorage.getItem('token');

                            // Incluir el token en el encabezado de autorización
                            xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                        },
                        success:function(data){
                            var html = '';
                            for (var i=0; i<data.length; i++) {
                                html += '<tr>';
                                html += '<td>'+data[i].id+'</td>';
                                html += '<td>'+data[i].post_type+'</td>';
                                html += '<td><a href="https://'+server+"/blog/"+data[i].slug+'">'+data[i].post_title+'</a></td>';
                                html += '<td>'+formatData(data[i].post_date)+'</td>';
                                html += '<td>'+data[i].idioma_ca+'</td>';
                                html += '<td><button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Update</button>';
                                html += '</td>';
                                html += '<td><button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Delete</button>';
                                html += '</td>';
                                html += '</tr>';
                            }
                            $('#blog tbody').html(html);
                        }
                    });
                }
                
                    fetch_data();
                
            });

</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');