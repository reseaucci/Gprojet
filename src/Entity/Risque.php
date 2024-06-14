<?php

namespace App\Entity;

use App\Repository\RisqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: RisqueRepository::class)]
#[Broadcast]
class Risque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $impact_potentiel = null;

    

    #[ORM\Column(type: Types::TEXT)]
    private ?string $plan_action = null;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'risques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Projet $projet = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    #[ORM\Column(length: 255)]
    private ?string $nom = null;


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImpactPotentiel(): ?int
    {
        return $this->impact_potentiel;
    }

    public function setImpactPotentiel(int $impact_potentiel): static
    {
        $this->impact_potentiel = $impact_potentiel;

        return $this;
    }

    

    public function getPlanAction(): ?string
    {
        return $this->plan_action;
    }

    public function setPlanAction(string $plan_action): static
    {
        $this->plan_action = $plan_action;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
}
