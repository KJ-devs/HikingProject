<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;

class ArticleController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    #[Route('/api/createArticle', name: 'api_article')]
    public function createArticle(Request $request): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        // Gérer l'authentification (exemple)
        $user = $this->security->getUser();
        $title = $data['title'];
        $content = $data['content'];
        $createdAt = $data['createdAt'];



        $response = [
            'user' => $user,
            'title' => $title,
            'content' => $content,
            'createdAt' => $createdAt,
        ];

        return $this->json($response);
    }
}
