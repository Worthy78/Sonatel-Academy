<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApprenantRepository")
 */
class Apprenant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cohorte", inversedBy="apprenants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cohorte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Filiere", inversedBy="apprenants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filiere;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCohorte(): ?Cohorte
    {
        return $this->cohorte;
    }

    public function setCohorte(?Cohorte $cohorte): self
    {
        $this->cohorte = $cohorte;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getCompte(): ?User
    {
        return $this->compte;
    }

    public function setCompte(User $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->user->getEmail();
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }
}
