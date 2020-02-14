<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnfantRepository")
 */
class Enfant
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="enfants")
     */
    private $parents;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Classe", inversedBy="enfants")
     */
    private $classes;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CarnetDeCorrespondance", mappedBy="enfant", cascade={"persist", "remove"})
     */
    private $carnetDeCorrespondance;


    public function __construct()
    {
        $this->parents = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParents(): Collection
    {
        return $this->parents;
    }

    public function addParent(User $parent): self
    {
        if (!$this->parents->contains($parent)) {
            $this->parents[] = $parent;
        }

        return $this;
    }

    public function removeParent(User $parent): self
    {
        if ($this->parents->contains($parent)) {
            $this->parents->removeElement($parent);
        }

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->contains($class)) {
            $this->classes->removeElement($class);
        }

        return $this;
    }

    public function getCarnetDeCorrespondance(): ?CarnetDeCorrespondance
    {
        return $this->carnetDeCorrespondance;
    }

    public function setCarnetDeCorrespondance(?CarnetDeCorrespondance $carnetDeCorrespondance): self
    {
        $this->carnetDeCorrespondance = $carnetDeCorrespondance;

        // set (or unset) the owning side of the relation if necessary
        $newEnfant = null === $carnetDeCorrespondance ? null : $this;
        if ($carnetDeCorrespondance->getEnfant() !== $newEnfant) {
            $carnetDeCorrespondance->setEnfant($newEnfant);
        }

        return $this;
    }

    public function __toString(){
        return $this->prenom." ".$this->nom;
        // TODO: Implement __toString() method.
    }
}
