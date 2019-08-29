<?php
require 'EntityModel.php';

class NewsModel extends EntityModel
{
    /*
    protected $erreurs = [],
    $id,
    $auteur,
    $titre,
    $contenu,
    $dateAjout,
    $dateModif;
    */
    
    public $id;
    public $auteur;
    public $titre;
    public $contenu;
    public $dateAjout;
    public $dateModif;
    
    /*
     
    public function __construct(array $donnees = [])
    {
        
        $this->setId($id);
        $this->setAuteur($auteur);
        $this->setTitre($titre);
        $this->setContenu($contenu);
        $this->setDateAjout($dateAjout);
        $this->setDateModif($dateModif);
        
        
        $this->hydrate($donnees);
     }
      
     */
     
    /* 
       
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
    
    */
        
        
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

