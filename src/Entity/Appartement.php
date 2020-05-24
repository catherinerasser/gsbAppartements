<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Id\AssignedGenerator;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppartementRepository")
 */
class Appartement
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_appart;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_voy;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_chamb;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_lits;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_sb;

    /**
     * @ORM\Column(type="boolean")
     */
    private $wifi;

    /**
     * @ORM\Column(type="boolean")
     */
    private $chauffage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cuisine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lave_linge;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_appart;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_loc;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_charges;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rue;

    /**
     * @ORM\Column(type="integer")
     */
    private $arrondissement;

    /**
     * @ORM\Column(type="integer")
     */
    private $etage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ascenseur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $preavis;

    /**
     * @ORM\Column(type="date")
     */
    private $date_libre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proprietaire", inversedBy="appartements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_Pro;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Admin", mappedBy="appartement")
     */
    private $admins;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visite", mappedBy="id_appartement")
     */
    private $visites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="id_appartement")
     */
    private $photos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Locataire", mappedBy="num_appart", cascade={"persist", "remove"})
     */
    private $locataire;

    public function __construct($nom,$voy,$cham,$lit,$sb,$wifi,$chau,$cui,$lave,$type,$prixloc,$prixchar,$adresse,$arron,$eta,$asc,$prea,$id,$date)
    {
        //constructeur de la classe Appartement
        $this->nom_appart = $nom ;
        $this->nb_voy = $voy;
        $this->nb_chamb = $cham;
        $this->nb_lits = $lit;
        $this->nb_sb = $sb ;
        $this->wifi = $wifi ;
        $this->chauffage = $chau;
        $this->cuisine = $cui;
        $this->lave_linge = $lave;
        $this->type_appart = $type;
        $this->prix_loc = $prixloc;
        $this->prix_charges = $prixchar;
        $this->rue = $adresse;
        $this->arrondissement =$arron;
        $this->etage = $eta;
        $this->ascenseur = $asc;
        $this->preavis = $prea;
        $this->date_libre = $date;
        $this->id_Pro = $id;
        $this->locataire = null ;
        $this->admins = new ArrayCollection();
        $this->visites = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        //recupere l'id de l'objet
        return $this->id;
    }

    public function getNomAppart(): ?string
    {
        return $this->nom_appart;
    }

    public function setNomAppart(string $nom_appart): self
    {
        $this->nom_appart = $nom_appart;

        return $this;
    }

    public function getNbVoy(): ?int
    {
        return $this->nb_voy;
    }

    public function setNbVoy(int $nb_voy): self
    {
        $this->nb_voy = $nb_voy;

        return $this;
    }

    public function getNbChamb(): ?int
    {
        return $this->nb_chamb;
    }

    public function setNbChamb(int $nb_chamb): self
    {
        $this->nb_chamb = $nb_chamb;

        return $this;
    }

    public function getNbLits(): ?int
    {
        return $this->nb_lits;
    }

    public function setNbLits(int $nb_lits): self
    {
        $this->nb_lits = $nb_lits;

        return $this;
    }

    public function getNbSb(): ?int
    {
        return $this->nb_sb;
    }

    public function setNbSb(int $nb_sb): self
    {
        $this->nb_sb = $nb_sb;

        return $this;
    }

    public function getWifi(): ?bool
    {
        return $this->wifi;
    }

    public function setWifi(bool $wifi): self
    {
        $this->wifi = $wifi;

        return $this;
    }

    public function getChauffage(): ?bool
    {
        return $this->chauffage;
    }

    public function setChauffage(bool $chauffage): self
    {
        $this->chauffage = $chauffage;

        return $this;
    }

    public function getCuisine(): ?bool
    {
        return $this->cuisine;
    }

    public function setCuisine(bool $cuisine): self
    {
        $this->cuisine = $cuisine;

        return $this;
    }

    public function getLaveLinge(): ?bool
    {
        return $this->lave_linge;
    }

    public function setLaveLinge(bool $lave_linge): self
    {
        $this->lave_linge = $lave_linge;

        return $this;
    }

    public function getTypeAppart(): ?string
    {
        return $this->type_appart;
    }

    public function setTypeAppart(string $type_appart): self
    {
        $this->type_appart = $type_appart;

        return $this;
    }

    public function getPrixLoc(): ?int
    {
        return $this->prix_loc;
    }

    public function setPrixLoc(int $prix_loc): self
    {
        $this->prix_loc = $prix_loc;

        return $this;
    }

    public function getPrixCharges(): ?int
    {
        return $this->prix_charges;
    }

    public function setPrixCharges(int $prix_charges): self
    {
        $this->prix_charges = $prix_charges;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getArrondissement(): ?int
    {
        return $this->arrondissement;
    }

    public function setArrondissement(int $arrondissement): self
    {
        $this->arrondissement = $arrondissement;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getAscenseur(): ?bool
    {
        return $this->ascenseur;
    }

    public function setAscenseur(bool $ascenseur): self
    {
        $this->ascenseur = $ascenseur;

        return $this;
    }

    public function getPreavis(): ?bool
    {
        return $this->preavis;
    }

    public function setPreavis(bool $preavis): self
    {
        $this->preavis = $preavis;

        return $this;
    }

    public function getDateLibre(): ?\DateTimeInterface
    {
        return $this->date_libre;
    }

    public function setDateLibre(\DateTimeInterface $date_libre): self
    {
        $this->date_libre = $date_libre;

        return $this;
    }

    public function getIdPro(): ?Proprietaire
    {
        return $this->id_Pro;
    }

    public function setIdPro(?Proprietaire $id_Pro): self
    {
        $this->id_Pro = $id_Pro;

        return $this;
    }

    /**
     * @return Collection|Admin[]
     */
    public function getAdmins(): Collection
    {
        return $this->admins;
    }

    public function addAdmin(Admin $admin): self
    {
        if (!$this->admins->contains($admin)) {
            $this->admins[] = $admin;
            $admin->addAppartement($this);
        }

        return $this;
    }

    public function removeAdmin(Admin $admin): self
    {
        if ($this->admins->contains($admin)) {
            $this->admins->removeElement($admin);
            $admin->removeAppartement($this);
        }

        return $this;
    }

    /**
     * @return Collection|Visite[]
     */
    public function getVisites(): Collection
    {
        return $this->visites;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visites->contains($visite)) {
            $this->visites[] = $visite;
            $visite->setIdAppartement($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visites->contains($visite)) {
            $this->visites->removeElement($visite);
            // set the owning side to null (unless already changed)
            if ($visite->getIdAppartement() === $this) {
                $visite->setIdAppartement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setIdAppartement($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getIdAppartement() === $this) {
                $photo->setIdAppartement(null);
            }
        }

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): self
    {
        $this->locataire = $locataire;

        // set (or unset) the owning side of the relation if necessary
        $newNum_appart = null === $locataire ? null : $this;
        if ($locataire->getNumAppart() !== $newNum_appart) {
            $locataire->setNumAppart($newNum_appart);
        }

        return $this;
    }
}
