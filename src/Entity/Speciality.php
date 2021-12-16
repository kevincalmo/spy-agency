<?php

namespace App\Entity;

use App\Repository\SpecialityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SpecialityRepository::class)
 * @ApiResource()
 */
class Speciality
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:agent"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Groups({"read:agent"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Agents::class, mappedBy="specialitys")
     */
    private $agents;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Agents[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agents $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
            $agent->addSpeciality($this);
        }

        return $this;
    }

    public function removeAgent(Agents $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            $agent->removeSpeciality($this);
        }

        return $this;
    }
}
