<?php

namespace ProjetDeCache;

class Cache
{
    public $fichierCache = 'Cache/cache.html';
    
    
    public $donnee;
    
    
    public function executerCache()
    {
        
        if($this->dateCreationCache() == true)
        {
            $this->lireCache();
        }
        else
        {
            
             $this->creerCache();
        }
    }

    public function lireCache()
    {
        readfile($this->fichierCache);
    }
    
    public function creerCache($fichierCache, $data)
    {
       file_put_contents($fichierCache, $data);

    }    
    public function dateCreationCache() 
    {
        $expire = time() -20; // valable une heure
        if(filemtime($this->fichierCache) > $expire)
        {
            echo date ("F d Y H:i:s.", filemtime($this->fichierCache));
            echo "on lit le cache";
            return true;
           
        }
        else
        {
            echo date("H:i:s.", filemtime($this->fichierCache));
            echo "on lance et on crée le cache en meme temps";
            return false;
        }
        
               
    }
    
    public function effacerCache($fichierCache)
    {
        file_put_contents($fichierCache, '');
    }
    
    public function insererVue($fichierCache)
    {
        
    }
}