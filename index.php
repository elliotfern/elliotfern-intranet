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
require_once(APP_ROOT . APP_DEV . '/connection.php');
require_once(APP_ROOT . APP_DEV . '/public/php/variables.php'); 
require_once(APP_ROOT . APP_DEV . '/public/php/functions.php');

$route->add("/login","public/pages/auth/login.php");
$route->add("/api/auth/login","php-process/auth/login-process.php");

 // API SERVER 
 $route->add("/api/projects","api/projects.php");
 $route->add("/api/auth","api/auth.php");
 $route->add("/api/accounting","api/accounting.php");

 $route->add("/api/links/get","api/link/get-link.php");
 $route->add("/api/links/put","api/link/put-link.php");
 $route->add("/api/links/post","api/link/post-link.php");

 // links
 $route->add("/api/library/new/{author}","api/library/post-library.php");
 $route->add("/api/library/update/{author}","api/library/put-library.php");
 $route->add("/api/library/authors/{allAuthors}","api/library/get-library.php");
 $route->add("/api/library/author/{slugAuthors}","api/library/get-library.php");
 $route->add("/api/library/author/books/{authorId}","api/library/get-library.php");
 $route->add("/api/library/profession/{profession}","api/library/get-library.php");
 $route->add("/api/library/movement/{movement}","api/library/get-library.php");
 $route->add("/api/library/image/author/{imageAuthor}","api/library/get-library.php");

 $route->add("/api/library/{topics}","api/library/get-library.php");
 $route->add("/api/library/books/{allBooks}","api/library/get-library.php");
 $route->add("/api/library/book/{slugBook}","api/library/get-library.php");

 $route->add("/api/places/{country}","api/library/get-library.php");

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

        $route->add("/accounting/invoice/pdf/{id}", "php-forms/accounting/generate_pdf.php");

        // pagines sense header
        $route->add("/accounting/invoice-customer/new","php-forms/accounting/invoice-customer-add.php");


        // Header (solo para las paginas)
        require_once(APP_ROOT . APP_DEV . '/public/php/header.php');
    
        // homepage
        $route->add("/","public/pages/homepage/admin.php");
        $route->add("/admin","public/pages/homepage/admin.php");

        // 1) accounting-elliot
        /// add customer
        $route->add("/accounting/customer/new","php-forms/accounting/customer-add.php");
        $route->add("/control/accounting/process/customer/new","php-process/accounting/customer-insert.php");

        /// add customer invoice
        
        $route->add("/accounting/process/invoice-customer/new","php-process/accounting/customer-invoice-insert.php");

        /// add company supply
        $route->add("/accounting/supply/new","php-forms/accounting/company-supply-add.php");
        $route->add("/accounting/process/supply/new","php-process/accounting/supply-company-insert.php");

        /// add company supply invoice
        $route->add("/accounting/supply/invoice/new","php-forms/accounting/invoice-supply-add.php");
        $route->add("/accounting/process/supply/invoice/new","php-process/accounting/supply-invoice-insert-process-form.php");
        
        /// info customer invoice
        $route->add("/accounting/invoice-customer/info/","php-forms/accounting/invoice-customer-info.php");

        // 2) users
        $route->add("/users/update","php-forms/users/users-update.php");
        $route->add("/users/process/update","php-process/users/users-update-process-form.php");

        // 3) vault
        $route->add("/vault/new","php-forms/vault/vault-add.php");
        $route->add("/vault/process/new","php-process/vault/vault-insert-process-form.php");

        $route->add("/vault/update","php-forms/vault/vault-update.php");
        $route->add("/vault/process/update","php-process/vault/vault-update-process-form.php");


        // PAGES
        // user info
        $route->add("/user/{id}","public/pages/user.php");
        $route->add("/logout","public/auth/logout.php");
        
        // accounting
        $route->add("/accounting","public/pages/accounting/index.php");
        $route->add("/accounting/customers","public/pages/accounting/costumers.php");
        $route->add("/accounting/customers/invoices","public/pages/accounting/erp-invoices-customers.php");

        $route->add("/accounting/supplies/","public/pages/accounting/supplies.php");
        $route->add("/accounting/supplies/invoices","public/pages/accounting/erp-invoices-supplies.php");

        // 4) links
        $route->add("/links","public/pages/links/index.php");
        $route->add("/links/categories","public/pages/links/page-all-categories.php");
        $route->add("/links/category/{id}","public/pages/links/page-category-id.php");
        $route->add("/links/topics","public/pages/links/page-all-topics.php");
        $route->add("/links/topic/{id}","public/pages/links/page-topic-all-links.php");
        $route->add("/links/update/{id}","php-forms/links/links-update-link.php");

        //vault
        $route->add("/vault","public/pages/vault/index.php");
        $route->add("/vault/customer/{id}","public/pages/vault/customer.php");
        $route->add("/vault/elliot/{id}","public/pages/vault/vault-elliot.php");


        //programming
        $route->add("/programming","public/control/programming/index.php");
        $route->add("/programming/links","public/control/programming/links.php");
        $route->add("/programming/links/{id}","public/control/programming/links-detail.php");
        $route->add("/programming/daw","public/control/programming/daw.php");

        //contacts
        $route->add("/contacts","public/control/contacts/index.php");
        $route->add("/contacts/personal","public/control/contacts/personal-contacts.php");

        //jobs
        $route->add("/jobs","public/control/jobs/index.php");

        // 5) library
        $route->add("/library","public/pages/library/index.php");
        $route->add("/library/book/all","public/pages/library/books.php");
        $route->add("/library/book/{slug}","public/pages/library/book-page.php");

        $route->add("/library/author/all","public/pages/library/authors.php");
        $route->add("/library/author/new","public/pages/library/form-author-new.php");
        $route->add("/library/author/update/{slug}","public/pages/library/form-author-update.php");
        $route->add("/library/author/{slug}","public/pages/library/author-page.php");
        $route->add("/library/author/by-country/{country}","public/pages/library/author-page.php");
        
        //users
        $route->add("/users","public/control/users/index.php");
        $route->add("/users/list","public/control/users/users-list.php");

        // projects
        $route->add("/projects","public/control/projects/index.php");

}

?>