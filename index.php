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

    if (strpos($_SERVER['REQUEST_URI'], '/control/') !== false) {
        // Route for paths containing '/control/'
         require_once('./control/inc/header.php');
        // homepage
        $route->add("/control","public/control/index.php");
        $route->add("/control/admin","public/control/admin.php");
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