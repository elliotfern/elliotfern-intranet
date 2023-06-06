<?php
$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

$url_root = $_SERVER['DOCUMENT_ROOT'];
$url_server = "https://" . $_SERVER['HTTP_HOST'];
define("APP_SERVER", $url_server); 
define("APP_ROOT", $url_root);

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

    if (strpos($_SERVER['REQUEST_URI'], '/control') !== false) {
        // Route for paths containing '/control/'
        $rootDirectory = $_SERVER['DOCUMENT_ROOT'];
        $updatedPath = str_replace('/httpdocs', '', $rootDirectory);
        require_once($updatedPath . '/pass/connection.php');
        $rootDirectory = $_SERVER['DOCUMENT_ROOT'];       
        require_once($rootDirectory . '/inc/control/header.php');
        require_once($rootDirectory . '/inc/control/variables.php');
        require_once(APP_ROOT . '/inc/control/functions.php');
        require_once(APP_ROOT . '/inc/control/header_html.php');
        require_once(APP_ROOT . '/inc/control/header_nav.php');


        // homepage
        $route->add("/control","public/control/admin.php");
        $route->add("/control/admin","public/control/admin.php");
        $route->add("/control/login","public/control/login.php");

        // user info
        $route->add("/control/user/{id}","control/user.php");
        $route->add("/control/login","control/login.php");
        $route->add("/control/logout","control/logout.php");
        
        // accounting
        $route->add("/control/accounting","public/control/accounting/index.php");
        $route->add("/control/accounting/customers","public/control/accounting/costumers.php");
        $route->add("/control/accounting/customers/invoices","public/control/accounting/erp-invoices-customers.php");

        $route->add("/control/accounting/supplies/","public/control/accounting/supplies.php");
        $route->add("/control/accounting/supplies/invoices","public/control/accounting/erp-invoices-supplies.php");

        // links
        $route->add("/control/links","public/control/links/index.php");
        $route->add("/control/links/categories","public/control/links/categories.php");
        $route->add("/control/links/category/{id}","public/control/links/category.php");
        $route->add("/control/links/topics","public/control/links/topics.php");
        $route->add("/control/links/topic/{id}","public/control/links/topic.php");
        $route->add("/control/links/all-links","public/control/links/all-links.php");

        //vault
        $route->add("/control/vault","public/control/vault/index.php");
        $route->add("/control/vault/customer/{id}","public/control/vault/customer.php");
        $route->add("/control/vault/elliot/{id}","public/control/vault/vault-elliot.php");

        //blog
        $route->add("/control/blog/{slug}","public/control/blog/blog.php");
        $route->add("/control/blog/{slug}/editor","public/control/blog/editor.php");

        //programming
        $route->add("/control/programming","public/control/programming/index.php");
        $route->add("/control/programming/links","public/control/programming/links.php");
        $route->add("/control/programming/links/{id}","public/control/programming/links-detail.php");
        $route->add("/control/programming/daw","public/control/programming/daw.php");

        //webmail
        $route->add("/control/mail/send","public/control/webmail/send.php");
        $route->add("/control/mail/inbox","public/control/webmail/inbox.php");

        //contacts
        $route->add("/control/contacts","public/control/contacts/index.php");
        $route->add("/control/contacts/personal","public/control/contacts/personal-contacts.php");

        //jobs
        $route->add("/control/jobs","public/jobs/index.php");

        //library
        $route->add("/control/library","public/control/library/index.php");
        $route->add("/control/library/books","public/control/library/books.php");
        $route->add("/control/library/authors","public/control/library/authors.php");
        
        //users
        $route->add("/control/users","public/control/users/index.php");
        $route->add("/control/users/list","public/control/users/users-list.php");

        // projects
        $route->add("/control/projects","public/control/projects/index.php");

        $route->notFound("404.php");
    } elseif  (strpos($url,'update') OR (strpos($url,'delete')) OR (strpos($url,'new')) OR (strpos($url,'info')) !== false ) {
        $rootDirectory = $_SERVER['DOCUMENT_ROOT'];
        $updatedPath = str_replace('/httpdocs', '', $rootDirectory);
        require_once($updatedPath . '/pass/connection.php');
        //links
        $route->add("/control/links/update","php-forms/links/links-update-link.php");
        $route->add("/control/links/process/update","php-process/links/update-link.php");

        $route->add("/control/links/new","php-forms/links/links-add-new.php");
        $route->add("/control/links/process/new","php-process/links/add-new-link.php");

        // vault
        $route->add("/control/vault/new","php-forms/vault/vault-add.php");
        $route->add("/control/vault/process/new","php-process/vault/vault-insert-process-form.php");

        $route->add("/control/vault/update","php-forms/vault/vault-update.php");
        $route->add("/control/vault/process/update","php-process/vault/vault-update-process-form.php");

        // accounting-elliot
        /// add customer
        $route->add("/control/accounting/customer/new","php-forms/accounting/customer-add.php");
        $route->add("/control/accounting/process/customer/new","php-process/accounting/customer-insert.php");

        /// add customer invoice
        $route->add("/control/accounting/invoice-customer/new","php-forms/accounting/invoice-customer-add.php");
        $route->add("/control/accounting/process/invoice-customer/new","php-process/accounting/customer-invoice-insert.php");

        /// add company supply
        $route->add("/control/accounting/supply/new","php-forms/accounting/company-supply-add.php");
        $route->add("/control/accounting/process/supply/new","php-process/accounting/supply-company-insert.php");

        /// add company supply invoice
        $route->add("/control/accounting/supply/invoice/new","php-forms/accounting/invoice-supply-add.php");
        $route->add("/control/accounting/process/supply/invoice/new","php-process/accounting/supply-invoice-insert-process-form.php");
        
        /// info customer invoice
        $route->add("/control/accounting/invoice-customer/info/","php-forms/accounting/invoice-customer-info.php");

        // users
        $route->add("/control/users/update","php-forms/users/users-update.php");
        $route->add("/control/users/process/update","php-process/users/users-update-process-form.php");
  
    } else {

    // constants
    require_once('./inc/variables.php');   
    
   $route->add("/book","public/book/index.php");
    $route->add("/book/list","public/book/index.php");
    $route->add("/book/{slug}","public/book/llibre.php");
    $route->add("/author","public/author/index.php");
    $route->add("/author/list","public/author/index.php");
    $route->add("/author/{slug}","public/book/author.php");
    

    $route->add("/ca","public/homepage.php");
    $route->add("/en","public/homepage.php");
    $route->add("/fr","public/homepage.php");
    $route->add("/es","public/homepage.php");
    $route->add("/it","public/homepage.php");

    $route->add("/{slug}","public/homepage.php");
    
    $route->add("/en/homepage/","public/homepage.php");
    $route->add("/en/{slug}","public/homepage.php");
    
    $route->add("/fr/accueil/","public/homepage.php");
    $route->add("/fr/{slug}","public/homepage.php");

    $route->add("/ca/inici","public/homepage.php");
    $route->add("/ca/{slug}","public/homepage.php");

    $route->add("/es/inicio","public/homepage.php");
    $route->add("/es/{slug}","public/homepage.php");

    $route->add("/it/homepage","public/homepage.php");
    $route->add("/it/{slug}","public/homepage.php");
   
        // Initialize the language code variable
        $lc = ""; 
        // Check to see that the global language server variable isset()
        // If it is set, we cut the first two characters from that string
    
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $lc = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }
        
    
    // Now we simply evaluate that variable to detect specific languages
        if ($lc == "ca") {
            $route->add("/","public/homepage.php");
            $route->add("/ca","public/homepage.php");
            
            exit();
        } elseif ($lc == "es"){
            $route->add("/","public/homepage.php");
            $route->add("/es","public/homepage.php");
            exit();
        } elseif ($lc == "en"){
            $route->add("/","public/homepage.php");
            $route->add("/en","public/homepage.php");
            exit();
        } elseif ($lc == "fr"){
            $route->add("/","public/homepage.php");
            $route->add("/fr","public/homepage.php");
            exit();
        } elseif ($lc == "it"){
            $route->add("/","public/homepage.php");
            $route->add("/it","public/homepage.php");
            exit();
        } else { // don't forget the default case if $lc is empty
            $route->add("/","public/homepage.php");
            exit();
        }
        
    $route->notFound("404.php");
    }

    

?>