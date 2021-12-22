<?php

namespace App\Entity;

use App\Repository\AgentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=AgentsRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:collection","read:agent"}},)
 */
class Agents
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:collection","read:missions"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Groups({"read:collection","read:missions"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Groups({"read:collection","read:missions"})
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    private $first_name;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read:collection"})
     */
    private $birth_date;

    /**
     * @ORM\Column(type="string", length=20)
     * * @Groups({"read:collection"})
     * @Assert\Length(min=20)
     * @Assert\NotBlank
     */
    private $authentification_code;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Groups({"read:collection","read:missions"})
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=Speciality::class, inversedBy="agents", cascade={"persist"})
     * @Groups({"read:collection"})
     */
    private $specialitys;

    /**
     * @ORM\ManyToOne(targetEntity=Missions::class, inversedBy="agents")
     */
    private $mission;

    public function __construct()
    {
        $this->specialitys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getAuthentificationCode(): ?string
    {
        return $this->authentification_code;
    }

    public function setAuthentificationCode(string $authentification_code): self
    {
        $this->authentification_code = $authentification_code;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Speciality[]
     */
    public function getSpecialitys(): Collection
    {
        return $this->specialitys;
    }

    public function addSpeciality(Speciality $speciality): self
    {
        if (!$this->specialitys->contains($speciality)) {
            $this->specialitys[] = $speciality;
        }

        return $this;
    }

    public function removeSpeciality(Speciality $speciality): self
    {
        $this->specialitys->removeElement($speciality);

        return $this;
    }

    public function getMission(): ?Missions
    {
        return $this->mission;
    }

    public function setMission(?Missions $mission): self
    {
        $this->mission = $mission;

        return $this;
    }
}
