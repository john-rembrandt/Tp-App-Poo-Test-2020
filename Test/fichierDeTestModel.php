<?php

class PDOFactory
{
    public static function getMysqlConnexion()
    {
        $db = new \PDO('mysql:host=localhost;dbname=DBnews2019', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        return $db;
    }
}


abstract class EntityModel //implements \ArrayAccess
{
    protected $erreurs = [],
    $id;
    
    public function __construct(array $donnees = [])
    {
        if (!empty($donnees))
        {
            $this->hydrate($donnees);
        }
    }
    
    public function isNew()
    {
        return empty($this->id);
    }
    
    public function erreurs()
    {
        return $this->erreurs;
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = (int) $id;
    }
    
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
            $methode = 'set'.ucfirst($attribut);
            
            if (is_callable([$this, $methode]))
            {
                $this->$methode($valeur);
            }
        }
    }
    
    public function offsetGet($var)
    {
        if (isset($this->$var) && is_callable([$this, $var]))
        {
            return $this->$var();
        }
    }
    
    public function offsetSet($var, $value)
    {
        $method = 'set'.ucfirst($var);
        
        if (isset($this->$var) && is_callable([$this, $method]))
        {
            $this->$method($value);
        }
    }
    
    public function offsetExists($var)
    {
        return isset($this->$var) && is_callable([$this, $var]);
    }
    
    public function offsetUnset($var)
    {
        throw new \Exception('Impossible de supprimer une quelconque valeur');
    }
}


class NewsModel extends EntityModel
{
    public $id;
    public $auteur;
    public $titre;
    public $contenu;
    public $dateAjout;
    public $dateModif;
    
    
    
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
    
    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }
    
    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }
    
    /**
     * @return mixed
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }
    
    /**
     * @return mixed
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }
    
    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    
    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
    
    /**
     * @param mixed $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }
    
    /**
     * @param mixed $dateModif
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;
    }
    
    
    
    
}


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
        $liste = $db->prepare('SELECT auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC LIMIT 0, 5');
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
        
        $this->liste->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'NewsModel');
        
         //essai debut
        return $this->liste->fetchAll();
        /*
        foreach ($listeNews as $news)
        {
             
        }
       
        $this->liste->closeCursor();
        */ 
        //return $listeNews;
        
        //return $this->liste->fetchAll();
    }
    
    //essai fin
    public function getSelectionCommentaire()
    {
        
        $this->comments = $this->selectionCommentaire($this->bdd->getMysqlConnexion());
        
        //$this->comments->bindValue(':news', $this->comments, \PDO::PARAM_INT);
        
        $this->comments->execute();
        
        $this->comments->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'CommentsModel');
        
        return $this->comments->fetchAll();
        
    }
}


class Page
{
    public $commentsFile = __DIR__.'\..\Test\vueComments.php';
    public $newsFile = __DIR__.'\..\Test\vueNews.php';
    public $contentFile;
    public $content;
    
    public function affichageVue($news)
    {
        
        extract($news);
        
        ob_start();
        //require $this->commentsFile;
        require $this->newsFile;
        $content = ob_get_clean();
        
        
        ob_start();
        //$this->content;
        require __DIR__.'\..\Test\layout.php';
        
        return ob_get_flush();
        
        
        
        //ps: ajouter les instuction pour le cache avec "ob_get_content"
        //      modifier le traitement des donnees dans la vue
        // voir aussi arrayAccess
        // voir le comportement de PDO fetch class
        //envoyé la vue en fonction de liste ou de commentaire
    }
}
class Test
{
    public $page;
    public $model;
    //public $newsModel;
    
    function __CONSTRUCT()
    {
        $this->page = new Page();
        $this->model = new Model();
        //$this->newsModel = new NewsModel();
    }
  
    function testModel()
    {
        $donnee = $this->model->getSelectionListe();
        $reponse = $this->page->affichageVue($donnee);
        
        return $reponse;
    }
    
    
   
}
$essai = new Test();

$essai->testModel();