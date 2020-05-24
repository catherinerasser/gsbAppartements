<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="visites")
     */
    private $id_client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Appartement", inversedBy="visites")
     */
    private $id_appartement;

    /**
     * @ORM\Column(type="date")
     */
    private $date_visite;


    public function __construct($id,$date,$appart){ //constructeur de visite
        $this->id_client = $id ;
        $this->id_appartement = $appart;
        $this->date_visite=$date;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?Client
    {
        return $this->id_client;
    }

    public function setIdClient(?Client $id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getIdAppartement(): ?Appartement
    {
        return $this->id_appartement;
    }

    public function setIdAppartement(?Appartement $id_appartement): self
    {
        $this->id_appartement = $id_appartement;

        return $this;
    }

    public function getDateVisite(): ?\DateTimeInterface
    {
        return $this->date_visite;
    }

    public function setDateVisite(\DateTimeInterface $date_visite): self
    {
        $this->date_visite = $date_visite;

        return $this;
    }
}
