<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;

class ImageUploader
{
    private $uploadsDirectory;
    private $validator;
    private $entityManager;

    public function __construct(string $uploadsDirectory, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->uploadsDirectory = $uploadsDirectory;
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

        // Handle file upload
        $filename = uniqid() . '.' . $file->guessExtension();

        try {
            $file->move($this->uploadsDirectory, $filename);
        } catch (FileException $e) {
            return new JsonResponse(['error' => 'Failed to upload file: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Set the image path
        $photo->setImagePath('/uploads/' . $filename);

        // Save the photo entity
        $this->entityManager->persist($photo);
        $this->entityManager->flush();

        return new JsonResponse(['id' => $photo->getId(), 'name' => $filename], Response::HTTP_CREATED);
    }
}
