<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhotoDeClasse", mappedBy="classe")
     */
    private $photoDeClasses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Enfant", mappedBy="classes")
     */
    private $enfants;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="classes")
     */
    private $Maitre;

    public function __construct()
    {
        $this->photoDeClasses = new ArrayCollection();
        $this->enfants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|PhotoDeClasse[]
     */
    public function getPhotoDeClasses(): Collection
    {
        return $this->photoDeClasses;
    }

    public function addPhotoDeClass(PhotoDeClasse $photoDeClass): self
    {
        if (!$this->photoDeClasses->contains($photoDeClass)) {
            $this->photoDeClasses[] = $photoDeClass;
            $photoDeClass->setClasse($this);
        }

        return $this;
    }

    public function removePhotoDeClass(PhotoDeClasse $photoDeClass): self
    {
        if ($this->photoDeClasses->contains($photoDeClass)) {
            $this->photoDeClasses->removeElement($photoDeClass);
            // set the owning side to null (unless already changed)
            if ($photoDeClass->getClasse() === $this) {
                $photoDeClass->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enfant[]
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(Enfant $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->addClass($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            $enfant->removeClass($this);
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getMaitre(): ?User
    {
        return $this->Maitre;
    }

    public function setMaitre(?User $Maitre): self
    {
        $this->Maitre = $Maitre;

        return $this;
    }

}
