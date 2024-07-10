<?php
// src/Controller/AuthController.php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface; // Import the EntityManager

use App\Entity\User;
use App\Repository\UserRepository;

class RegisterController extends AbstractController
{
    private $entityManager;
    private $user;
    public function __construct(EntityManagerInterface $entityManager, UserRepository $user)
    {
        $this->entityManager = $entityManager;
        $this->user = $user;
    }

    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        // Gérer l'authentification (exemple)


        $email = $data['email'];
        $password = $data['password'];
        // verify that the email is not already used
        $emailExists = $this->user->findOneByEmail($email);
        if ($emailExists) {
            return new JsonResponse(['message' => 'Email déjà utilisé'], 400);
        } else {
            $user = new User();
            $user->setEmail($email);
            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $password
            );
            $user->setPassword($hashedPassword);

            // Persist the user to the database
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $response = [
                'message' => 'Inscription réussie!',
            ];
        }




      
        return $this->json($response);
    }
}
