<?php
use Lib\Router;
use Lib\Route;
use Lib\HTTPResponse;
use Lib\HTTPRequest;

/*
use \Lib\Router;
use \Lib\Route;
use \Lib\HTTPRequest;
use \Lib\HTTPResponse;
*/

require 'C:\wamp64\www\Projet-de-cache-en-php4\Lib\HTTPRequest.php';
require 'C:\wamp64\www\Projet-de-cache-en-php4\Lib\HTTPResponse.php';
require 'C:\wamp64\www\Projet-de-cache-en-php4\Lib\Router.php';
require 'C:\wamp64\www\Projet-de-cache-en-php4\Lib\Route.php';


//$testRouter = new Router();

//$testRoute = new Route($url, $module, $action, $varsNames);

//$testUrl = new HTTPRequest();

//echo $testUrl -> requestURI();


class Application
{
    protected $httpRequest;
    protected $httpResponse;
    protected $name;
    
    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        
        $this->name = '';
    }
    public function getController()
    {
        $router = new Router;
        
        $xml = new \DOMDocument;
        $xml->load(__DIR__.'/../Application/Config/configNews.xml');
        
        $routes = $xml->getElementsByTagName('route');
        
        // On parcourt les routes du fichier XML.
        foreach ($routes as $route)
        {
            $vars = [];
            
            // On regarde si des variables sont pr�sentes dans l'URL.
            if ($route->hasAttribute('vars'))
            {
                $vars = explode(',', $route->getAttribute('vars'));
            }
            
            // On ajoute la route au routeur.
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }
        
        try
        {
            // On r�cup�re la route correspondante � l'URL.
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        }
        catch (\RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE)
            {
                // Si aucune route ne correspond, c'est que la page demand�e n'existe pas.
                $this->httpResponse->redirect404();
            }
        }
        
        // On ajoute les variables de l'URL au tableau $_GET.
        $_GET = array_merge($_GET, $matchedRoute->vars());
        
        // On instancie le contr�leur.
        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }
    
}

$testApp = new Application();

$testUrl = new HTTPRequest();

var_dump($testUrl -> requestURI());

$testApp -> getController();

