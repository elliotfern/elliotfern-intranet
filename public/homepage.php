<?php
require_once(APP_ROOT . '/inc/variables.php');
$favicon = APP_SERVER . "/img/elliotfern-icon/icon.png";
$logoElliotfern = APP_SERVER . "/img/elliotfern-icon/icon.png";
$urlWeb = APP_SERVER;

if(isset($params['slug'])){
    $slug = $params['slug'];

    $pagina = $_SERVER['REQUEST_URI'];
    $pagina = ltrim($pagina, '/');
    $pagina = substr($pagina, 0, 2);

    if ($pagina == "en") {
        $langCode = "en";
        $langSQL = "eng";
    } elseif ($pagina == "ca") {
        $langCode = "ca";
        $langSQL = "cat";
    } elseif ($pagina == "es") {
        $langCode = "es";
        $langSQL = "esp";
    } elseif ($pagina == "it") {
        $langCode = "it";
        $langSQL = "it";
    } elseif ($pagina  == "fr") {
        $langCode = "fr";
        $langSQL = "fr";
    } else {
        $langCode = "en";
        $langSQL = "eng";
    }

    $url = APP_SERVER . "/controller/blog.php?type=blog&slug=" . $slug . "&lang=" . $langSQL;
    
    //call api
    $input = file_get_contents($url);
    $arr = json_decode($input, true);
    
    if (isset($arr)) { 
    $obj = $arr[0];
    $lang = $obj['lang'];
    $idWeb = $obj['ID'];
    $titolPost = $obj['post_title'];
    $contentPost = $obj['post_content'];
    $descripcio = $obj['post_excerpt'];
    $descripcio = $obj['post_excerpt'];
    $date = $obj['post_date'];
    $date2 = date("Y-m-d",strtotime($date));
    $dateUpdate = $obj['post_modified'];
    $dateUpdate2 = date("Y-m-d",strtotime($dateUpdate));

    $slugCat = $obj['slugCat'];
    $slugCast = $obj['slugCast'];
    $slugEng = $obj['slugEng'];
    $slugIt = $obj['slugIt'];
    $slugFr = $obj['slugFr'];
    $homepage = 1;
    }
} else {
    $pagina = $_SERVER['REQUEST_URI'];
    $pagina = ltrim($pagina, '/');
    $pagina = substr($pagina, 0, 2);

    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $lc = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }

    if ($pagina == "en") {
        $id = "567";
        $langCode = "en";
        $langSQL = "eng";
    } elseif ($pagina == "ca") {
        $id = "1273";
        $langCode = "ca";
        $langSQL = "cat";
    } elseif ($pagina == "es") {
        $id = "1270";
        $langCode = "es";
        $langSQL = "esp";
    } elseif ($pagina == "fr") {
        $id = "1270";
        $langCode = "fr";
        $langSQL = "fr";
    } else {
        $id = "567";
        $langCode = "en";
        $langSQL = "eng";
    }

     // comprobar si es pagina homepage
    $url = APP_SERVER . "/controller/blog.php?type=blog&homepage=".$id."&lang=".$langSQL;

    //call api
    $homepage = 2;
    $input = file_get_contents($url);
    $arr = json_decode($input, true);

    foreach ($arr as $obj2) {
        if ($obj2['ID'] == $id) {
            // show results of this object
            $content = $obj2['post_content'];
            $idWeb = $obj2['ID'];
            $titolPost = $obj2['post_title'];
            $contentPost = $obj2['post_content'];
        }
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

<?php if (!$slugEng == "0") {
    echo '<link rel="alternate" href="'.$urlWeb.'/en/'.$slugEng.'" hreflang="en">' . "\n";
}
if (!$slugCat == "0") {
    echo '<link rel="alternate" href="'.$urlWeb.'/ca/'.$slugCat.'" hreflang="ca">' . "\n";
}
if (!$slugCast == "0") {
    echo '<link rel="alternate" href="'.$urlWeb.'/es/'.$slugCast.'" hreflang="es">' . "\n";
}
if (!$slugIt == "0") {
    echo '<link rel="alternate" href="'.$urlWeb.'/it/'.$slugIt.'" hreflang="it">' . "\n";
}
if(!$slugFr == "0") {
    echo '<link rel="alternate" href="'.$urlWeb.'/fr/'.$slugFr.'" hreflang="fr">' . "\n";
} 

$paginaCanonical = $_SERVER['REQUEST_URI'];

echo '<link rel="alternate" href="'.$urlWeb.'/en/'.$slugEng.'" hreflang="x-default">' . "\n";
echo '<link rel="canonical" href="'.$urlWeb.$paginaCanonical.'">' . "\n";

?>
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

<?php
// si es homepage
if ($idWeb == 567 OR $idWeb == 1273 OR $idWeb == 1270 OR $idWeb == 1272 OR $idWeb == 1271 OR $idWeb == 567) {
    ?>
    <div id="contenidor_principal">
    
    <?php echo $obj2['slugCat']; ?> - <?php echo $obj2['slugCast']; ?> - <?php echo $obj2['slugEng']; ?> - <?php echo $obj2['slugIt'] ?> - <?php echo $obj2['slugFr'] ?>
    
    <?php echo $content;?>
    </div>
    <?php
} else {
    // si es un post
    
    /*
    lang ENG = 1
    lang CAT = 2
    lang ESP = 3
    lang IT = 4
    lang FR = 5
    */
    
    if ($pagina == "en") {
        $pagina = 1;
        $lang = 1;
    } elseif ($pagina == "ca") {
        $pagina = 2;
        $lang = 2;
    } elseif ($pagina == "es") {
        $pagina = 3;
        $lang = 3;
    } elseif ($pagina == "it") {
        $pagina = 4;
        $lang = 4;
    } elseif ($pagina == "fr") {
        $pagina = 5;
        $lang = 5;
    } elseif ($pagina !== "ca" OR "es" OR "it" OR "fr") {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: /en/".$slug);
        exit();
    }
    
   // if (isset($idWeb)) { 
        if ($pagina == $lang) {
        ?><div id="contenidor_principal">

    <!-- llengues -->
    <div id="selector-idioma">
        
        <?php if (isset($slugEng)) {
            ?><div class="menu-separacio">
            <a href="<?php echo APP_SERVER."/en"."/".$slugEng; ?>"><?php echo $english; ?></a>
            </div><?php 

        } 
        if (isset($slugCast)) {
            ?><div class="menu-separacio">
            <a href="<?php echo APP_SERVER."/es"."/".$slugCast; ?>"><?php echo $spanish; ?></a>
            </div><?php
        } 
        if (isset($slugFr)) {
            ?><div class="menu-separacio">
            <a href="<?php echo $APP_SERVER."/fr"."/".$slugFr; ?>"><?php echo $french; ?></a>
            </div><?php 

        } 
        if (isset($slugIt)) {
            ?><div class="menu-separacio">
            <a href="<?php echo APP_SERVER."/it"."/".$slugIt; ?>"><?php echo $italian; ?></a>
            </div><?php
        } 
        if (isset($slugCat)) {
            ?><div class="menu-separacio">
            <a href="<?php echo APP_SERVER."/ca"."/".$slugCat; ?>"><?php echo $catalan; ?></a>
            </div><?php 
        }
        ?>  
    </div>

        <h2 class="titular-entrada-centrat"><?php echo $titolPost ?></h2>

        <div class="blockquote-entrada titular-entrada-centrat">
        <?php echo $descripcio ?>
      </div>

      <div>
          <?php
            echo '<a href="'.$webAuthorElliot.'"><img src="https://elliotfern.com/img/elliotfern/elliot_fernandez_icon.gif" alt="Elliot Fernandez" height="120" width="80"></a>';
          ?>
      </div>
          
      <div id="descripcio-autor">
          <?php  
        echo '<a href="'.$webAuthorElliot.'">Elliot Fernandez</a>
        <div id="descripcio-autor-petit">'.$descripAuthorElliot.'</div></div>';
          
          ?>
      
      <div id="data-article">
           <?php  

            ?><small> <?php  
            if ($date2 == $dateUpdate2) { 
              echo "".$publicat_text. $date2."";
            } else {
              echo "".$publicat_text. $date2 ." | ".$actualitzat_text . $dateUpdate2."";
            }
            ?> </small>
      </div>


       
        <?php echo $contentPost;?>
        </div>
        <?php
        } else {
            ?><div id="contenidor_principal">
         Error 404
        </div>
        <?php
        }
   /* } else {
        ?><div id="contenidor_principal">
         Error 404
        </div>
        <?php
    } */

}

# footer
require_once(APP_ROOT . '/inc/footer.php');