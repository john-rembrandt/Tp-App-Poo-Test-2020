<?php

class VueSelection
{
    public $vue = __DIR__.'\vueNews.php';

    public $news = [];
    
    public function affichageVue($news)
    {
        
        extract($this->news);
        
        ob_start();
        require $this->vue;
        $content = ob_get_clean();
        
        echo $content;
        
        //ps: ajouter les instuction pour le cache avec "ob_get_content" 
    }
}