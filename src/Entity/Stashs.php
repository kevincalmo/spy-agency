<?php

namespace App\Entity;

use App\Repository\StashsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StashsRepository::class)
 * @ApiResource()
 */
class Stashs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:missions"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missions"})
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missions"})
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missions"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missions"})
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity=Missions::class, inversedBy="stashs")
     */
    private $missions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMissions(): ?Missions
    {
        return $this->missions;
    }

    public function setMissions(?Missions $missions): self
    {
        $this->missions = $missions;

        return $this;
    }
}
