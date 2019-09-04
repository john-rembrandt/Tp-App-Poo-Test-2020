<?php

namespace Application\View;


class Page
{
    public $vue = __DIR__.'\vueNews.php';
    
    public $content;
    
    public function affichageVue($news)
    {
        
        extract($news);
        
        ob_start();
        require $this->vue;
        $this->content = ob_get_clean();
        
        echo $this->content;
        
        //ps: ajouter les instuction pour le cache avec "ob_get_content" 
        //      modifier le traitement des donnees dans la vue
        // voir aussi arrayAcess
    }
}