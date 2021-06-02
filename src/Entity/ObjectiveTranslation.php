<?php

namespace App\Entity;

use App\Repository\ObjectiveTranslationRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

/**
 * @ORM\Entity(repositoryClass=ObjectiveTranslationRepository::class)
 */
class ObjectiveTranslation implements TranslationInterface
{
    use TranslationTrait;
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
     * @ORM\Column(type="text")
     */
    private $outPut;

    /**
     * @ORM\Column(type="text")
     */
    private $outCome;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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

    public function getOutPut(): ?string
    {
        return $this->outPut;
    }

    public function setOutPut(string $outPut): self
    {
        $this->outPut = $outPut;

        return $this;
    }

    public function getOutCome(): ?string
    {
        return $this->outCome;
    }

    public function setOutCome(string $outCome): self
    {
        $this->outCome = $outCome;

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
}
