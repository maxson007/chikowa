<?php

namespace App\Entity\Chikowa;

use App\Repository\Chikowa\TontineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TontineRepository::class)
 * @UniqueEntity(
 *     fields={"libelle","association"},
 *     errorPath="libelle"
 * )
 */
class Tontine
{

    const  PAYEMENT_FREQUENCE=[
        'Mensuel'=>'M',
        'Tous les 10 jours'=>'10D',
        'Hebdomadaire'=>'W'
    ];

    const PAYEMENT_FREQUENCE_KEYS=['M','10D','W'];

    const TYPE_TONTINE=[
        'Tontine rotative'=>'rotative',
        'Tontine à accumulation'=>'accumulation'
    ];
    const TYPE_TONTINE_ROTATIVE='rotative';
    const TYPE_TONTINE_ACCUMULATION='accumulation';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min="3",max="100")
     * @Assert\NotBlank()
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value="0")
     */
    private $montantParMembre;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Choice(choices=Tontine::PAYEMENT_FREQUENCE_KEYS)
     */
    private $frequencePaiement;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\GreaterThanOrEqual(value="today" ,groups={"Default"})
     */
    private $dateDebut;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="tontines")
     */
    private $association;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="tontine")
     */
    private $inscriptions;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tontineType;

    public function __construct()
    {
        $this->dateDebut=new \DateTime();
        $this->inscriptions = new ArrayCollection();
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
    public function getFrequencePaiementLibelle(): ?string
    {
        return array_flip(self::PAYEMENT_FREQUENCE)[$this->frequencePaiement];
    }

    public function setFrequencePaiement(string $frequencePaiement): self
    {
        $this->frequencePaiement = $frequencePaiement;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setTontine($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getTontine() === $this) {
                $inscription->setTontine(null);
            }
        }

        return $this;
    }

    public function getTontineType(): ?string
    {
        return $this->tontineType;
    }

    public function setTontineType(string $tontineType): self
    {
        $this->tontineType = $tontineType;

        return $this;
    }

}
