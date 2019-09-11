<?php

namespace Application\View;


class Page
{
    public $vue = __DIR__.'\vueNews.php';
    
    public $layout = __DIR__.'\layout.php';
    
    public $content;
    
    public function affichageVue($news)
    {
        
        extract($news);
        
        ob_start();
        require __DIR__.'\vueNews.php';
        require __DIR__.'\layout.php';
        $this->content = ob_get_clean();
        
        echo $this->content;
        
        //ob_start();
        //require __DIR__.'\layout.php';
        //return ob_get_flush();
        
        //echo $this->content;
        
        //ps: ajouter les instuction pour le cache avec "ob_get_content" 
        //      modifier le traitement des donnees dans la vue
        // voir aussi arrayAccess
    }
}