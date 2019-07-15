<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidatureRepository")
 */
class Candidature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $NiveauEtude;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $formationSouhaite;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $referentielChoisit;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $travaillezVous;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $domaineTravail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

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

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getNiveauEtude(): ?string
    {
        return $this->NiveauEtude;
    }

    public function setNiveauEtude(string $NiveauEtude): self
    {
        $this->NiveauEtude = $NiveauEtude;

        return $this;
    }

    public function getFormationSouhaite(): ?string
    {
        return $this->formationSouhaite;
    }

    public function setFormationSouhaite(string $formationSouhaite): self
    {
        $this->formationSouhaite = $formationSouhaite;

        return $this;
    }

    public function getReferentielChoisit(): ?string
    {
        return $this->referentielChoisit;
    }

    public function setReferentielChoisit(string $referentielChoisit): self
    {
        $this->referentielChoisit = $referentielChoisit;

        return $this;
    }

    public function getTravaillezVous(): ?string
    {
        return $this->travaillezVous;
    }

    public function setTravaillezVous(string $travaillezVous): self
    {
        $this->travaillezVous = $travaillezVous;

        return $this;
    }

    public function getDomaineTravail(): ?string
    {
        return $this->domaineTravail;
    }

    public function setDomaineTravail(string $domaineTravail): self
    {
        $this->domaineTravail = $domaineTravail;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
