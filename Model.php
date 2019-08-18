<?php
require 'PDOFactory.php';

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
        $selection = $db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC LIMIT 0, 5');
        return $selection;
    }
    
    public function getSelection()
    {
        
        $this->selection = $this->selectionBase($this->bdd->getMysqlConnexion());
        $this->selection->execute();
        $this->donnees = $this->selection->fetch(PDO::FETCH_ASSOC);
        return $this->donnees;
        
    }
}
       
