<?php

class TestXml
{
    public function getXml()
    {
        $xml = new DOMDocument;
        $xml->load(__DIR__.'/configNews2.xml');

        $routes = $xml->getElementsByTagName('route');

//         foreach ($routes as $route)
//         {
//           //$vars = [];

//             var_dump($route);
            
//         }
        
        // On parcourt les routes du fichier XML.
        foreach ($routes as $route)
        {
            $vars = [];
            
            // On regarde si des variables sont présentes dans l'URL.
            if ($route->hasAttribute('vars'))
            {
                $vars = explode(',', $route->getAttribute('vars'));
                var_dump($vars);
            }
            
            /* // On ajoute la route au routeur.
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars)); */
        }
    }
    

} 

$testRouting = new TestXml();
$testRouting->getXml(); 


