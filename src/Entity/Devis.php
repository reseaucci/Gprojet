<?php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: DevisRepository::class)]
#[Broadcast]
class Devis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'devis')]
    private ?Client $client = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_echeance = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montant_ht = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $tva = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montant_ttc = null;

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: LigneDevis::class, cascade: ['persist', 'remove'])]
    private Collection $ligneDevis;

    #[ORM\ManyToOne(inversedBy: 'devis')]
    private ?Facture $facture = null;

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: Fichier::class, cascade: ['persist', 'remove'])]
    private Collection $fichiers;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'devis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Projet $projet = null;

    public function __construct()
    {
        $this->ligneDevis = new ArrayCollection();
        $this->fichiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    public function getDateEcheance(): ?\DateTimeInterface
    {
        return $this->date_echeance;
    }

    public function setDateEcheance(\DateTimeInterface $date_echeance): self
    {
        $this->date_echeance = $date_echeance;
        return $this;
    }

    public function getMontantHt(): ?string
    {
        return $this->montant_ht;
    }

    public function setMontantHt(string $montant_ht): self
    {
        $this->montant_ht = $montant_ht;
        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(string $tva): self
    {
        $this->tva = $tva;
        return $this;
    }

    public function getMontantTtc(): ?string
    {
        return $this->montant_ttc;
    }

    public function setMontantTtc(string $montant_ttc): self
    {
        $this->montant_ttc = $montant_ttc;
        return $this;
    }

    /**
     * @return Collection<int, LigneDevis>
     */
    public function getLigneDevis(): Collection
    {
        return $this->ligneDevis;
    }

    public function addLigneDevis(LigneDevis $ligneDevis): self
    {
        if (!$this->ligneDevis->contains($ligneDevis)) {
            $this->ligneDevis[] = $ligneDevis;
            $ligneDevis->setDevis($this);
        }

        return $this;
    }

    public function removeLigneDevis(LigneDevis $ligneDevis): self
    {
        if ($this->ligneDevis->removeElement($ligneDevis)) {
            // set the owning side to null (unless already changed)
            if ($ligneDevis->getDevis() === $this) {
                $ligneDevis->setDevis(null);
            }
        }

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;
        return $this;
    }

    /**
     * @return Collection<int, Fichier>
     */
    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function addFichier(Fichier $fichier): self
    {
        if (!$this->fichiers->contains($fichier)) {
            $this->fichiers[] = $fichier;
            $fichier->setDevis($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $fichier): self
    {
        if ($this->fichiers->removeElement($fichier)) {
            // set the owning side to null (unless already changed)
            if ($fichier->getDevis() === $this) {
                $fichier->setDevis(null);
            }
        }

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;
        return $this;
    }
}
