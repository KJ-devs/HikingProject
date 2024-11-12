<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    #[Route('/api/profile', name: 'api_profile')]
    public function index(UserInterface $user): JsonResponse
    {
        // recupere le email du user
        $email = $this->getUser()->getUserIdentifier();


        return $this->json($email);
    }
}
