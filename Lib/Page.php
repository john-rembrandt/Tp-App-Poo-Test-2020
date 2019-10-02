<?php

namespace Lib;


class Page
{
    public $commentsFile = __DIR__.'\..\Application\View\vueComments.php';
    public $newsFile = __DIR__.'\..\Application\View\vueNews.php';
    public $contentFile;
    public $content;
    
    public function affichageVue($news)
    {
        
        extract($news);
        
        ob_start();
        //require $this->commentsFile;
        require $this->contentFile;
        $content = ob_get_clean();
        
        
        ob_start();
        //$this->content;
        require __DIR__.'\..\Application\View\layout.php';
        
        return ob_get_flush();
        
        
        
        //ps: ajouter les instuction pour le cache avec "ob_get_content" 
        //      modifier le traitement des donnees dans la vue
        // voir aussi arrayAccess
        // voir le comportement de PDO fetch class
        //envoyé la vue en fonction de liste ou de commentaire
    }
}