<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjetCarnetRepository")
 */
class ObjetCarnet
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
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CarnetDeCorrespondance", inversedBy="objetCarnets")
     */
    private $carnet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCarnet(): ?CarnetDeCorrespondance
    {
        return $this->carnet;
    }

    public function setCarnet(?CarnetDeCorrespondance $carnet): self
    {
        $this->carnet = $carnet;

        return $this;
    }

    public function __toString(){
        return $this->type." ".$this->id;
        // TODO: Implement __toString() method.
    }
}
