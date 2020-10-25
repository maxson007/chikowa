<?php

namespace App\Entity\Chikowa;

use App\Repository\Chikowa\TontineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TontineRepository::class)
 */
class Tontine
{

    const  PAYEMENT_FREQUENCE=[
        'Mensuel'=>'M',
        'Tous les 10 jours'=>'10D',
        'Hebdomadaire'=>'W'
    ];

    const PAYEMENT_FREQUENCE_KEYS=['M','10D','W'];

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

}
