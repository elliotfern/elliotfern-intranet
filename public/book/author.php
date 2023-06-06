<?php
require_once(APP_ROOT . '/inc/variables.php');
$favicon = APP_SERVER . "/img/elliotfern-icon/icon.png";
$logoElliotfern = APP_SERVER . "/img/elliotfern-icon/icon.png";
$urlWeb = APP_SERVER;

if(isset($params['slug'])){
    $slug = $params['slug'];

    $url = APP_SERVER . "/controller/book.php?type=author&slug=" . $slug;

    //call api
    $input = file_get_contents($url);
    $arr = json_decode($input, true);
    
    if (isset($arr)) { 
        $obj = $arr[0];
        $nomAutor = $obj['AutNom'];
          $AutCognom1 = $obj['AutCognom1'];
          $DataNaix = $obj['yearBorn'];
          $DataDef = $obj['yearDie'];
          $AutWikipedia = $obj['AutWikipedia'];
          $AutOcupacio = $obj['nameOc'];
          $AutMoviment = $obj['nomMovEng'];
          $pais = $obj['nomPaisEng'];
          $idPais = $obj['idPais'];
          $idMov = $obj['idMov'];
          $AutDescrip = $obj['AutDescrip'];
          $nameImg = $obj['nameImg'];
          $typeName = "library-author";
          $altCat = $obj['alt'];
          $dateCreated = date_create($obj['dateCreated']);
          $dateCreated_net = date_format($dateCreated, 'd-m-Y');

            $dateModified = date_create($obj['dateModified']);
            $dateModified_net = date_format($dateModified, 'd-m-Y');
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
    echo "<h2> " . $nomAutor . " " . $AutCognom1 . "</h2>";
echo "<div class='row'>
      <div class='col-sm-8'>";
         if ($nameImg == '') { 
          echo "<img src='".IMG_DEFAULT."' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Author' title='Author'>";
        } else {
          echo "<img src='".IMG_URL."".$typeName."/".$nameImg.".jpg' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='".$altCat."' title='".$altCat."'>";
        }      
   echo "</div>";
          echo '<div class="col-sm-4">';
        
                  echo '<div class="alert alert-primary" role="alert" style="margin-top:10px">
                      <p>'.stripslashes($AutDescrip).'</p>';
                      
                    echo "</p></small>";
                      if ($DataNaix == '') { 
                      echo "";
                       } else {
                       echo "<p><strong>".LIBRARY_YEAR_BIRTH.": </strong>".htmlspecialchars($DataNaix, ENT_QUOTES)."</p>";
                      }

                      if ($DataDef == '0') { 
                      echo "";
                        } else {
                          echo "<p><strong>".LIBRARY_YEAR_DEAD.": </strong>".htmlspecialchars($DataDef, ENT_QUOTES)."</p>";
                      }

                      echo "<p><strong>Country: </strong><a href='' title='Country'>".$pais."</a></p>";
                      
                      echo "<p><strong>".LIBRARY_PROFESSION.": </strong>".htmlspecialchars($AutOcupacio, ENT_QUOTES)."</p>";

                      echo "<p><strong>".LIBRARY_MOVEMENT.": </strong><a href='' title='Movement'>".htmlspecialchars($AutMoviment, ENT_QUOTES)."</a></p>";

                      if ($AutWikipedia == '') { 
                      echo "";
                       } else {
                       echo "<p><strong>".LIBRARY_WIKIPEDIA.": </strong><a href='".htmlspecialchars($AutWikipedia, ENT_QUOTES)."' target='_blank' title='Wikipedia'>Web</a>";
                      }

                      echo "<p><strong>Created on: </strong> ".$dateCreated_net." ";
                      
                      if (is_null($dateModified) == 1 ) { 
                      } else {
                        echo "<p><strong>Updated on: </strong> ".$dateModified_net." ";
                      }
                 echo "</div>";
                echo "</div>";
           echo "</div>";
 echo "</div>";
} else {
    echo "error";
}
 

            ?>
      </div>



<?php

# footer
require_once(APP_ROOT . '/inc/footer.php');