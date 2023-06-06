<?php
require_once(APP_ROOT . '/inc/variables.php');
$favicon = APP_SERVER . "/img/elliotfern-icon/icon.png";
$logoElliotfern = APP_SERVER . "/img/elliotfern-icon/icon.png";
$urlWeb = APP_SERVER;

if(isset($params['slug'])){
    $slug = $params['slug'];

    $url = APP_SERVER . "/controller/book.php?type=book&slug=" . $slug;

    //call api
    $input = file_get_contents($url);
    $arr = json_decode($input, true);
    
    if (isset($arr)) { 
        $obj = $arr[0];
        $idAutor = $obj['id'];
          $nomAutor = $obj['AutNom'];
          $AutCognom1 = $obj['AutCognom1'];
          $idAutor2 = $obj['idAutor2'];
          $nomAutor2 = $obj['AutNom2'];
          $AutCognom2 = $obj['AutCognom2'];
          $titol_antic = $obj['titol'];
          $any = $obj['any'];
          $nomEditorial = $obj['nomEditorial'];
          $genere = $obj['nomGenEng'];
          $nomIidioma = $obj['language'];
          $idEditorial = $obj['idEditorial'];
          $idGenere = $obj['idGenere'];
          $nameImg = $obj['nameImg'];
          $typeName = $obj['typeName'];
          $alt = $obj['alt'];
          $nomTipusEng = $obj['nomTipusEng'];
          $autorSlug = $obj['autorSlug'];
          $dateCreated = date_create($obj['dateCreated']);
          $dateCreated_net = date_format($dateCreated, 'd-m-Y');
    }
}


header("Content-Language: $langCode");
header("Cache-Control: store, cache, must-revalidate, max-age=2592000");
header("X-LiteSpeed-Cache-Control: public,max-age=2592000");

?>
<!DOCTYPE html>
<html lang="<?php echo $langCode;?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Security-Policy" content="default-src https://media.elliotfern.com <?php echo $urlWeb;?>; style-src https://media.elliotfern.com <?php echo $urlWeb;?>; script-src <?php echo $urlWeb;?> 'unsafe-inline' 'unsafe-eval'">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="profile" href="https://gmpg.org/xfn/11">
<meta name="keywords" content="Webdesign, webdeveloper, ecommerce, wordpress, prestashop, woocommerce, history">
<meta name="robots" content="index, follow, noodp, noydir">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php echo $favicon; ?>">
<title><?php if ($homepage == 1) { echo $titolPost." - Elliot Fernandez"; } else {echo "Elliot Fernandez"; }?></title>
<meta name="description" content="<?php echo $descripcio;?>">
<meta name="author" content="Elliot Fernandez">

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
           <?php  
 // some action goes here under php
if (isset($obj)) {
    echo "<div class='container'>";
    echo "<h2> " . $titol_antic .  "</h2>";
 echo "<div class='row'>
       <div class='col-sm-8'>";
        if (!empty($nameImg)) {
          echo "<img src='".IMG_URL."".$typeName."/".$nameImg.".jpg' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='".$alt."' title='".$alt."'>";
        } else {
         
        }          
 echo "</div>";
 echo '<div class="col-sm-4">';
         echo' <div class="alert alert-primary" role="alert" style="margin-top:10px">';
          
          if (!empty($titolCat_antic)) {  
            echo "<p><strong>Catalan title: </strong>".$titolCat_antic."</p>";
          }
          if (!empty($AutCognom2)) { 
            echo "<p><strong>Authors: </strong>";
            echo "<td><a href='https://elliotfern.com/author/".$autorSlug."' title='show author info'>".$nomAutor." ".$AutCognom1."</a></td></p>";
            echo ' / ';
            echo "<td><a href='https://elliotfern.com/author/".$autorSlug."' title='show author info'>".$nomAutor2." ".$AutCognom2."</a></td></p>";
          } else {
            echo "<p><strong>Author: </strong>";
            echo "<td><a href='https://elliotfern.com/author/".$autorSlug."' title='show author info'>".$nomAutor." ".$AutCognom1."</a></td></p>";
          }
          echo "<p><strong>Publication date: </strong>".$any."</p>";
          echo "<p><strong>Publisher:</strong> ".$nomEditorial."</p>";
          echo "<p><strong>Type: </strong>".$nomTipusEng."</p>";
          echo "<p><strong>Genre: </strong>".$genere."</p>";
          echo "<p><strong>Language: </strong>".$nomIidioma."</p>";
          echo "<p><strong>Created on: </strong> ".$dateCreated_net." ";
          
          if (!empty($dateModified)) { 
            echo "<p><strong>Updated on: </strong> ".$dateModified_net." "; 
          } 
      echo "</div>
     </div>
</div>";
echo "</div>";
} else {
    echo "error";
}
 

            ?>
      </div>



<?php

# footer
require_once(APP_ROOT . '/inc/footer.php');