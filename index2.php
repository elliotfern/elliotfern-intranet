<?php
$url_server = "https://elliotfern.com/control/";

session_start();
if(!isset($_SESSION['user'])){
    header('Location: '.$url_server. 'login.php');
    exit;
} else {  
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
    
    // constants
    require_once('./inc/variables.php');
    $url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    
    $route = new Route();
        
    if (strpos($url,'update') OR (strpos($url,'delete')) OR (strpos($url,'new')) OR (strpos($url,'info')) !== false ) {
        require_once('./inc/connection.php');
        //links
        $route->add("/links/update","php-forms/links/links-update-link.php");
        $route->add("/links/process/update","php-process/links/update-link.php");

        $route->add("/links/new","php-forms/links/links-add-new.php");
        $route->add("/links/process/new","php-process/links/add-new-link.php");

        // vault
        $route->add("/vault/new","php-forms/vault/vault-add.php");
        $route->add("/vault/process/new","php-process/vault/vault-insert-process-form.php");

        $route->add("/vault/update","php-forms/vault/vault-update.php");
        $route->add("/vault/process/update","php-process/vault/vault-update-process-form.php");

        // accounting-elliot
        /// add customer
        $route->add("/accounting/customer/new","php-forms/accounting/customer-add.php");
        $route->add("/accounting/process/customer/new","php-process/accounting/customer-insert.php");

        /// add customer invoice
        $route->add("/accounting/invoice-customer/new","php-forms/accounting/invoice-customer-add.php");
        $route->add("/accounting/process/invoice-customer/new","php-process/accounting/customer-invoice-insert.php");

        /// add company supply
        $route->add("/accounting/supply/new","php-forms/accounting/company-supply-add.php");
        $route->add("/accounting/process/supply/new","php-process/accounting/supply-company-insert.php");

        /// add company supply invoice
        $route->add("/accounting/supply/invoice/new","php-forms/accounting/invoice-supply-add.php");
        $route->add("/accounting/process/supply/invoice/new","php-process/accounting/supply-invoice-insert-process-form.php");
        
        /// info customer invoice
        $route->add("/accounting/invoice-customer/info/","php-forms/accounting/invoice-customer-info.php");

        // users
        $route->add("/users/update","php-forms/users/users-update.php");
        $route->add("/users/process/update","php-process/users/users-update-process-form.php");

    } else {
        require_once('./inc/header.php');
        // homepage
        $route->add("/","admin.php");
        $route->add("/admin","admin.php");

        // user info
        $route->add("/user/{id}","user.php");
        $route->add("/login","login.php");
        $route->add("/logout","logout.php");
        
        // accounting
        $route->add("/accounting","public/accounting/index.php");
        $route->add("/accounting/customers","public/accounting/costumers.php");
        $route->add("/accounting/customers/invoices","public/accounting/erp-invoices-customers.php");

        $route->add("/accounting/supplies/","public/accounting/supplies.php");
        $route->add("/accounting/supplies/invoices","public/accounting/erp-invoices-supplies.php");

        // links
        $route->add("/links","public/links/index.php");
        $route->add("/links/categories","public/links/categories.php");
        $route->add("/links/category/{id}","public/links/category.php");
        $route->add("/links/topics","public/links/topics.php");
        $route->add("/links/topic/{id}","public/links/topic.php");
        $route->add("/links/all-links","public/links/all-links.php");
        $route->add("/links/update","php-forms/links/links-update-link.php");

        //vault
        $route->add("/vault","public/vault/index.php");
        $route->add("/vault/customer/{id}","public/vault/customer.php");
        $route->add("/vault/elliot/{id}","public/vault/vault-elliot.php");

        //blog
        $route->add("/blog/{slug}","public/blog/blog.php");
        $route->add("/blog/{slug}/editor","public/blog/editor.php");

        //programming
        $route->add("/programming","public/programming/index.php");
        $route->add("/programming/links","public/programming/links.php");
        $route->add("/programming/links/{id}","public/programming/links-detail.php");
        $route->add("/programming/daw","public/programming/daw.php");

        //webmail
        $route->add("/mail/send","public/webmail/send.php");
        $route->add("/mail/inbox","public/webmail/inbox.php");

        //contacts
        $route->add("/contacts","public/contacts/index.php");
        $route->add("/contacts/personal","public/contacts/personal-contacts.php");

        //jobs
        $route->add("/jobs","public/jobs/index.php");

        //library
        $route->add("/library","public/library/index.php");
        $route->add("/library/books","public/library/books.php");
        $route->add("/library/authors","public/library/authors.php");
        
        //users
        $route->add("/users","public/users/index.php");
        $route->add("/users/list","public/users/users-list.php");

        // projects
        $route->add("/projects","public/projects/index.php");

        $route->notFound("404.php");

    }
}

?>