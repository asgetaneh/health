<?php

namespace App\Entity;

use App\Repository\SocialAttributeAchievementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocialAttributeAchievementRepository::class)
 */
class SocialAttributeAchievement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAttribute::class, inversedBy="socialAttributeAchievements")
     */
    private $attribute;

    /**
     * @ORM\Column(type="float")
     */
    private $plan;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $accomp;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAchievement::class, inversedBy="socialAttributeAchievements")
     */
    private $initiativeAchievement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttribute(): ?InitiativeAttribute
    {
        return $this->attribute;
    }

    public function setAttribute(?InitiativeAttribute $attribute): self
    {
        $this->attribute = $attribute;

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

    public function setAccomp(?float $accomp): self
    {
        $this->accomp = $accomp;

        return $this;
    }

    public function getInitiativeAchievement(): ?InitiativeAchievement
    {
        return $this->initiativeAchievement;
    }

    public function setInitiativeAchievement(?InitiativeAchievement $initiativeAchievement): self
    {
        $this->initiativeAchievement = $initiativeAchievement;

        return $this;
    }
}
