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
    #[Route('/api/getArticles', name: 'api_get_articles')]
    public function getArticles(Request $request)
    {
        $articles = $this->articleRepository->findAll();
        $response = [];
        foreach ($articles as $article) {
            $response[] = [
                'title' => $article->getTitle(),
                'content' => $article->getContent(),
                'createdAt' => $article->getCreatedAt(),
                'user' => $article->getUser()->getUserIdentifier(),
            ];
        }

        return $this->json($response);
    }
}
