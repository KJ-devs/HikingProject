<?php
// src/Controller/AuthController.php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface; // Import the EntityManager
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

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

    #[Route('/auth/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);

        $email = $data['email'];
        $password = $data['password'];

        // Créer le validateur
        $validator = Validation::createValidator();

        // Définir les contraintes de validation pour l'email
        $emailConstraints = [
            new Assert\NotBlank(),
            new Assert\Email(),
            new Assert\Length(['max' => 180]),
        ];

        // Définir les contraintes de validation pour le mot de passe
        $passwordConstraints = [
            new Assert\NotBlank(),
            new Assert\Length([
                'min' => 8
            ]),
            new Assert\Regex([
                'pattern' => '/[A-Z]/',
                'message' => 'Le mot de passe doit contenir au moins une majuscule.'
            ]),
            new Assert\Regex([
                'pattern' => '/[a-z]/',
                'message' => 'Le mot de passe doit contenir au moins une minuscule.'
            ]),
            new Assert\Regex([
                'pattern' => '/\d/',
                'message' => 'Le mot de passe doit contenir au moins un chiffre.'
            ]),
            new Assert\Regex([
                'pattern' => '/[\W]/',
                'message' => 'Le mot de passe doit contenir au moins un caractère spécial.'
            ]),
        ];

        // Valider l'email
        $emailViolations = $validator->validate($email, $emailConstraints);
        // Valider le mot de passe
        $passwordViolations = $validator->validate($password, $passwordConstraints);

        // Si des violations sont trouvées, retourner une réponse d'erreur
        if (count($emailViolations) > 0 || count($passwordViolations) > 0) {
            $errors = [];
            foreach ($emailViolations as $violation) {
                $errors['email'][] = $violation->getMessage();
            }
            foreach ($passwordViolations as $violation) {
                $errors['password'][] = $violation->getMessage();
            }
            return new JsonResponse(['errors' => $errors], 400);
        }


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