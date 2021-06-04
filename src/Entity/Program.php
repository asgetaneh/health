<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 */
class Program
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
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="programs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity=ProgramType::class, inversedBy="programs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $programType;

    /**
     * @ORM\ManyToOne(targetEntity=ProgramLevel::class, inversedBy="programs")
     */
    private $programLevel;

    /**
     * @ORM\ManyToOne(targetEntity=EnrollmentType::class, inversedBy="programs")
     */
    private $enrollmentType;

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

    public function getDepartment(): ?Departement
    {
        return $this->department;
    }

    public function setDepartment(?Departement $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getProgramType(): ?ProgramType
    {
        return $this->programType;
    }

    public function setProgramType(?ProgramType $programType): self
    {
        $this->programType = $programType;

        return $this;
    }

    public function getProgramLevel(): ?ProgramLevel
    {
        return $this->programLevel;
    }

    public function setProgramLevel(?ProgramLevel $programLevel): self
    {
        $this->programLevel = $programLevel;

        return $this;
    }

    public function getEnrollmentType(): ?EnrollmentType
    {
        return $this->enrollmentType;
    }

    public function setEnrollmentType(?EnrollmentType $enrollmentType): self
    {
        $this->enrollmentType = $enrollmentType;

        return $this;
    }
}
