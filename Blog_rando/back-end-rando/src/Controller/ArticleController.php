<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleController extends AbstractController
{
    private Security $security;
    private EntityManagerInterface $entityManager;
    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }
    #[Route('/api/createArticle', name: 'api_article')]
    public function createArticle(Request $request): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        // Gérer l'authentification (exemple)
        $user = $this->security->getUser();

        if (!$user) {
            return $this->json([
                'message' => 'User not authenticated'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $title = $data['title'];
        $content = $data['content'];
        $createdAt = new \DateTimeImmutable();
        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $article->setCreatedAt($createdAt);
        $article->setUser($user);

        $this->entityManager->persist($article);
        $this->entityManager->flush();


        $response = [
            'user' => $user->getUserIdentifier(), // Assuming User entity has getUserIdentifier() method
            'title' => $title,
            'content' => $content,
            'createdAt' => $createdAt,
        ];

        return $this->json($response);
    }
}
