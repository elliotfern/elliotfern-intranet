<?php

# conectare la base de datos
$activePage = "links";
global $conn;
?>

<div class="container">
<h2><a href="<?php echo APP_SERVER;?>/links">Links</a> > <a href="<?php echo APP_SERVER;?>/links/categories">Categories </a></h2>

<p><button type='button' class='btn btn-warning btn-sm' id='btnCreateLink' onclick='btnCreateLink()' data-bs-toggle='modal' data-bs-target='#modalCreateLink'>Add link &rarr;</button>

<input type='hidden' id='url' value='<?php echo APP_SERVER;?>' />

        <div class="table-responsive">
            <table class="table table-striped" id="categoriesLinks">
                <thead class="table-primary">
                <tr>
                <th>Category</th>
                <th>Actions</th> 
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function(){
                function fetch_data(){
                    var url_server = $("#url").val();
                    var route = "/controller/links.php?type=categories";
                    var urlCat = url_server + route;
                    $.ajax({
                        url:urlCat,
                        method:"POST",
                        dataType:"json",
                        success:function(data){
                            var html = '';
                            for(var i=0; i<data.length; i++){
                                html += '<tr>';
                                html += '<td><a id="'+data[i].id+'" title="Show category" href="category/'+data[i].id+'">'+data[i].genre+'</a></td>';

                                html += '<td><button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Update</button> ';
                                html += '<button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Delete</button>';
                                html += '</td>';
                                html += '</tr>';
                            }
                            $('#categoriesLinks tbody').html(html);
                        }
                    });
                }
                fetch_data();
            });
        </script>

<?php
echo '</div>';

include_once('modals-links.php');

# footer
require_once(APP_ROOT . '/inc/footer.php');