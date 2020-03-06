<?php
namespace Application\Controller;

// use Application\Cache\Cache;
use Application\Model\Model;
use Lib\Page;
use Lib\HTTPRequest;
use Lib\HTTPResponse;
use Lib\Router;
use Lib\Route;

class IndexController
{

    public $donnee;

    // public $cacheIndex;
    public $page;

    public $httpRequest;

    public $httpResponse;

    // public $router;

    // public $route;

    // public $commentsFile = __DIR__.'\..\Application\View\vueComments.php';
    // public $contentFile = __DIR__.'\..\Application\View\vueNews.php';
    public $routing = __DIR__ . '/../../Application/Config/configNews.xml';

    public function __CONSTRUCT()
    {
        $this->donnee = new Model();
        // $this->cacheIndex = new Cache();
        $this->page = new Page();
        $this->httpRequest = new HTTPRequest();
        $this->httpResponse = new HTTPResponse();
    }

    public function getController()
    {
        $router = new Router();

        $xml = new \DOMDocument();
        $xml->load($this->routing);

        $routes = $xml->getElementsByTagName('route');

        // $router->routes = $routes;

        // return $routes;

        // On parcourt les routes du fichier XML.
        foreach ($routes as $route) {
            $vars = [];

            // On regarde si des variables sont présentes dans l'URL.
            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // On ajoute la route au routeur.
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
            echo "les fameuse variable \$vars";
            var_dump($vars);
        }
        echo "les routes recues et qui sont stocké dans le router sous forme de tableau";
        var_dump($router->routes);
        
        echo "valeur de httpRequest->requestURI()";
        var_dump($this->httpRequest->requestURI());

        // var_dump($router->getRoute($this->httpRequest->requestURI()));

        // var_dump($router->getRoute($this->httpRequest->requestURI()));
        
        // var_dump($matchesRoute);

        try {
            // On récupère la route correspondante à l'URL.
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        } 
        catch (\RuntimeException $e) {
            
            if ($e->getCode() == Router::NO_ROUTE) {
                
                // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
                $this->httpResponse->redirect404();
            }
        }

        // On ajoute les variables de l'URL au tableau $_GET.
        //$_GET = array_merge($_GET, $matchedRoute->vars());
        $varsValues = array_merge($_GET, $matchedRoute->vars());
        
        echo " test du retour array_merge ";
        var_dump($varsValues);
        
        echo "\$_GET";
        var_dump($_GET);
        
        echo "HASVARS()";
        var_dump($matchedRoute->hasVars());
        
        echo "MODULE()";
        var_dump($matchedRoute->module());
        
        echo "ACTION()";
        var_dump($matchedRoute->action());
        
        echo "URL()";
        var_dump($matchedRoute->url());
        
        echo "VARSNAMES()";
        var_dump($matchedRoute->varsNames());
        
        echo "VARS()";
        var_dump($matchedRoute->vars());
        
        if ($matchedRoute instanceof Route) {
            echo "true";
        }
        else {
            echo "fault";
        }
        /*
         * // On instancie le contrôleur.
         * $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
         * return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
         */
    }

    public function executeIndex()
    {
        // $url = $this->httpRequest->requestURI();

        // $this->route = new Route();
        $this->getController();
    }
    /*
     * if($this->cacheIndex->dateCreationCache() == true)
     * {
     * $this->cacheIndex->lireCache();
     * }
     * else
     * {
     * if($_GET['choix'] == 'comments')
     * {
     * $this->page->contentFile = $this->page->commentsFile;
     *
     * $this->cacheIndex->creerCache($this->cacheIndex->fichierCache,
     * $this->page->affichageVue($this->donnee->getSelectionCommentaire()));
     * }
     *
     * if($_GET['choix'] == 'liste')
     * {
     * $this->page->contentFile = $this->page->newsFile;
     *
     * $this->cacheIndex->creerCache($this->cacheIndex->fichierCache,
     * $this->page->affichageVue($this->donnee->getSelectionListe()));
     * }
     */
}
