<?php

namespace App\Entity;

use App\Repository\SmisSettingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SmisSettingRepository::class)
 */
class SmisSetting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sendToPrincipal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sendToPlan;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxPenalityDays;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxAllowedTasks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSendToPrincipal(): ?int
    {
        return $this->sendToPrincipal;
    }

    public function setSendToPrincipal(?int $sendToPrincipal): self
    {
        $this->sendToPrincipal = $sendToPrincipal;

        return $this;
    }

    public function getSendToPlan(): ?int
    {
        return $this->sendToPlan;
    }

    public function setSendToPlan(?int $sendToPlan): self
    {
        $this->sendToPlan = $sendToPlan;

        return $this;
    }

    public function getMaxPenalityDays(): ?int
    {
        return $this->maxPenalityDays;
    }

    public function setMaxPenalityDays(?int $maxPenalityDays): self
    {
        $this->maxPenalityDays = $maxPenalityDays;

        return $this;
    }

    public function getMaxAllowedTasks(): ?int
    {
        return $this->maxAllowedTasks;
    }

    public function setMaxAllowedTasks(?int $maxAllowedTasks): self
    {
        $this->maxAllowedTasks = $maxAllowedTasks;

        return $this;
    }
}
