<?php

namespace App\Entity;

use App\Repository\MissionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MissionsRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:missionsCollection","read:missions"}},)
 */
class Missions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:missionsCollection"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missionsCollection"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:missionsCollection"})
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missionsCollection"})
     */
    private $code_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missionsCollection"})
     */
    private $country;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:missionsCollection"})
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:missionsCollection"})
     */
    private $end_date;

    /**
     * @ORM\OneToMany(targetEntity=Agents::class, mappedBy="mission" )
     * @Groups({"read:missionsCollection"})
     */
    private $agents;

    /**
     * @ORM\ManyToMany(targetEntity=Speciality::class, inversedBy="missions")
     * @Groups({"read:missionsCollection"})
     */
    private $specialitys;

    /**
     * @ORM\OneToOne(targetEntity=Status::class, cascade={"persist", "remove"})
     * @Groups({"read:missionsCollection"})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Stashs::class, mappedBy="missions")
     * @Groups({"read:missionsCollection"})
     */
    private $stashs;

    /**
     * @ORM\OneToMany(targetEntity=Contacts::class, mappedBy="mission")
     * @Groups({"read:missionsCollection"})
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity=Targets::class, mappedBy="mission")
     * @Groups({"read:missionsCollection"})
     */
    private $targets;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:missionsCollection"})
     */
    private $type;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->specialitys = new ArrayCollection();
        $this->stashs = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->targets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->code_name;
    }

    public function setCodeName(string $code_name): self
    {
        $this->code_name = $code_name;

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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection|agents[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(agents $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
            $agent->setMission($this);
        }

        return $this;
    }

    public function removeAgent(agents $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getMission() === $this) {
                $agent->setMission(null);
            }
        }

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

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Stashs[]
     */
    public function getStashs(): Collection
    {
        return $this->stashs;
    }

    public function addStash(Stashs $stash): self
    {
        if (!$this->stashs->contains($stash)) {
            $this->stashs[] = $stash;
            $stash->setMissions($this);
        }

        return $this;
    }

    public function removeStash(Stashs $stash): self
    {
        if ($this->stashs->removeElement($stash)) {
            // set the owning side to null (unless already changed)
            if ($stash->getMissions() === $this) {
                $stash->setMissions(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contacts $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setMission($this);
        }

        return $this;
    }

    public function removeContact(Contacts $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getMission() === $this) {
                $contact->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Targets[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Targets $target): self
    {
        if (!$this->targets->contains($target)) {
            $this->targets[] = $target;
            $target->setMission($this);
        }

        return $this;
    }

    public function removeTarget(Targets $target): self
    {
        if ($this->targets->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getMission() === $this) {
                $target->setMission(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
