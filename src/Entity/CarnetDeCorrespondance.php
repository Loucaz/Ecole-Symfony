<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarnetDeCorrespondanceRepository")
 */
class CarnetDeCorrespondance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetCarnet", mappedBy="carnet")
     */
    private $objetCarnets;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Enfant", inversedBy="carnetDeCorrespondance", cascade={"persist", "remove"})
     */
    private $enfant;

    public function __construct()
    {
        $this->objetCarnets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|ObjetCarnet[]
     */
    public function getObjetCarnets(): Collection
    {
        return $this->objetCarnets;
    }

    public function addObjetCarnet(ObjetCarnet $objetCarnet): self
    {
        if (!$this->objetCarnets->contains($objetCarnet)) {
            $this->objetCarnets[] = $objetCarnet;
            $objetCarnet->setCarnet($this);
        }

        return $this;
    }

    public function removeObjetCarnet(ObjetCarnet $objetCarnet): self
    {
        if ($this->objetCarnets->contains($objetCarnet)) {
            $this->objetCarnets->removeElement($objetCarnet);
            // set the owning side to null (unless already changed)
            if ($objetCarnet->getCarnet() === $this) {
                $objetCarnet->setCarnet(null);
            }
        }

        return $this;
    }

    public function getEnfant(): ?Enfant
    {
        return $this->enfant;
    }

    public function setEnfant(?Enfant $enfant): self
    {
        $this->enfant = $enfant;

        return $this;
    }
}
