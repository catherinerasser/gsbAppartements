<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BanqueRepository")
 */
class Banque
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
    private $rue_banque;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_postal_banque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville_banque;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel_banque;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Locataire", mappedBy="id_banque")
     */
    private $locataires;

    public function __construct()
    {
        //constructeur de la classe banque
        $this->locataires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRueBanque(): ?string
    {
        return $this->rue_banque;
    }

    public function setRueBanque(string $rue_banque): self
    {
        $this->rue_banque = $rue_banque;

        return $this;
    }

    public function getCodePostalBanque(): ?int
    {
        return $this->code_postal_banque;
    }

    public function setCodePostalBanque(int $code_postal_banque): self
    {
        $this->code_postal_banque = $code_postal_banque;

        return $this;
    }

    public function getVilleBanque(): ?string
    {
        return $this->ville_banque;
    }

    public function setVilleBanque(string $ville_banque): self
    {
        $this->ville_banque = $ville_banque;

        return $this;
    }

    public function getTelBanque(): ?int
    {
        return $this->tel_banque;
    }

    public function setTelBanque(int $tel_banque): self
    {
        $this->tel_banque = $tel_banque;

        return $this;
    }

    /**
     * @return Collection|Locataire[]
     */
    public function getLocataires(): Collection //collection de locataire utilisant cette banque
    {
        return $this->locataires;
    }

    public function addLocataire(Locataire $locataire): self
    {
        if (!$this->locataires->contains($locataire)) {
            $this->locataires[] = $locataire;
            $locataire->setIdBanque($this);
        }

        return $this;
    }

    public function removeLocataire(Locataire $locataire): self
    {
        if ($this->locataires->contains($locataire)) {
            $this->locataires->removeElement($locataire);
            // set the owning side to null (unless already changed)
            if ($locataire->getIdBanque() === $this) {
                $locataire->setIdBanque(null);
            }
        }

        return $this;
    }
}
