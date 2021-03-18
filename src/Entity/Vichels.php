<?php

namespace App\Entity;

use App\Repository\VichelsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VichelsRepository::class)
 */
class Vichels
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
    private $shancyNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShancyNumber(): ?string
    {
        return $this->shancyNumber;
    }

    public function setShancyNumber(string $shancyNumber): self
    {
        $this->shancyNumber = $shancyNumber;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
