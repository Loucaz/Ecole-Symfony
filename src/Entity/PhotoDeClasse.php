<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoDeClasseRepository")
 */
class PhotoDeClasse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $annee;

    /**
     * @ORM\Column(type="blob")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="photoDeClasses")
     */
    private $classe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }
}
