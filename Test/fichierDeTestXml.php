<?php

class Route
{
    protected $action;
    protected $module;
    protected $url;
    protected $varsNames;
    protected $vars = [];
    
    public function __construct($url, $module, $action, array $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }
    
    public function hasVars()
    {
        return !empty($this->varsNames);
    }
    
    public function match($url)
    {
        if (preg_match('`^'.$this->url.'$`', $url, $matches))
        {
            return $matches;
        }
        else
        {
            return false;
        }
    }
    
    public function setAction($action)
    {
        if (is_string($action))
        {
            $this->action = $action;
        }
    }
    
    public function setModule($module)
    {
        if (is_string($module))
        {
            $this->module = $module;
        }
    }
    
    public function setUrl($url)
    {
        if (is_string($url))
        {
            $this->url = $url;
        }
    }
    
    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }
    
    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }
    
    public function action()
    {
        return $this->action;
    }
    
    public function module()
    {
        return $this->module;
    }
    
    public function vars()
    {
        return $this->vars;
    }
    
    public function varsNames()
    {
        return $this->varsNames;
    }
}


class Router
{
    public $routes = [];
    
    const NO_ROUTE = 1;
    
    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes))
        {
            $this->routes[] = $route;
        }
    }
    
    public function getRoute($url)
    {
        foreach ($this->routes as $route)
        {
            // Si la route correspond à l'URL
            if (($varsValues = $route->match($url)) !== false)
            {
                // Si elle a des variables
                if ($route->hasVars())
                {
                    $varsNames = $route->varsNames();
                    $listVars = [];
                    
                    // On crée un nouveau tableau clé/valeur
                    // (clé = nom de la variable, valeur = sa valeur)
                    foreach ($varsValues as $key => $match)
                    {
                        // La première valeur contient entièrement la chaine capturée (voir la doc sur preg_match)
                        if ($key !== 0)
                        {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }
                    
                    // On assigne ce tableau de variables � la route
                    $route->setVars($listVars);
                }
                
                return $route;
            }
        }
        
        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    }
}

class TestXml
{
  
    public function getXml()
    {
        $router = new Router;
        
        $xml = new DOMDocument;
        $xml->load(__DIR__.'/configNews2.xml');

        $routes = $xml->getElementsByTagName('route');


        
        // On parcourt les routes du fichier XML.
        foreach ($routes as $route)
        {
            $vars = [];
            
            // On regarde si des variables sont présentes dans l'URL.
            if ($route->hasAttribute('vars'))
            {
                $vars = explode(',', $route->getAttribute('vars'));
                //var_dump($vars);
            }
            
             // On ajoute la route au routeur.
            $router->addRoute(new Route($route->getAttribute('url'),
            $route->getAttribute('module'), $route->getAttribute('action'), $vars));
            
        }
        
        var_dump($router->routes);//affiche les routes chargés du fichier xml configNews2.xml
        
    }
    

} 

$testRouting = new TestXml();
$testRouting->getXml(); 


