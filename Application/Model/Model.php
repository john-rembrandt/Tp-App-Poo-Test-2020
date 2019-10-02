<?php

namespace Application\Model;

use Lib\PDOFactory;
use PDO;

class Model
{
    public $liste;
    
    public $comments;
    
    public $bdd;
    
    
    
    public function __CONSTRUCT()
    {
        $this->bdd = new PDOFactory();   
    }
    
    
    public function selectionListe($db)
    {
        $liste = $db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC LIMIT 0, 5');
        return $liste;
    }
    public function selectionCommentaire($db)
    {
      
        $comments = $db->prepare('SELECT id, news, auteur, contenu, date FROM comments');
        return $comments;
        
       
    }
    
    public function getSelectionListe()
    {
        
        $this->liste = $this->selectionListe($this->bdd->getMysqlConnexion());
        
        $this->liste->execute();
        
        //$this->liste->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'NewsModel');
        
        
        return $this->liste->fetchAll();
    }
    
    public function getSelectionCommentaire()
    {
        
        $this->comments = $this->selectionCommentaire($this->bdd->getMysqlConnexion());
        
        //$this->comments->bindValue(':news', $this->comments, \PDO::PARAM_INT);
        
        $this->comments->execute();
        
        $this->comments->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'CommentsModel');
        
        return $this->comments->fetchAll();
         
    }
}
       
