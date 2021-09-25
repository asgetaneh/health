<?php

namespace App\Entity;

use App\Repository\PerspectiveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @ORM\Entity(repositoryClass=PerspectiveRepository::class)
 */
class Perspective implements TranslatableInterface
{
    use TranslatableTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="perspectives")
     */
    private $createdBy;



    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $usedToPlan;

    /**
     * @ORM\OneToMany(targetEntity=Objective::class, mappedBy="perspective")
     */
    private $objectives;
    public function __toString()
    {
        return $this->getName();
    }
    public function __construct()
    {
        $this->objectives = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

     public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method,$arguments);
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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


    public function getUsedToPlan(): ?bool
    {
        return $this->usedToPlan;
    }

    public function setUsedToPlan(?bool $usedToPlan): self
    {
        $this->usedToPlan = $usedToPlan;

        return $this;
    }

    /**
     * @return Collection|Objective[]
     */
    public function getObjectives(): Collection
    {
        return $this->objectives;
    }

    public function addObjective(Objective $objective): self
    {
        if (!$this->objectives->contains($objective)) {
            $this->objectives[] = $objective;
            $objective->setPerspective($this);
        }

        return $this;
    }

    public function removeObjective(Objective $objective): self
    {
        if ($this->objectives->removeElement($objective)) {
            // set the owning side to null (unless already changed)
            if ($objective->getPerspective() === $this) {
                $objective->setPerspective(null);
            }
        }

        return $this;
    }
}
