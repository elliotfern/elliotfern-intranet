<?php
# conectare la base de datos
$activePage = "links";

if (isset($_GET['id']) ) {
    $id = $_GET['id'];
}
$id = $params['id'];
global $conn;
/* $url = "https://elliotfern.com/control/route/links.php?type=topic&id=" . $id;

//call api
$input = file_get_contents($url);
$arr = json_decode($input, true);
*/

$stmt = $conn->prepare("SELECT t.topic, g.id, g.genre
FROM db_topics AS t
INNER JOIN db_library_genres AS g ON t.idGenere = g.id
WHERE t.id=?");
$stmt->execute([$id]); 
$result = $stmt->fetch();
    $nomTopic = $result["topic"];
    $idGen = $result["id"];
    $genre = $result["genre"];
?>

<div class="container">
<h2><a href="<?php echo APP_SERVER;?>/links">Links</a> > <a href="<?php echo APP_SERVER;?>/links/topics">Topics </a> > Topic: <?php echo $nomTopic; ?></h2>
<h3>Category > <a href="<?php echo APP_SERVER;?>/links/category/<?php echo $idGen; ?>"><?php echo $genre; ?></a></h3>

<p><button type='button' class='btn btn-warning btn-sm' id='btnCreateLink' onclick='btnCreateLink()' data-bs-toggle='modal' data-bs-target='#modalCreateLink'>Add link &rarr;</button>

<hr>
<input type='hidden' id='idTopic' value='<?php echo $id;?>' />
<input type='hidden' id='url' value='<?php echo APP_SERVER;?>' />

<div class="table-responsive">
   <table class="table table-striped" id="topicsLinks">
     <thead class="table-primary">
                <tr>
                <th>Link &darr;</th>
                <th>Language</th>
                <th>Type</th>
                <th></th>
                <th></th>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function(){
              var idTopic = $("#idTopic").val();
              var urlRoot = $("#url").val();
              var route = "/controller/links.php?type=topic&id=";
              var url = urlRoot + route + idTopic;
              var urlTopic = url;
                function fetch_data(){
                    $.ajax({
                        url:urlTopic,
                        method:"POST",
                        dataType:"json",
                        success:function(data){
                            var html = '';
                            for(var i=0; i<data.length; i++){
                                html += '<tr>';
                                html += '<td><a href="'+data[i].url+'" target="_blank">'+data[i].nom+'</a></td>';
                                html += '<td>';
                                var langInt = data[i].lang;
                                if (langInt == 1 ) {
                                  html += 'English';
                                } else if (langInt == 2 ) {
                                  html += 'Catalan';
                                } else if (langInt == 3 ){
                                  html += 'Spanish';
                                } else if (langInt == 4 ){
                                  html += 'Italian';
                                } else {
                                  html += 'None';
                                }
                              html += '</td>';
                              html += '<td>'+data[i].type+'</td>';
                              
                              html += '<td><button type="button" onclick="modalUpdateLink('+data[i].linkId+')" id="btnUpdateLink" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateLink" data-id="'+data[i].linkId+ '" value="'+data[i].linkId+ '" data-title="'+data[i].linkId+ '" data-slug="'+data[i].linkId+ '" data-text="'+data[i].linkId+ '">Update</button></td> ';
                                html += '<td><button type="button" onclick="btnRemoveLink('+data[i].linkId+')" id="btnRemoveLink" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalRemoveLink" data-id="'+data[i].linkId+ '" value="'+data[i].linkId+ '" data-title="'+data[i].linkId+ '" data-slug="'+data[i].linkId+ '" data-text="'+data[i].linkId+ '">Delete</button></td>';
                                html += '</tr>';
                            }
                            $('#topicsLinks tbody').html(html);
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

include_once('modals-links.php');

# footer
require_once(APP_ROOT . '/inc/footer.php');