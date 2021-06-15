<?php

namespace App\Entity;

use App\Repository\DelegationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DelegationRepository::class)
 */
class Delegation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="delegations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $delegatedBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="delegations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $delegatedUser;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reason;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelegatedBy(): ?User
    {
        return $this->delegatedBy;
    }

    public function setDelegatedBy(?User $delegatedBy): self
    {
        $this->delegatedBy = $delegatedBy;

        return $this;
    }

    public function getDelegatedUser(): ?User
    {
        return $this->delegatedUser;
    }

    public function setDelegatedUser(?User $delegatedUser): self
    {
        $this->delegatedUser = $delegatedUser;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
