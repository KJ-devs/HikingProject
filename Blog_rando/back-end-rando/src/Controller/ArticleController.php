<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Photo;

class ArticleController extends AbstractController
{
    private Security $security;
    private EntityManagerInterface $entityManager;
    private ArticleRepository $articleRepository;

    public function __construct(Security $security, EntityManagerInterface $entityManager, ArticleRepository $articleRepository)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->articleRepository = $articleRepository;
    }
    #[Route('/api/createArticle', name: 'api_article')]
    public function createArticle(Request $request): JsonResponse
    {
        $title = $request->request->get('title');
        $content = $request->request->get('content');

        // Gérer l'authentification (exemple)
        $user = $this->getUser(); // Assuming getUser() returns the authenticated user

        if (!$user) {
            return $this->json([
                'message' => 'User not authenticated'
            ], Response::HTTP_UNAUTHORIZED);
        }



        $createdAt = new \DateTimeImmutable();

        // Create a new Article entity
        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $article->setCreatedAt($createdAt);
        $article->setUser($user);

        // Handle file upload if photos are included in the request
        $uploadedFiles = $request->files->get('photos');
        if ($uploadedFiles) {
            foreach ($uploadedFiles as $uploadedFile) {
                // Create a new Photo entity for each uploaded file
                $photo = new Photo();
                $photo->setImageFile($uploadedFile);
                $photo->setSize($uploadedFile->getSize());
                $photo->setArticle($article);

                // Handle file upload and save to the filesystem
                $filename = uniqid() . '.' . $uploadedFile->guessExtension();
                $uploadedFile->move($this->getParameter('photos_directory'), $filename);

                // Add the Photo entity to the Article's collection
                $article->addPhoto($photo);
            }
        }

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        // Prepare the response
        $responseData = [
            'id' => $article->getId(),
            'user' => $article->getUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'createdAt' => $article->getCreatedAt()->format('Y-m-d H:i:s'),
        ];

        return $this->json($responseData, Response::HTTP_CREATED);
    }

    #[Route('/api/getArticles', name: 'api_get_articles')]
    public function getArticles(Request $request): JsonResponse
    {
        $articles = $this->articleRepository->findAll();
        $response = [];

        foreach ($articles as $article) {
            $photos = [];
            foreach ($article->getPhotos() as $photo) {
                $photos[] = [
                    'id' => $photo->getId(),
                    'size' => $photo->getSize(),
                    'imageBlob' => base64_encode(stream_get_contents($photo->getImageBlob())), // Encode the blob data
                ];
            }

            $response[] = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'content' => $article->getContent(),
                'createdAt' => $article->getCreatedAt()->format('Y-m-d'),
                'photos' => $photos,
                'user' => $article->getUser()->getUserIdentifier(),
            ];
        }

        return new JsonResponse($response);
    }
}
