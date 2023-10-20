<?php
$activePage = "projects";

echo '<div class="container">';
echo '<h2>Project manager</h2>';

?>
        <input type='hidden' id='url' value='<?php echo APP_SERVER;?>'/>
        <div class="table-responsive">
            <table class="table table-striped" id="projects">
                <thead class="table-primary">
                <tr>
                <th>Project name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Priority</th>
                <th>Client</th>
                <th></th>
                <th></th>
    
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function(){
                function fetch_data(){
                    var urlRoot = $("#url").val();
                    var urlAjax = urlRoot + "/api/projects/?type=projects";
                    $.ajax({
                        url:urlAjax,
                        method:"POST",
                        dataType:"json",
                        success:function(data){
                            var html = '';
                            for(var i=0; i<data.length; i++){
                                html += '<tr>';
                                html += '<td>'+data[i].nomProjecte+'</td>';
                                html += '<td>'+data[i].descripcioProjecte+'</td>';
                                html += '<td>';
                                if (data[i].estatProjecte == "1") {
                                    html += '<button type="button" class="btn btn-sm btn-danger">To do</button>';
                                } else if (data[i].estatProjecte == "2") {
                                    html += '<button type="button" class="btn btn-sm btn-dark">In progress</button>';
                                } else if (data[i].estatProjecte == "3") {
                                    html += '<button type="button" class="btn btn-sm btn-warning">In review</button>';
                                } else if (data[i].estatProjecte == "4") {
                                    html += '<button type="button" class="btn btn-sm btn-success">Done</button>';
                                }
                                html += '</td>';
                                html += '<td>'+data[i].dataIniciProjecte+'</td>';
                                html += '<td>'+data[i].dataActualitzacioProjecte + '</td>';
                                html += '<td>';
                                if (data[i].prioritatProjecte == "1") {
                                    html += '<button type="button" class="btn btn-sm btn-success">Low</button>';
                                } else if (data[i].prioritatProjecte == "2") {
                                    html += '<button type="button" class="btn btn-sm btn-primary">Moderate</button>';
                                } else if (data[i].prioritatProjecte == "3") {
                                    html += '<button type="button" class="btn btn-sm btn-danger">High</button>';
                                }
                                html += '</td>';
                                html += '<td>'+data[i].clientEmpresa + '</td>';
                                html += '<td><button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Update</button>';
                                html += '</td>';
                                html += '<td><button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Delete</button>';
                                html += '</td>';
                                html += '</tr>';
                            }
                            $('#projects tbody').html(html);
                        }
                    });
                }
                fetch_data();
                setInterval(function(){
                    fetch_data();
                }, 5000);
            });
        </script>
<?php
echo '</div>';

//include_once('modals-accounting.php');

# footer
include_once(APP_ROOT. '/inc/footer.php');