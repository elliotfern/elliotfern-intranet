<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(APP_ROOT . '/inc/variables.php');
$favicon = APP_SERVER . "/img/elliotfern-icon/icon.png";
$logoElliotfern = APP_SERVER . "/img/elliotfern-icon/icon.png";
$urlWeb = APP_SERVER;

header("Content-Language: en");
header("Cache-Control: store, cache, must-revalidate, max-age=2592000");
header("X-LiteSpeed-Cache-Control: public,max-age=2592000");

?>
<!DOCTYPE html>
<html lang="<?php echo $langCode;?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Security-Policy" content="default-src https://media.elliotfern.com <?php echo $urlWeb;?>; style-src https://media.elliotfern.com <?php echo $urlWeb;?>; script-src https://code.jquery.com/ <?php echo $urlWeb;?> 'unsafe-inline' 'unsafe-eval'">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="profile" href="https://gmpg.org/xfn/11">
<meta name="keywords" content="Webdesign, webdeveloper, ecommerce, wordpress, prestashop, woocommerce, history">
<meta name="robots" content="index, follow, noodp, noydir">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php echo $favicon; ?>">
<title>Elliot Fernandez</title>
<meta name="description" content="">
<meta name="author" content="Elliot Fernandez">

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>

</head>
<body>

<!-- header barra superior -->

<?php 
require_once(APP_ROOT . '/inc/language-variables.php');
?>

<!-- Menu principal header -->
<div id="container-header">
  <div id="header-titol">
    <h1 class="text-center"><a href="<?php echo $link_home_url; ?>" title="Homepage">Elliot Fernandez</a></h1>

 </div>
  </div>
  <div class="container-amplada-total">
    <div id="menu-header">
          <div class="menu-separacio"><a href="<?php echo $link_aboutme_url; ?>" title="About me"><?php echo $link_aboutme_text; ?></a></div>

          <div class="menu-separacio"><a href="<?php echo $link_portfolio_url; ?>" title="Portfolio"><?php echo $link_portfolio_text; ?></a></div>
 
          <div class="menu-separacio"><a href="<?php echo $link_blog_url;?>" title="Blog"><?php echo $link_blog_text; ?></a></div>

          <div class="menu-separacio"><a href="<?php echo $link_history_url;?>" title="History articles"><?php echo $link_history_text; ?></a></div>

          <div class="menu-separacio"><a href="<?php echo $link_history_archives_url;?>" title="History archives articles"><?php echo $link_history_archives_text; ?></a></div>
  </div>
</div>

      
      <div id="contenidor_principal">
      <div class="table-responsive">
            <table class="table table-striped" id="books">
                <thead class="table-primary">
        <tr>
            <th>Author</th>
            <th>Country</th>
            <th>Profession</th>
            <th>Years</th>
    </tr>
    </thead>
    <tbody></tbody>
    </table>
    
    <script>
        $(document).ready(function(){
            function fetch_data(){
                var urlRoot = $("#url").val();
                var controller = "/controller/book.php?type=books";
                var urlAjax = "https://elliotfern.com/controller/book.php?type=authors";
                $.ajax({
                    url:urlAjax,
                    method:"POST",
                    dataType:"json",
                    success:function(data){
                        var html = '';
                        for(var i=0; i<data.length; i++){
                            html += '<tr>';
                            if (data[i].AutNom === null) {
                                html += '<td> <a id="'+data[i].idAutor+'" title="Show Author" href="https://elliotfern.com/author/'+data[i].autorSlug+'">'+data[i].AutCognom1+'</a></td>';
                            } else {
                                html += '<td> <a id="'+data[i].idAutor+'" title="Show Author" href="https://elliotfern.com/author/'+data[i].autorSlug+'">'+data[i].AutCognom1+', '+data[i].AutNom+'</a></td>';
                            }
                            html += '<td> '+data[i].nomPaisEng+'</td>';
                            html += '<td> '+data[i].professio+'</td>';
                            if (data[i].yearDie === 0) {
                                html += '<td> '+data[i].yearBorn+'</td>';
                            } else {
                                html += '<td> '+data[i].yearBorn+' / '+data[i].yearDie+'</td>';
                            }
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

      </div>



<?php

# footer
require_once(APP_ROOT . '/inc/footer.php');