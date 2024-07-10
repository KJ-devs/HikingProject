<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class LoginController extends AbstractController
{
    #[Route('/auth/login', name: 'api_login')]
    public function index(#[CurrentUser] ?User $user): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $this->json([
            'user'  => $user->getUserIdentifier(),
        ]);
    }
}
