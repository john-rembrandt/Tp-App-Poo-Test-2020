<?php
namespace Application\Controller;

use Application\Cache\Cache;
use Application\Model\Model;
use Lib\Page;
use Lib\HTTPRequest;
use Lib\Router;
use Lib\Route;

class IndexController
{
    
    public $donnee;

    public $cacheIndex;
    
    public $page;
    
    public $httpRequest;
    
    public $router;
    
    public $route;
    
    //public $commentsFile = __DIR__.'\..\Application\View\vueComments.php';
    //public $contentFile = __DIR__.'\..\Application\View\vueNews.php'; 

    public function __CONSTRUCT()
    {  
        
        $this->donnee = new Model();
        $this->cacheIndex = new Cache();
        $this->page = new Page();
        $this->httpRequest = new HTTPRequest();
        $this->router = new Router();
        
        
    }
    
    
    public function getController()
    {
        $router = new Router;
        
        $xml = new \DOMDocument;
        $xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');
        
        $routes = $xml->getElementsByTagName('route');
        
        // On parcourt les routes du fichier XML.
        foreach ($routes as $route)
        {
            $vars = [];
            
            // On regarde si des variables sont présentes dans l'URL.
            if ($route->hasAttribute('vars'))
            {
                $vars = explode(',', $route->getAttribute('vars'));
            }
            
            // On ajoute la route au routeur.
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }
        
        try
        {
            // On récupère la route correspondante à l'URL.
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        }
        catch (\RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE)
            {
                // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
                $this->httpResponse->redirect404();
            }
        }
        
        // On ajoute les variables de l'URL au tableau $_GET.
        $_GET = array_merge($_GET, $matchedRoute->vars());
        
        // On instancie le contrôleur.
        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }
    
    
    
    public function executeIndex()
    {
        $url = $this->httpRequest->requestURI();
        
        //$this->route = new Route();
        
        var_dump($this->router->getRoute($url));
        
       
        /* if($this->cacheIndex->dateCreationCache() == true)
        {
            $this->cacheIndex->lireCache();
        }
        else
        {
            if($_GET['choix'] == 'comments')
            {
                $this->page->contentFile = $this->page->commentsFile;
                
                $this->cacheIndex->creerCache($this->cacheIndex->fichierCache,
                $this->page->affichageVue($this->donnee->getSelectionCommentaire()));
            }
            
            if($_GET['choix'] == 'liste')
            {
                $this->page->contentFile = $this->page->newsFile;
                
                $this->cacheIndex->creerCache($this->cacheIndex->fichierCache,
                $this->page->affichageVue($this->donnee->getSelectionListe())); 
            } 
             
        }*/
      }
    
}