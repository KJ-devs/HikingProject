<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $size = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    private ?Article $article_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): static
    {
        $this->size = $size;

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
