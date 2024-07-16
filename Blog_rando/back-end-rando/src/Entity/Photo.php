<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    private ?Article $article = null;

    #[ORM\Column(type: 'blob')]
    private $imageBlob;

    #[Assert\File(
        maxSize: "150M",
        mimeTypes: ["image/jpeg", "image/png", "image/webp"]
    )]
    private $imageFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile($imageFile): self
    {
        $this->imageFile = $imageFile;

        // check if we have a new image file
        if ($imageFile instanceof UploadedFile) {
            // convert the file content to BLOB
            $this->imageBlob = file_get_contents($imageFile->getPathname());
        }

        return $this;
    }

    public function getImageBlob()
    {
        return $this->imageBlob;
    }
}
