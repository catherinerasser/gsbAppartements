<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocataireRepository")
 */
class Locataire extends Personne
{
    
    private $type = 'loc';

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Banque", inversedBy="locataires")
     */
    private $id_banque;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Appartement", inversedBy="locataire")
     */
    private $num_appart;

   
    public function __construct($nom,$prenom,$adresse,$ville,$cp,$tel,$anniv,$login,$mdp,$rib,$email,$telB,$idB,$idA)
    {
        //constructeur de la classe enfant qui appelle celui du parent
        parent::__construct($nom,$prenom,$adresse,$ville,$cp,$tel,$anniv,$login,$mdp,$rib,$email,$telB);
        $this->id_banque = $idB;
        $this->num_appart = $idA;
    }
    

    public function getIdBanque(): ?Banque
    {
        return $this->id_banque;
    }

    public function setIdBanque(?Banque $id_banque): self
    {
        $this->id_banque = $id_banque;

        return $this;
    }

    public function getNumAppart(): ?Appartement
    {
        return $this->num_appart;
    }

    public function setNumAppart(?Appartement $num_appart): self
    {
        $this->num_appart = $num_appart;

        return $this;
    }

    public function getType(){
        return $this->type;
    }

    

}
