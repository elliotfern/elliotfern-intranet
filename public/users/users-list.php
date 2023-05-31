<?php
# conectare la base de datos
$activePage = "users";

echo '<div class="container">';
echo '<h2>Users</h2>';
echo '<h3>Edit</h3>';

echo "<p><button type='button' class='btn btn-light btn-sm' id='btnAddCustomerInvoice' onclick='btnCreateCustomInvoice()' data-bs-toggle='modal' data-bs-target='#modalCreateCustomerInvoice'>Create customer invoice</button></p>";

echo "<hr>";
?>
<input type='hidden' id='url' value='<?php echo APP_SERVER;?>'/>

        <div class="table-responsive">
            <table class="table table-striped" id="customersInvoices">
                <thead class="table-primary">
                <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th></th>
                <th></th>
    
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function(){
                function fetch_data(){
                    var urlRoot = $("#url").val();
                    var urlAjax = urlRoot + "/controller/users.php?type=users";
                    $.ajax({
                        url:urlAjax,
                        method:"POST",
                        dataType:"json",
                        success:function(data){
                            var html = '';
                            for(var i=0; i<data.length; i++){
                                html += '<tr>';
                                html += '<td>'+data[i].id+'</td>';
                                html += '<td>'+data[i].username+ '</td>';
                                html += '<td>'+data[i].firstName + '</td>';
                                html += '<td>'+data[i].lastName + '</td>';
                                html += '<td>'+data[i].email + '</td>';
                                html += '<td><button type="button" onclick="btnUpdateUser('+data[i].id+')" id="btnUpdateUser" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateUser" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Update</button>';
                                html += '</td>';
                                html += '<td><button type="button" onclick="btnUpdateBook('+data[i].id+')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'+data[i].id+ '" value="'+data[i].id+ '" data-title="'+data[i].id+ '" data-slug="'+data[i].id+ '" data-text="'+data[i].id+ '">Delete</button>';
                                html += '</td>';
                                html += '</tr>';
                            }
                            $('#customersInvoices tbody').html(html);
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
include_once('modals-users.php');

# footer
include_once(APP_ROOT. '/inc/footer.php');