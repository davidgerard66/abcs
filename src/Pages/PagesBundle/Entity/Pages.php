<?php

namespace Pages\PagesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Pages\PagesBundle\Validator\Constraints as CustomAssert;


/**
 * Pages
 *
 * @ORM\Table("pages")
 * @ORM\Entity(repositoryClass="Pages\PagesBundle\Repository\PagesRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Pages
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     *
     */
    private $deletedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created; // sur les extension doctrine, pas bespoin def aire les getter et les setters, sauf si on veut recup la data dans le code il faudra les getter et setter

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


    /**
     * @Gedmo\Timestampable(on="change", field={"titre"})
     * @ORM\Column(name="titleChanged", type="datetime", nullable=true)
     */
    private $titleChanged; // evenement perso, on timestamp le changement dune colonne titre

    /**
     * @ORM\column(length=128, unique=true)
     * @Gedmo\Slug(fields={"grandtitre"})
     *
     */
    private $slug;


    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     *
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="grandtitre", type="string", length=255)
     *
     */
    private $grandtitre;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     *
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="langue", type="string", length=2,options={"default":"FR"})
     *
     */
    private $langue;


    /**
     * @ORM\Column(name="actif", type="boolean", options={"default":true})
     *
     */
    private $actif;

    /**
     * @ORM\Column(name="showslides", type="boolean", options={"default":true})
     *
     */
    private $showSlides;


    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @CustomAssert\constraintsCheckUrl(test="lalali")
     */
    private $contenu;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Pages
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }


    /**
     * Set grandtitre
     *
     * @param string $grandtitre
     * @return Pages
     */
    public function setGrandtitre($grandtitre)
    {
        $this->grandtitre = $grandtitre;

        return $this;
    }

    /**
     * Get grandtitre
     *
     * @return string
     */
    public function getGrandtitre()
    {
        return $this->grandtitre;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Pages
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set langue
     *
     * @param string $langue
     * @return Pages
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return string
     */
    public function getLangue()
    {
        return $this->langue;
    }


    /**
     * Set ordre
     *
     * @param string $ordre
     * @return Pages
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return string
     */
    public function getOrdre()
    {
        return $this->ordre;
    }


    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Pages
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
    /**
     * Get showSlides
     *
     * @return boolean
     */
    public function getshowSlides()
    {
        return $this->showSlides;
    }

    /**
     * Set showSlides
     *
     * @param boolean showSlides
     * @return Pages
     */
    public function setshowSlides($showSlides)
    {
        $this->showSlides = $showSlides;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set actif
     *
     * @param boolean actif
     * @return Pages
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }




    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set deletedAt
     *
     * @param datetime $deletedAt
     * @return Pages
     */
    public function setdeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
