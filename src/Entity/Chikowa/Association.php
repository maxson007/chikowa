<?php

namespace App\Entity\Chikowa;

use App\Entity\ChikowaUser;
use App\Repository\Chikowa\AssociationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AssociationRepository::class)
 */
class Association
{
    const ASSOCIATION_TYPE_VALUES = [
        "association-loi-de-1901"=>"Association loi de 1901",
        "association-de-fait-ou-association-non-declaree"=>"Association de fait ou association non déclarée",
        "association-avec-agrement"=>"Association avec agrément",
        "association-dutilite-publique"=>"Association d'utilité publique",
        "autre"=>"Autre"
    ];
    const ASSOCIATION_TYPE_KEYS = [
        "association-de-fait-ou-association-non-declaree",
        "association-loi-de-1901",
        "association-avec-agrement",
        "association-dutilite-publique",
        "autre"
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="3",max="200")
     * @Assert\NotBlank()
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Choice(choices=Association::ASSOCIATION_TYPE_KEYS)
     */
    private $typeEntite;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $localisation;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank()
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $ville;

    /**
     * @ORM\ManyToMany(targetEntity=ChikowaUser::class, inversedBy="associations")
     * @Assert\NotNull()
     */
    private $gestionaires;

    /**
     * @ORM\ManyToMany(targetEntity=Membre::class, inversedBy="associations")
     */
    private $membres;

    public function __construct()
    {
        $this->gestionaires = new ArrayCollection();
        $this->membres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTypeEntite(): ?string
    {
        return $this->typeEntite;
    }

    public function setTypeEntite(string $typeEntite): self
    {
        $this->typeEntite = $typeEntite;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|ChikowaUser[]
     */
    public function getGestionaires(): Collection
    {
        return $this->gestionaires;
    }

    public function addGestionaire(ChikowaUser $gestionaire): self
    {
        if (!$this->gestionaires->contains($gestionaire)) {
            $this->gestionaires[] = $gestionaire;
        }

        return $this;
    }

    public function removeGestionaire(ChikowaUser $gestionaire): self
    {
        if ($this->gestionaires->contains($gestionaire)) {
            $this->gestionaires->removeElement($gestionaire);
        }

        return $this;
    }

    /**
     * @return Collection|Membre[]
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membre $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres[] = $membre;
        }

        return $this;
    }

    public function removeMembre(Membre $membre): self
    {
        if ($this->membres->contains($membre)) {
            $this->membres->removeElement($membre);
        }

        return $this;
    }
}
