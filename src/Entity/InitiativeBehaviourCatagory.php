<?php

namespace App\Entity;

use App\Repository\InitiativeBehaviourCatagoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InitiativeBehaviourCatagoryRepository::class)
 */
class InitiativeBehaviourCatagory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $cretedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="initiativeBehaviourCatagories")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=InitiativeBehaviour::class, mappedBy="category")
     */
    private $initiativeBehaviours;

    /**
     * @ORM\OneToMany(targetEntity=InitiativeAttribute::class, mappedBy="initiativeBehaviourCategory")
     */
    private $initiativeAttributes;

    public function __construct()
    {
        $this->initiativeBehaviours = new ArrayCollection();
        $this->initiativeAttributes = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getCretedAt(): ?\DateTimeInterface
    {
        return $this->cretedAt;
    }

    public function setCretedAt(\DateTimeInterface $cretedAt): self
    {
        $this->cretedAt = $cretedAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection|InitiativeBehaviour[]
     */
    public function getInitiativeBehaviours(): Collection
    {
        return $this->initiativeBehaviours;
    }

    public function addInitiativeBehaviour(InitiativeBehaviour $initiativeBehaviour): self
    {
        if (!$this->initiativeBehaviours->contains($initiativeBehaviour)) {
            $this->initiativeBehaviours[] = $initiativeBehaviour;
            $initiativeBehaviour->setCategory($this);
        }

        return $this;
    }

    public function removeInitiativeBehaviour(InitiativeBehaviour $initiativeBehaviour): self
    {
        if ($this->initiativeBehaviours->removeElement($initiativeBehaviour)) {
            // set the owning side to null (unless already changed)
            if ($initiativeBehaviour->getCategory() === $this) {
                $initiativeBehaviour->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InitiativeAttribute[]
     */
    public function getInitiativeAttributes(): Collection
    {
        return $this->initiativeAttributes;
    }

    public function addInitiativeAttribute(InitiativeAttribute $initiativeAttribute): self
    {
        if (!$this->initiativeAttributes->contains($initiativeAttribute)) {
            $this->initiativeAttributes[] = $initiativeAttribute;
            $initiativeAttribute->setInitiativeBehaviourCategory($this);
        }

        return $this;
    }

    public function removeInitiativeAttribute(InitiativeAttribute $initiativeAttribute): self
    {
        if ($this->initiativeAttributes->removeElement($initiativeAttribute)) {
            // set the owning side to null (unless already changed)
            if ($initiativeAttribute->getInitiativeBehaviourCategory() === $this) {
                $initiativeAttribute->setInitiativeBehaviourCategory(null);
            }
        }

        return $this;
    }
}
