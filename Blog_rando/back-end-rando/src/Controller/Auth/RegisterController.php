<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\MailerService;

class RegisterController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;
    private MailerService $mailerService;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        MailerService $mailerService
    ) {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->mailerService = $mailerService;
    }

    #[Route('/auth/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $validator = Validation::createValidator();

        $emailConstraints = [
            new Assert\NotBlank(),
            new Assert\Email(),
            new Assert\Length(['max' => 180]),
        ];

        $passwordConstraints = [
            new Assert\NotBlank(),
            new Assert\Length(['min' => 8]),
            new Assert\Regex(['pattern' => '/[A-Z]/', 'message' => 'The password must contain at least one uppercase letter.']),
            new Assert\Regex(['pattern' => '/[a-z]/', 'message' => 'The password must contain at least one lowercase letter.']),
            new Assert\Regex(['pattern' => '/\d/', 'message' => 'The password must contain at least one digit.']),
            new Assert\Regex(['pattern' => '/[\W]/', 'message' => 'The password must contain at least one special character.']),
        ];

        $emailViolations = $validator->validate($email, $emailConstraints);
        $passwordViolations = $validator->validate($password, $passwordConstraints);

        if (count($emailViolations) > 0 || count($passwordViolations) > 0) {
            $errors = [];
            foreach ($emailViolations as $violation) {
                $errors['email'][] = $violation->getMessage();
            }
            foreach ($passwordViolations as $violation) {
                $errors['password'][] = $violation->getMessage();
            }
            return new JsonResponse(['errors' => $errors], JsonResponse::HTTP_BAD_REQUEST);
        }

        if ($this->userRepository->findOneByEmail($email)) {
            return new JsonResponse(['message' => 'Email already used'], JsonResponse::HTTP_CONFLICT);
        }

        $user = new User();
        $user->setEmail($email);
        $user->setRoles(['ROLE_USER']);
        $hashedPassword = $passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);

        // Optionally handle email verification
        $verificationToken = bin2hex(random_bytes(32));
        $user->setVerificationToken($verificationToken);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Send verification email


        try {
            $this->mailerService->send(
                'krebsjerem@gmail.com',
                $email,
                'Please Verify Your Email Address',
                $verificationToken,
                $user->getEmail()
            );
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Error sending email: ' . $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Registration successful! A verification email has been sent.'], JsonResponse::HTTP_CREATED);
    }
}
