<?php

namespace App\Entity\Chikowa;

use App\Repository\Chikowa\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 */
class Membre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="100")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="20")
     */
    private $telephone;

    /**
     * @ORM\ManyToMany(targetEntity=Association::class, mappedBy="membres")
     */
    private $associations;

    public function __construct()
    {
        $this->associations = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }
    
    /**
     * @return Collection|Association[]
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(Association $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations[] = $association;
            $association->addMembre($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): self
    {
        if ($this->associations->contains($association)) {
            $this->associations->removeElement($association);
            $association->removeMembre($this);
        }

        return $this;
    }
}
