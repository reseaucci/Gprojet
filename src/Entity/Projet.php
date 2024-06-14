<?php
// src/Entity/Projet.php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[Broadcast]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $budget = null;

    #[ORM\ManyToOne(targetEntity: Responsable::class)]
#[ORM\JoinColumn(name: 'responsable_id', referencedColumnName: 'id', nullable: false)]
private ?Responsable $responsable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(targetEntity: Jalon::class, mappedBy: 'projet')]
    private Collection $jalons;

    #[ORM\OneToMany(targetEntity: Fichier::class, mappedBy: 'projet')]
    private Collection $fichiers;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $budget_previsionnel = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $budget_reel = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $avancement = null;

    #[ORM\OneToMany(targetEntity: Risque::class, mappedBy: 'projet')]
    private Collection $risques;

    #[ORM\OneToMany(targetEntity: Probleme::class, mappedBy: 'projet')]
    private Collection $problemes;

    #[ORM\OneToMany(targetEntity: Devis::class, mappedBy: 'projet')]
    private Collection $devis;

    public function __construct()
    {
        $this->jalons = new ArrayCollection();
        $this->fichiers = new ArrayCollection();
        $this->risques = new ArrayCollection();
        $this->problemes = new ArrayCollection();
        $this->devis = new ArrayCollection();
    }

    // Getters et setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;
        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;
        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(?string $budget): self
    {
        $this->budget = $budget;
        return $this;
    }

    public function getResponsable(): ?Responsable
    {
        return $this->responsable;
    }

    public function setResponsable(?Responsable $responsable): self
    {
        $this->responsable = $responsable;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    public function getBudgetPrevisionnel(): ?string
    {
        return $this->budget_previsionnel;
    }

    public function setBudgetPrevisionnel(?string $budget_previsionnel): self
    {
        $this->budget_previsionnel = $budget_previsionnel;
        return $this;
    }

    public function getBudgetReel(): ?string
    {
        return $this->budget_reel;
    }

    public function setBudgetReel(?string $budget_reel): self
    {
        $this->budget_reel = $budget_reel;
        return $this;
    }

    public function getAvancement(): ?int
    {
        return $this->avancement;
    }

    public function setAvancement(?int $avancement): self
    {
        $this->avancement = $avancement;
        return $this;
    }

    public function getJalons(): Collection
    {
        return $this->jalons;
    }

    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function getRisques(): Collection
    {
        return $this->risques;
    }

    public function getProblemes(): Collection
    {
        return $this->problemes;
    }

    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevis(Devis $devis): self
    {
        if (!$this->devis->contains($devis)) {
            $this->devis[] = $devis;
            $devis->setProjet($this);
        }
        return $this;
    }

    public function removeDevis(Devis $devis): self
    {
        $this->devis->removeElement($devis);
        if ($devis->getProjet() === $this) {
            $devis->setProjet(null);
        }
        return $this;
    }
}
