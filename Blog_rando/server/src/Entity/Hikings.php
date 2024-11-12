<?php

namespace App\Entity;

use App\Repository\HikingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HikingsRepository::class)]
class Hikings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $starting_point = null;

    #[ORM\Column(length: 255)]
    private ?string $end_point = null;

    #[ORM\Column]
    private ?float $kilometer = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Article $article_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartingPoint(): ?string
    {
        return $this->starting_point;
    }

    public function setStartingPoint(string $starting_point): static
    {
        $this->starting_point = $starting_point;

        return $this;
    }

    public function getEndPoint(): ?string
    {
        return $this->end_point;
    }

    public function setEndPoint(string $end_point): static
    {
        $this->end_point = $end_point;

        return $this;
    }

    public function getKilometer(): ?float
    {
        return $this->kilometer;
    }

    public function setKilometer(float $kilometer): static
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    public function getArticleId(): ?Article
    {
        return $this->article_id;
    }

    public function setArticleId(?Article $article_id): static
    {
        $this->article_id = $article_id;

        return $this;
    }
}
