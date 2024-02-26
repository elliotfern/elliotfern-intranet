<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$token = $_ENV['TOKEN'];
define("APP_TOKEN",$token );

class Route {
    private function simpleRoute($file, $route){
        //replacing first and last forward slashes
        //$_REQUEST['uri'] will be empty if req uri is /

        if(!empty($_REQUEST['uri'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
        }else{
            $reqUri = "/";
        }

        if($reqUri == $route){
            $params = [];
            include($file);
            exit();

        }

    }

    function add($route,$file){

        //will store all the parameters value in this array
        $params = [];

        //will store all the parameters names in this array
        $paramKey = [];

        //finding if there is any {?} parameter in $route
        preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

        //if the route does not contain any param call simpleRoute();
        if(empty($paramMatches[0])){
            $this->simpleRoute($file,$route);
            return;
        }

        //setting parameters names
        foreach($paramMatches[0] as $key){
            $paramKey[] = $key;
        }

       
        //replacing first and last forward slashes
        //$_REQUEST['uri'] will be empty if req uri is /

        if(!empty($_REQUEST['uri'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
        }else{
            $reqUri = "/";
        }

        //exploding route address
        $uri = explode("/", $route);

        //will store index number where {?} parameter is required in the $route 
        $indexNum = []; 

        //storing index number, where {?} parameter is required with the help of regex
        foreach($uri as $index => $param){
            if(preg_match("/{.*}/", $param)){
                $indexNum[] = $index;
            }
        }

        //exploding request uri string to array to get
        //the exact index number value of parameter from $_REQUEST['uri']
        $reqUri = explode("/", $reqUri);

        //running for each loop to set the exact index number with reg expression
        //this will help in matching route
        foreach($indexNum as $key => $index){

             //in case if req uri with param index is empty then return
            //because url is not valid for this route
            if(empty($reqUri[$index])){
                return;
            }

            //setting params with params names
            $params[$paramKey[$key]] = $reqUri[$index];

            //this is to create a regex for comparing route address
            $reqUri[$index] = "{.*}";
        }

        //converting array to sting
        $reqUri = implode("/",$reqUri);

        //replace all / with \/ for reg expression
        //regex to match route is ready !
        $reqUri = str_replace("/", '\\/', $reqUri);

        //now matching route with regex
        if(preg_match("/$reqUri/", $route))
        {
            include($file);
            exit();

        }
    }

    function notFound($file){
        include($file);
        exit();
    }
}

$route = new Route(); 

$url_root = $_SERVER['DOCUMENT_ROOT'];
$url_server = $_SERVER['HTTP_HOST'];
$dev = "";

define("APP_SERVER", $url_server); 
define("APP_ROOT", $url_root);
define("APP_DEV",$dev);

// Route for paths containing '/control/'
require_once(APP_ROOT . '/connection.php');
require_once(APP_ROOT . '/public/01_inici/variables.php'); 
require_once(APP_ROOT . '/public/01_inici/functions.php');

$route->add("/login","public/auth/login.php");
$route->add("/api/auth/login","php-process/auth/login-process.php");

 // API SERVER 
 $route->add("/api/projects","api/projects.php");
 $route->add("/api/auth","api/auth.php");
 $route->add("/api/accounting","api/accounting.php");

 $route->add("/api/links/get","api/link/get-link.php");
 $route->add("/api/links/put","api/link/put-link.php");
 $route->add("/api/links/post","api/link/post-link.php");

 $route->add("/api/cinema/get","api/cinema/get-cinema.php");

 //contactes
 $route->add("/api/contactes/get/","api/contactes/get-contactes.php");
 $route->add("/api/contactes/put/{contacte}","api/contactes/put-contactes.php");
 $route->add("/api/contactes/post","api/contactes/post-contactes.php");

 // links
 $route->add("/api/library/update/{author}","api/08_biblioteca_llibres/put-library.php");
 $route->add("/api/library/authors/{allAuthors}","api/08_biblioteca_llibres/get-library.php");
 $route->add("/api/library/author/{slugAuthors}","api/08_biblioteca_llibres/get-library.php");
 $route->add("/api/library/author/books/{authorId}","api/08_biblioteca_llibres/get-library.php");
 $route->add("/api/library/profession/{profession}","api/08_biblioteca_llibres/get-library.php");
 $route->add("/api/library/movement/{movement}","api/08_biblioteca_llibres/get-library.php");
 $route->add("/api/library/image/author/{imageAuthor}","api/08_biblioteca_llibres/get-library.php");

 $route->add("/api/library/{topics}","api/08_biblioteca_llibres/get-library.php");
 $route->add("/api/library/books/{allBooks}","api/08_biblioteca_llibres/get-library.php");
 $route->add("/api/library/books/allBooks/generes/{generes}","api/08_biblioteca_llibres/get-library.php");
 $route->add("/api/library/book/{slugBook}","api/08_biblioteca_llibres/get-library.php");

 $route->add("/api/places/{country}","api/08_biblioteca_llibres/get-library.php");

    // a) inserir dades biblioteca
    $route->add("/api/biblioteca/post/","api/08_biblioteca_llibres/post-biblioteca.php");
    $route->add("/api/biblioteca/auxiliars/","api/08_biblioteca_llibres/get-library.php");
    
    // API PUBLICA
    $route->add("/api/public/biblioteca/{allBooks}","api/library/public/get-library.php");
    $route->add("/api/public/biblioteca/allBooks/{generes}","api/library/public/get-library.php");

// aqui comença la lògica del sistema

session_set_cookie_params([
    'lifetime' => 60 * 60 * 24 * 30,  // Duración de la cookie en segundos
    'path' => '/',
    'domain' => $url_server,  // Reemplaza con tu dominio real
    'secure' => true,
    'httponly' => true
]);
session_start();

if (empty($_SESSION['user']) || !session_id()) {

    header('Location: ' .$dev . '/login');
    exit(); 

} else {
        // Pàgines que no han de tenir header
        $route->add("/accounting/invoice/pdf/{id}", "php-forms/accounting/generate_pdf.php");
        $route->add("/accounting/invoice-customer/new","php-forms/accounting/invoice-customer-add.php");
        $route->add("/accounting/process/invoice-customer/new","php-process/accounting/customer-invoice-insert.php");

        // CARREGAR HEADER
        require_once(APP_ROOT . '/public/01_inici/header_html.php');

        // 01. Inici
        $route->add("/inici","public/01_inici/admin.php");
        $route->add("/admin","public/01_inici/admin.php");

        // 02. ERP - Comptabilitat
        $route->add("/erp","public/02_erp_comptabilitat/index.php");
        $route->add("/erp/facturacio-clients","public/02_erp_comptabilitat/erp-invoices-customers.php");
        $route->add("/erp/facturacio-proveedors","public/02_erp_comptabilitat/erp-invoices-supplies.php");

            /// add company supply invoice
            $route->add("/accounting/supply/invoice/new","php-forms/accounting/invoice-supply-add.php");
            $route->add("/accounting/process/supply/invoice/new","php-process/accounting/supply-invoice-insert-process-form.php");
            
            /// info customer invoice
            $route->add("/accounting/invoice-customer/info/","php-forms/accounting/invoice-customer-info.php");
        
        // 03. CRM - Gestio clients
        $route->add("/crm","public/03_crm_clients/index.php");
        $route->add("/crm/clients/","public/03_crm_clients/costumers.php");
        
            // a) Afegir client
            $route->add("/accounting/customer/new","php-forms/accounting/customer-add.php");
            $route->add("/control/accounting/process/customer/new","php-process/accounting/customer-insert.php");

        // 04. CRM - Proveidors
        $route->add("/crm/proveedors","public/04_crm_proveidors/supplies.php");
        
            // a) Afegir proveidor
            $route->add("/accounting/supply/new","php-forms/accounting/company-supply-add.php");
            $route->add("/accounting/process/supply/new","php-process/accounting/supply-company-insert.php");

        // 05. CRM - Pressupostos
        $route->add("/crm/pressupostos","public/05_crm_pressupostos/index.php");

        // 06. Gestor projectes
        $route->add("/gestor-projectes","public/06_gestor_projectes/index.php");

        // 07. Agenda contactes
        $route->add("/contactes","public/07_agenda_contactes/index.php");
        $route->add("/contactes/modifica/{id}","public/07_agenda_contactes/contactes-modifica-id.php");
        $route->add("/contactes/nou","public/07_agenda_contactes/contactes-inserir-nou.php");

        // 08. Biblioteca llibres i autors
        $route->add("/biblioteca","public/08_biblioteca_llibres/index.php");
        
            // a) Llibres:
            $route->add("/biblioteca/llibres","public/08_biblioteca_llibres/books.php");
            $route->add("/biblioteca/llibres/{slug}","public/08_biblioteca_llibres/book-page.php");
            $route->add("/biblioteca/nou/llibre","public/08_biblioteca_llibres/biblioteca-llibre-inserir.php");

            // b) autors
            $route->add("/biblioteca/autors","public/08_biblioteca_llibres/authors.php");
            $route->add("/biblioteca/nou/autor","public/08_biblioteca_llibres/biblioteca-autor-inserir.php");
            $route->add("/biblioteca/autors/update/{slug}","public/08_biblioteca_llibres/form-author-update.php");
            $route->add("/biblioteca/autors/{slug}","public/08_biblioteca_llibres/author-page.php");
            $route->add("/biblioteca/autors/by-country/{country}","public/08_biblioteca_llibres/author-page.php");

        // 09. Adreces interes
        $route->add("/adreces","public/09_adreces_interes/index.php");
        $route->add("/adreces/categories","public/09_adreces_interes/page-all-categories.php");
        $route->add("/adreces/category/{id}","public/09_adreces_interes/page-category-id.php");
        $route->add("/adreces/topics","public/09_adreces_interes/page-all-topics.php");
        $route->add("/adreces/topic/{id}","public/09_adreces_interes/page-topic-all-links.php");
        $route->add("/adreces/update/{id}","php-forms/links/links-update-link.php");

        // 10 - Claus access
        $route->add("/vault","public/10_claus_acces/index.php");

        $route->add("/vault/new","php-forms/vault/vault-add.php");
        $route->add("/vault/process/new","php-process/vault/vault-insert-process-form.php");
        $route->add("/vault/update","php-forms/vault/vault-update.php");
        $route->add("/vault/process/update","php-process/vault/vault-update-process-form.php");
        $route->add("/vault/customer/{id}","public/10_claus_acces/customer.php");
        $route->add("/vault/elliot/{id}","public/10_claus_acces/vault-elliot.php");

        // 11 - Cinema i series
        $route->add("/cinema","public/11_cinema_series/index.php");
        $route->add("/cinema/tvshows","public/11_cinema_series/tvshows.php");
        $route->add("/cinema/tvshows/{id}","public/11_cinema_series/tvshow-page-info.php");
        $route->add("/cinema/movies","public/11_cinema_series/movies.php");
        $route->add("/cinema/actors","public/11_cinema_series/actors.php");
        $route->add("/cinema/directors","public/11_cinema_series/directors.php");     

        //programming
        $route->add("/programming","public/control/programming/index.php");
        $route->add("/programming/links","public/control/programming/links.php");
        $route->add("/programming/links/{id}","public/control/programming/links-detail.php");
        $route->add("/programming/daw","public/control/programming/daw.php");

        // user info
        $route->add("/user/{id}","public/pages/user.php");
        $route->add("/logout","public/auth/logout.php");     

}

?>