<?php

namespace Lib;


class Page
{
    public $commentsFile = __DIR__.'\..\Application\View\vueComments.php';
    public $contentFile = __DIR__.'\..\Application\View\vueNews.php';
    public $contentCache;
    public $content;
    
    public function affichageVue($news)
    {
        
        extract($news);
        
        ob_start();
        require $this->commentsFile;
        //equire $this->contentFile;
        $content = ob_get_clean();
        
        
        ob_start();
        //$this->content;
        require __DIR__.'\..\Application\View\layout.php';
        
        return ob_get_flush();
        
        
        
        //ps: ajouter les instuction pour le cache avec "ob_get_content" 
        //      modifier le traitement des donnees dans la vue
        // voir aussi arrayAccess
        // voir le comportement de PDO fetch class
    }
}