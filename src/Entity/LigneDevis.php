<?php

namespace App\Entity;

use App\Repository\LigneDevisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: LigneDevisRepository::class)]
#[Broadcast]
class LigneDevis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Devis::class, inversedBy: 'ligneDevis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Devis $devis = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix_unitaire_ht = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montant_ht = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(?Devis $devis): self
    {
        $this->devis = $devis;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function getPrixUnitaireHt(): ?string
    {
        return $this->prix_unitaire_ht;
    }

    public function setPrixUnitaireHt(string $prix_unitaire_ht): self
    {
        $this->prix_unitaire_ht = $prix_unitaire_ht;
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
}
