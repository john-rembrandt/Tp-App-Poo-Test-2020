<?php

class TestXml
{
    public function getXml()
    {
        $xml = new DOMDocument;
        $xml->load(__DIR__.'/configNews2.xml');

        $routes = $xml->getElementsByTagName('route');

        foreach ($routes as $route)
        {
          //$vars = [];

            var_dump($route);
            
        }
    
    }
    

} 

$testRouting = new TestXml();
$testRouting->getXml(); 