<?php
namespace ProjetDeCache;

//require 'Model.php';
//require 'Cache.php';
//require 'Page.php';

class IndexController
{
    public $bdd;
    
    public $donnee;

    public $cacheIndex;
    
    public $page;

    public function __CONSTRUCT()
    {  
        $this->bdd = new PDOFactory();
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
           
            $this->page->affichageVue($this->donnee->getSelection());
            
            
            $this->cacheIndex->creerCache($this->cacheIndex->fichierCache, $this->page->content); //$this->donnee->getSelection());  
        }
      }
    
}