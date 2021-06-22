<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvaluationRepository::class)
 */
class Evaluation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

 /**
     * @ORM\ManyToOne(targetEntity=TaskAccomplishment::class, inversedBy="evaluations")
     */
    private $taskAccomplishment;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="evaluations")
     */
    private $evaluateUser;
    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quality;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $time;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $behavior;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $selfEvaluation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $peerEvaluation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $customerEvaluation;

   

    public function getId(): ?int
    {
        return $this->id;
    }

  
    public function getTaskAccomplishment(): ?TaskAccomplishment
    {
        return $this->taskAccomplishment;
    }

    public function setTaskAccomplishment(?TaskAccomplishment $taskAccomplishment): self
    {
        $this->taskAccomplishment = $taskAccomplishment;

        return $this;
    }

    public function getEvaluateUser(): ?User
    {
        return $this->evaluateUser;
    }

    public function setEvaluateUser(?User $evaluateUser): self
    {
        $this->evaluateUser = $evaluateUser;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getQuality(): ?int
    {
        return $this->quality;
    }

    public function setQuality(int $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(?int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getBehavior(): ?int
    {
        return $this->behavior;
    }

    public function setBehavior(?int $behavior): self
    {
        $this->behavior = $behavior;

        return $this;
    }

    public function getSelfEvaluation(): ?int
    {
        return $this->selfEvaluation;
    }

    public function setSelfEvaluation(?int $selfEvaluation): self
    {
        $this->selfEvaluation = $selfEvaluation;

        return $this;
    }

    public function getPeerEvaluation(): ?int
    {
        return $this->peerEvaluation;
    }

    public function setPeerEvaluation(?int $peerEvaluation): self
    {
        $this->peerEvaluation = $peerEvaluation;

        return $this;
    }

    public function getCustomerEvaluation(): ?int
    {
        return $this->customerEvaluation;
    }

    public function setCustomerEvaluation(?int $customerEvaluation): self
    {
        $this->customerEvaluation = $customerEvaluation;

        return $this;
    }

}
