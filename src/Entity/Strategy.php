<?php

namespace App\Entity;

use App\Repository\StrategyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @ORM\Entity(repositoryClass=StrategyRepository::class)
 */
class Strategy implements TranslatableInterface

{
    use TranslatableTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=Objective::class, inversedBy="strategies")
     */
    private $objective;

   
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="strategies")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=KeyPerformanceIndicator::class, mappedBy="strategy")
     */
    private $keyPerformanceIndicators;

    public function __toString()
    {
        return $this->getName();
    }
    public function __construct()
    {
        $this->keyPerformanceIndicators = new ArrayCollection();
    }
     public function __call($method, $arguments)
    {
        if (!method_exists(self::getTranslationEntityClass(),$method)) {
           $method='get'.ucfirst($method);
        }
        return $this->proxyCurrentLocaleTranslation($method,$arguments);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getObjective(): ?Objective
    {
        return $this->objective;
    }

    public function setObjective(?Objective $objective): self
    {
        $this->objective = $objective;

        return $this;
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

    /**
     * @return Collection|KeyPerformanceIndicator[]
     */
    public function getKeyPerformanceIndicators(): Collection
    {
        return $this->keyPerformanceIndicators;
    }

    public function addKeyPerformanceIndicator(KeyPerformanceIndicator $keyPerformanceIndicator): self
    {
        if (!$this->keyPerformanceIndicators->contains($keyPerformanceIndicator)) {
            $this->keyPerformanceIndicators[] = $keyPerformanceIndicator;
            $keyPerformanceIndicator->setStrategy($this);
        }

        return $this;
    }

    public function removeKeyPerformanceIndicator(KeyPerformanceIndicator $keyPerformanceIndicator): self
    {
        if ($this->keyPerformanceIndicators->removeElement($keyPerformanceIndicator)) {
            // set the owning side to null (unless already changed)
            if ($keyPerformanceIndicator->getStrategy() === $this) {
                $keyPerformanceIndicator->setStrategy(null);
            }
        }

        return $this;
    }
}
