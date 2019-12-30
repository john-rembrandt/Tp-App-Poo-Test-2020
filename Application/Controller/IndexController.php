<?php
namespace Application\Controller;

use Application\Cache\Cache;
use Application\Model\Model;
use Lib\Page;
use Lib\HTTPRequest;

class IndexController
{
    
    public $donnee;

    public $cacheIndex;
    
    public $page;
    
    public $httpRequest;
    
    //public $commentsFile = __DIR__.'\..\Application\View\vueComments.php';
    //public $contentFile = __DIR__.'\..\Application\View\vueNews.php'; 

    public function __CONSTRUCT()
    {  
        
        $this->donnee = new Model();
        $this->cacheIndex = new Cache();
        $this->page = new Page();
        //$this->httpRequest = new HTTPRequest(); A intégrer
        
    }

    public function executeIndex()
    {
        
        if($this->cacheIndex->dateCreationCache() == true)
        {
            $this->cacheIndex->lireCache();
        }
        else
        {
            if($_GET['choix'] == 'comments')
            {
                $this->page->contentFile = $this->page->commentsFile;
                
                $this->cacheIndex->creerCache($this->cacheIndex->fichierCache,
                $this->page->affichageVue($this->donnee->getSelectionCommentaire()));
            }
            
            if($_GET['choix'] == 'liste')
            {
                $this->page->contentFile = $this->page->newsFile;
                
                $this->cacheIndex->creerCache($this->cacheIndex->fichierCache,
                $this->page->affichageVue($this->donnee->getSelectionListe())); 
            }
             
        }
      }
    
}