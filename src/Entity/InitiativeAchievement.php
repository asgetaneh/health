<?php

namespace App\Entity;

use App\Repository\InitiativeAchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InitiativeAchievementRepository::class)
 */
class InitiativeAchievement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Initiative::class, inversedBy="initiativeAchievements")
     */
    private $initiative;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="initiativeAchievements")
     */
    private $year;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $plan;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $accomp;

    /**
     * @ORM\OneToMany(targetEntity=SocialAttributeAchievement::class, mappedBy="initiativeAchievement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $socialAttributeAchievements;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_social;

    /**
     * @ORM\OneToMany(targetEntity=QuarterPlanAchievement::class, mappedBy="initiativeAchievement")
      
     *  @ORM\JoinColumn(nullable=true)
     *
     */
    private $quarterAchievement;

    public function __construct()
    {
        $this->socialAttributeAchievements = new ArrayCollection();
        $this->quarterAchievement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitiative(): ?Initiative
    {
        return $this->initiative;
    }

    public function setInitiative(?Initiative $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getYear(): ?PlanningYear
    {
        return $this->year;
    }

    public function setYear(?PlanningYear $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPlan(): ?float
    {
        return $this->plan;
    }

    public function setPlan(float $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getAccomp(): ?float
    {
        return $this->accomp;
    }

    public function setAccomp(float $accomp): self
    {
        $this->accomp = $accomp;

        return $this;
    }

    /**
     * @return Collection|SocialAttributeAchievement[]
     */
    public function getSocialAttributeAchievements(): Collection
    {
        return $this->socialAttributeAchievements;
    }

    public function addSocialAttributeAchievement(SocialAttributeAchievement $socialAttributeAchievement): self
    {
        if (!$this->socialAttributeAchievements->contains($socialAttributeAchievement)) {
            $this->socialAttributeAchievements[] = $socialAttributeAchievement;
            $socialAttributeAchievement->setInitiativeAchievement($this);
        }

        return $this;
    }

    public function removeSocialAttributeAchievement(SocialAttributeAchievement $socialAttributeAchievement): self
    {
        if ($this->socialAttributeAchievements->removeElement($socialAttributeAchievement)) {
            // set the owning side to null (unless already changed)
            if ($socialAttributeAchievement->getInitiativeAchievement() === $this) {
                $socialAttributeAchievement->setInitiativeAchievement(null);
            }
        }

        return $this;
    }

    public function getIsSocial(): ?bool
    {
        return $this->is_social;
    }

    public function setIsSocial(?bool $is_social): self
    {
        $this->is_social = $is_social;

        return $this;
    }

    /**
     * @return Collection|QuarterPlanAchievement[]
     */
    public function getQuarterAchievement(): Collection
    {
       
        return $this->quarterAchievement;
    }

    public function addQuarterAchievement(QuarterPlanAchievement $quarterAchievement): self
    {

        if (!$this->quarterAchievement->contains($quarterAchievement)) {
            $this->quarterAchievement[] = $quarterAchievement;
            $quarterAchievement->setInitiativeAchievement($this);
        }
        return $this;
    }

    public function removeQuarterAchievement(QuarterPlanAchievement $quarterAchievement): self
    {
        if ($this->quarterAchievement->removeElement($quarterAchievement)) {
            // set the owning side to null (unless already changed)
            if ($quarterAchievement->getInitiativeAchievement() === $this) {
                $quarterAchievement->setInitiativeAchievement(null);
            }
        }

        return $this;
    }
}
