<?php 

// LANGUAGE
// Initialize the language code variable
$lc = ""; 
// Check to see that the global language server variable isset()
// If it is set, we cut the first two characters from that string

/*
lang ENG = 1
lang CAT = 2
lang ESP = 3
lang IT = 4
lang FR = 5
*/

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $lc = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

if ( $lc == "en" ) {
      $lang = 1;
    } elseif ($lc == "ca" ) {
      $lang = 2;
    } elseif ($lc == "es" ) {
      $lang = 3;
    } elseif ($lc == "it") {
      $lang = 4;
    } elseif ($lc == "fr" ) {
      $lang = 5;
}

$id_art = "";

// selector idioma
if ( $lang == 1 ) {
  $link_home_url = "567";
  $subtitle_text = "Historian and Front-end developer";
  $cursCodi = "curs_eng";
  $ordreCodi = "ordre_eng";
  $descripAuthorElliot = "He has a degree in History from the Autonomous University of Barcelona (2009) and a Master's in World History from Pompeu Fabra University (2011).";
  $books = "Recommended bibliography";
  $update='Last update:';
  $webAuthorElliot = APP_SERVER. "/en/about-me/";
  $spanish = "Spanish";
  $catalan = "Catalan";
  $english = "English";
  $italian = "Italian";
  $french = "French";
  $continguts = "Table of content:";
  $search_text = "Search";
  $search_text_title = "Search results:";
  $search_text_no_matched = "Sorry, no posts matched your criteria.";
  $search_text_error = "Error, empty search field";
  $publicat_text = "Post on ";
  $actualitzat_text = "Updated on ";

  $link_home_text = "Homepage";
  $link_aboutme_text = "About me";
  $link_portfolio_text = "Portfolio";
  $link_blog_text = "Blog";
  $link_history_text = "History";
  $link_history_archives_text = "Archives";
  $link_links_text = "Links";
  $link_privacy_text = "Privacy policy";
  $link_contact_text = "Contact";
  $link_home_url = APP_SERVER. "/en";
  $link_aboutme_url = APP_SERVER. "/en/about-me/";
  $link_portfolio_url = APP_SERVER. "/en/portfolio/";
  $link_blog_url = APP_SERVER. "/en/blog";
  $link_history_url = APP_SERVER. "/en/history/";
  $link_history_archives_url = APP_SERVER. "/en/history-article-archives/";
  $link_links_url = APP_SERVER. "/en/links/";
  $link_privacy_url = APP_SERVER. "/en/privacy-policy/";
  $link_contact_url = APP_SERVER. "/en/contact/";

} elseif ($lang == 2 ) {
  $subtitle_text = "Historiador i Desenvolupador web";
  $cursCodi = "curs";
  $ordreCodi = "ordre";
  $descripAuthorElliot = "És llicenciat en Història per la Universitat Autònoma de Barcelona (2009) i Màster en Història del Món per la Universitat Pompeu Fabra (2011).";
  $books = "Bibliografia recomanada";
  $update='Darrera actualització:';
  $webAuthorElliot = APP_SERVER. "/ca/sobre-autor/";
  $spanish = "Castellà";
  $catalan = "Català";
  $english = "Anglès";
  $italian = "Italià";
  $french = "Francès";
  $continguts = "Índex de continguts:";
  $search_text = "Cerca";
  $search_text_title = "Resultats de la recerca:";
  $search_text_no_matched = "No hem trobat cap resultat que coincideixi amb la teva recerca.";
  $search_text_error = "Error, camp de recerca buit.";
  $publicat_text = "Publicat el ";
  $actualitzat_text = "Actualitzat el ";

  $link_home_text = "Inici";
  $link_aboutme_text = "Autor";
  $link_portfolio_text = "Portafolio";
  $link_blog_text = "Blog";
  $link_history_text = "Història";
  $link_history_archives_text = "Arxius";
  $link_links_text = "Enllaços";
  $link_privacy_text = "Política de privacitat";
  $link_contact_text = "Contacte";
  $link_home_url = APP_SERVER. "/ca";
  $link_aboutme_url = APP_SERVER. "/ca/sobre-autor/";
  $link_portfolio_url = APP_SERVER. "/ca/portafolio/";
  $link_blog_url = APP_SERVER. "/ca/blog/";
  $link_history_url = APP_SERVER. "/ca/articles-historia/";
  $link_history_archives_url = APP_SERVER. "/ca/arxiu-historia-oberta/";
  $link_links_url = APP_SERVER. "/ca/links/";
  $link_privacy_url = APP_SERVER. "/ca/politica-privacitat/";
  $link_contact_url = APP_SERVER. "/ca/contacte/";

} elseif ($lang == 3 ) {
  $subtitle_text = "Historiador y desarrollador web";
  $cursCodi = "curs_esp";
  $ordreCodi = "ordre_esp";
  $descripAuthorElliot = "Es licenciado en Historia por la Universidad Autónoma de Barcelona (2009) y Master en Historia del Mundo por la Universidad Pompeu Fabra (2011).";
  $books = "Bibliografía recomendada";
  $update='Última actualización:';
  $webAuthorElliot = APP_SERVER. "/sobre-autor";
  $spanish = "Español";
  $catalan = "Catalán";
  $english = "Inglés";
  $italian = "Italiano";
  $french = "Francés";
  $continguts = "Índice de contendidos:";
  $search_text = "Busca";
  $search_text_title = "Resultados de la búsqueda:";
  $search_text_no_matched = "No hemos encontrado ningún resultado que coincida con tu búsqueda.";
  $search_text_error = "Error, campo de búsqueda vacío.";
  $publicat_text = "Publicado el ";
  $actualitzat_text = "Actualizado el ";

  $link_home_text = "Inicio";
  $link_aboutme_text = "Autor";
  $link_portfolio_text = "Portfolio";
  $link_blog_text = "Blog";
  $link_history_text = "Historia";
  $link_history_archives_text = "Archivos";
  $link_links_text = "Enlaces";
  $link_privacy_text = "Política de privacidad";
  $link_contact_text = "Contacto";
  $link_home_url = APP_SERVER. "1270";
  $link_aboutme_url = APP_SERVER. "398";
  $link_portfolio_url = APP_SERVER. "565";
  $link_blog_url = APP_SERVER. "568";
  $link_history_url = APP_SERVER. "804";
  $link_history_archives_url = APP_SERVER. "1310";
  $link_links_url = APP_SERVER. "575";
  $link_privacy_url = APP_SERVER. "419";
  $link_contact_url = APP_SERVER. "500";

} elseif ($lang == 4 ) {
  $subtitle_text = "Storico e Sviluppatore web";
  $cursCodi = "curs_it";
  $ordreCodi = "ordre_it";
  $descripAuthorElliot = "Ha una laurea in Storia presso l'Università Autonoma di Barcellona (2009) e un Master in Storia Mondiale presso l'Università Pompeu Fabra (2011).";
  $books = "Bibliografia consigliata";
  $update='Ultimo aggiornamento:';
  $webAuthorElliot = APP_SERVER. "/it/autore/";
  $spanish = "Spagnolo";
  $catalan = "Catalano";
  $english = "Inglese";
  $italian = "Italiano";
  $french = "Francese";
  $continguts = "Contenuti:";
  $search_text = "Cerca";
  $search_text_title = "Risultati di ricerca:";
  $search_text_no_matched = "Non abbiamo trovato nessun post corrispondente ai tuoi criteri di ricerca.";
  $search_text_error = "Errore, campo di ricerca vuoto.";
  $publicat_text = "Postato il ";
  $actualitzat_text = "Aggiornato il ";

  $link_home_text = "Homepage";
  $link_aboutme_text = "Autore";
  $link_portfolio_text = "Portfolio";
  $link_blog_text = "Blog";
  $link_history_text = "Storia";
  $link_history_archives_text = "Archivi";
  $link_links_text = "Links";
  $link_privacy_text = "Privacy policy";
  $link_contact_text = "Contatto";
  $link_home_url = APP_SERVER. "/it";
  $link_aboutme_url = APP_SERVER. "/it/autore/";
  $link_portfolio_url = APP_SERVER. "/it/portfolio/";
  $link_blog_url = APP_SERVER. "/it/blog/";
  $link_history_url = APP_SERVER. "/it/articoli-storia/";
  $link_history_archives_url = APP_SERVER. "/it/archivi-storia/";
  $link_links_url = APP_SERVER. "/it/links/";
  $link_privacy_url = APP_SERVER. "/it/privacita/";
  $link_contact_url = APP_SERVER. "/it/contatto/";

} elseif ($lang == 5 ) {
  $subtitle_text = "Historien et développeur web";
  $cursCodi = "curs_fr";
  $ordreCodi = "ordre_fr";
  $descripAuthorElliot = "Il est titulaire d'un diplôme en histoire de l'Université autonome de Barcelone (2009) et d'une maîtrise en histoire mondiale de l'Université Pompeu Fabra (2011).";
  $books = "Bibliographie recommandée";
  $update='Dernière mise à jour:';
  $webAuthorElliot = APP_SERVER. "/fr/auteur/";
  $spanish = "Espagnol";
  $catalan = "Catalan";
  $english = "Anglais";
  $italian = "Italien";
  $french = "Français";
  $continguts = "Index du contenu :";
  $search_text = "Chercher";
  $search_text_title = "Résultats de recherche :";
  $search_text_no_matched = "Nous n'avons trouvé aucune publication correspondant à vos critères de recherche.";
  $search_text_error = "Erreur, champ de recherche vide.";
  $publicat_text = "Posté le ";
  $actualitzat_text = "Mis à jour le ";

  $link_home_text = "Accueil";
  $link_aboutme_text = "Auteur";
  $link_portfolio_text = "Portfolio";
  $link_blog_text = "Blog";
  $link_history_text = "Histoire";
  $link_history_archives_text = "Archives";
  $link_links_text = "Links";
  $link_privacy_text = "Privacy policy";
  $link_contact_text = "Contact";
  $link_home_url = APP_SERVER. "/fr";
  $link_aboutme_url = APP_SERVER. "/fr/auteur/";
  $link_portfolio_url = APP_SERVER. "/fr/portfolio";
  $link_blog_url = APP_SERVER. "/fr/blog/";
  $link_history_url = APP_SERVER. "/fr/articles-histoire/";
  $link_history_archives_url = APP_SERVER. "/fr/archives-articles-histoire/";
  $link_links_url = APP_SERVER. "/fr/links/";
  $link_privacy_url = APP_SERVER. "/fr/confidentialite/";
  $link_contact_url = APP_SERVER. "/fr/contact/";
}
?>