<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;

class VerifyEmailController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/api/verify-email', name: 'api_verify_email', methods: ['GET'])]
    public function verifyEmail(Request $request): RedirectResponse
    {
        $token = $request->query->get('token');

        if (!$token) {
            return new JsonResponse(['message' => 'Verification token is missing.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $this->userRepository->findOneBy(['verificationToken' => $token]);

        if (!$user) {
            return new JsonResponse(['message' => 'Invalid verification token.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Optionally activate the user account
        $user->setIsVerified(true);
        $user->setVerificationToken(null);
        $this->userRepository->save($user);

        // flush the entity manager

        return new RedirectResponse('http://localhost:5173/login');

        // redirect to http://localhost:5173/





    }
}
