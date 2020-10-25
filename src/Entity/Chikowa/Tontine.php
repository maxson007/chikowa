<?php

namespace App\Entity\Chikowa;

use App\Repository\Chikowa\TontineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TontineRepository::class)
 */
class Tontine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $montantParMembre;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $frequencePaiement;

    /**
     * @ORM\ManyToOne(targetEntity=Tontine::class, inversedBy="tontines")
     */
    private $organisateur;

    /**
     * @ORM\OneToMany(targetEntity=Tontine::class, mappedBy="organisateur")
     */
    private $tontines;

    /**
     * @ORM\ManyToMany(targetEntity=Membre::class, mappedBy="tontines")
     */
    private $membres;

    public function __construct()
    {
        $this->tontines = new ArrayCollection();
        $this->membres = new ArrayCollection();
    }

    public function getId(): ?string
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

    public function getMontantParMembre(): ?float
    {
        return $this->montantParMembre;
    }

    public function setMontantParMembre(float $montantParMembre): self
    {
        $this->montantParMembre = $montantParMembre;

        return $this;
    }

    public function getFrequencePaiement(): ?string
    {
        return $this->frequencePaiement;
    }

    public function setFrequencePaiement(string $frequencePaiement): self
    {
        $this->frequencePaiement = $frequencePaiement;

        return $this;
    }

    public function getOrganisateur(): ?self
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?self $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getTontines(): Collection
    {
        return $this->tontines;
    }

    public function addTontine(self $tontine): self
    {
        if (!$this->tontines->contains($tontine)) {
            $this->tontines[] = $tontine;
            $tontine->setOrganisateur($this);
        }

        return $this;
    }

    public function removeTontine(self $tontine): self
    {
        if ($this->tontines->contains($tontine)) {
            $this->tontines->removeElement($tontine);
            // set the owning side to null (unless already changed)
            if ($tontine->getOrganisateur() === $this) {
                $tontine->setOrganisateur(null);
            }
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
            $membre->addMembre($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): self
    {
        if ($this->membres->contains($membre)) {
            $this->membres->removeElement($membre);
            $membre->removeMembre($this);
        }

        return $this;
    }
}
