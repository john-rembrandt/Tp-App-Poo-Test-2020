<?php

require 'Model.php';
require 'Cache.php';
require 'VueSelection.php';

class IndexController
{
    public $bdd;
    
    public $donnee;

    public $cacheIndex;
    
    public $vueSelection;

    public function __CONSTRUCT()
    {
        $this->bdd = new PDOFactory();
        $this->donnee = new Model();
        $this->cacheIndex = new Cache();
        $this->vueSelection = new VueSelection();
        
    }

    public function executeIndex()
    {
        
        if($this->cacheIndex->dateCreationCache() == true)
        {
            $this->cacheIndex->lireCache();
        }
        else
        {
           
            $this->vueSelection->affichageVue($this->donnee->getSelection());
            
            
            $this->cacheIndex->creerCache($this->cacheIndex->fichierCache, $this->donnee->getSelection());  
            
        }
    }
}