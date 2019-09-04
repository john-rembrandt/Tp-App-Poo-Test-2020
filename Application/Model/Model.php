<?php

namespace Application\Model;

use PDO;

class Model
{
    public $selection;
    
    public $donnees;
    
    public $bdd;
    
    public function __CONSTRUCT()
    {
        $this->bdd = new PDOFactory();
    }
    
    
    public function selectionBase($db)
    {
        $selection = $db->query('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC LIMIT 0, 5');
        return $selection;
    }
    
    public function getSelection()
    {
        
        $this->selection = $this->selectionBase($this->bdd->getMysqlConnexion());
        
        $this->selection->execute();
        
        $this->selection->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'NewsModel');
        
        //$this->donnees = $this->selection->fetchAll();
        
        //return $this->donnees;
        return $this->selection->fetchAll();
    }
}
       
