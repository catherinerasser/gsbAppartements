<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin extends Personne
{


    private $type = 'adm';

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Appartement", inversedBy="admins")
     */
    private $appartement;

    public function __construct()
    {//constructeur de admin
        $this->appartement = new ArrayCollection();//collection d'appartements
    }

    /**
     * @return Collection|Appartement[]
     */
    public function getAppartement(): Collection
    {
        return $this->appartement;
    }

    public function addAppartement(Appartement $appartement): self //ajouter appartement à la collection
    {
        if (!$this->appartement->contains($appartement)) {
            $this->appartement[] = $appartement;
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): self//supprimer appartement de la collection
    {
        if ($this->appartement->contains($appartement)) {
            $this->appartement->removeElement($appartement);
        }

        return $this;
    }

    public function getTest(){
        return $this->test;
    }

    public function getType(){//recupere le type d'utilisateur
        return $this->type;
    }
    
}
