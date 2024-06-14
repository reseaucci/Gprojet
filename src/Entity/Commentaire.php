<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Tache;


#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    /**
     * @var Collection<int, utilisateur>
     */
    #[ORM\OneToMany(targetEntity: utilisateur::class, mappedBy: 'commentaire')]
    private Collection $utilisateur_id;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    

    

    public function __construct()
    {
        $this->utilisateur_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection<int, utilisateur>
     */
    public function getUtilisateurId(): Collection
    {
        return $this->utilisateur_id;
    }

    public function addUtilisateurId(utilisateur $utilisateurId): static
    {
        if (!$this->utilisateur_id->contains($utilisateurId)) {
            $this->utilisateur_id->add($utilisateurId);
            $utilisateurId->setCommentaire($this);
        }

        return $this;
    }

    public function removeUtilisateurId(utilisateur $utilisateurId): static
    {
        if ($this->utilisateur_id->removeElement($utilisateurId)) {
            // set the owning side to null (unless already changed)
            if ($utilisateurId->getCommentaire() === $this) {
                $utilisateurId->setCommentaire(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    

    

    
}
