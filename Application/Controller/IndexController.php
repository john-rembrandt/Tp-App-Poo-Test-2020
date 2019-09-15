<?php
namespace Application\Controller;

use Application\Cache\Cache;
use Application\Model\Model;
use Lib\Page;

class IndexController
{
    
    public $donnee;

    public $cacheIndex;
    
    public $page;

    public function __CONSTRUCT()
    {  
        
        $this->donnee = new Model();
        $this->cacheIndex = new Cache();
        $this->page = new Page();
        
    }

    public function executeIndex()
    {
        
        if($this->cacheIndex->dateCreationCache() == true)
        {
            $this->cacheIndex->lireCache();
        }
        else
        {
             
            $this->cacheIndex->creerCache($this->cacheIndex->fichierCache, $this->page->affichageVue($this->donnee->getSelectionCommentaire()));  
        }
      }
    
}