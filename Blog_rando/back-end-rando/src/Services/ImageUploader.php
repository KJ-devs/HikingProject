<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Photo;

class ImageUploader
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
    }

    public function upload(UploadedFile $file, ?Article $article = null): JsonResponse
    {
        $photo = new Photo();
        $photo->setImageFile($file);
        $photo->setSize($file->getSize());
        $photo->setArticle($article);

        // Validate the photo entity
        $errors = $this->validator->validate($photo);
        if (count($errors) > 0) {
            return new JsonResponse(['error' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }

        // Save the photo entity
        $this->entityManager->persist($photo);
        $this->entityManager->flush();

        return new JsonResponse(['id' => $photo->getId()], Response::HTTP_CREATED);
    }
}
