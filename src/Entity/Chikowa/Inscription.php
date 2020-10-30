<?php

namespace App\Entity\Chikowa;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Chikowa\InscriptionRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="inscriptions", fetch="EAGER",cascade={"persist"}))
     * @ORM\JoinColumn(nullable=false)
     *  @Assert\Valid()
     */
    private $membre;

    /**
     * @ORM\ManyToOne(targetEntity=Tontine::class, inversedBy="inscriptions",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $tontine;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    public function __construct()
    {
        $this->dateCreation = new DateTime();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getTontine(): ?Tontine
    {
        return $this->tontine;
    }

    public function setTontine(?Tontine $tontine): self
    {
        $this->tontine = $tontine;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
}
