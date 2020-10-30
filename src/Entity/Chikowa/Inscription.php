<?php

namespace App\Entity\Chikowa;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Chikowa\InscriptionRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 * @UniqueEntity(fields={"membre", "tontine"}, errorPath="membre")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="inscriptions",cascade={"persist"}))
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     * @Groups({ "write"})
     */
    private $membre;

    /**
     * @ORM\ManyToOne(targetEntity=Tontine::class, inversedBy="inscriptions",fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     * @Groups({"read", "write"})
     */
    private $tontine;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value="0")
     * @Groups({"read", "write"})
     */
    private $positionRecuperation;

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

    public function getPositionRecuperation(): ?int
    {
        return $this->positionRecuperation;
    }

    public function setPositionRecuperation(int $positionRecuperation): self
    {
        $this->positionRecuperation = $positionRecuperation;

        return $this;
    }
}
