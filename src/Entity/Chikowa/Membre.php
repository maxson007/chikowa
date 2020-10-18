<?php

namespace App\Entity\Chikowa;

use App\Repository\Chikowa\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 */
class Membre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\ManyToMany(targetEntity=Tontine::class, inversedBy="membres")
     */
    private $tontines;

    public function __construct()
    {
        $this->tontines = new ArrayCollection();
    }

    public function getId(): ?int
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
     * @return Collection|Tontine[]
     */
    public function getTontines(): Collection
    {
        return $this->membres;
    }

    public function addTontine(Tontine $tontine): self
    {
        if (!$this->tontines->contains($tontine)) {
            $this->tontines[] = $tontine;
        }

        return $this;
    }

    public function removeTontine(Tontine $tontine): self
    {
        if ($this->tontines->contains($tontine)) {
            $this->tontines->removeElement($tontine);
        }

        return $this;
    }
}
