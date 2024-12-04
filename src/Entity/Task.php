<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    //ManyToOne vers l'entite Project
    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'tasks')]
    private ?Project $project = null;

    #[ORM\OneToOne(targetEntity: Priority::class, inversedBy: 'tasks')]
    private ?Priority $priority = null;

    #[ORM\OneToOne(targetEntity: Status::class, inversedBy: 'tasks')]
    private ?Status $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;
        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }
    public function setStatus(?Status $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getPriority(): ?Priority{
        return $this->priority;
    }
    public function setPriority(?Priority $priority): static
    {
        $this->priority = $priority;
        return $this;
    }
}
