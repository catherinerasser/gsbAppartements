<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Appartement", inversedBy="photos")
     */
    private $id_appartement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPhoto(): ?string
    {
        return $this->nom_photo;
    }

    public function setNomPhoto(string $nom_photo): self
    {
        $this->nom_photo = $nom_photo;

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
}
