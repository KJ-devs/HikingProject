<?php

namespace App\Controller;

use App\Entity\Messages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class PublishController extends AbstractController
{
    #[Route('/chat/send', name: 'chat_send', methods: ['POST'])]
    public function sendMessage(Request $request, EntityManagerInterface $entityManager, HubInterface $hub): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate input
        if (!isset($data['content']) || empty($data['content'])) {
            return new JsonResponse(['error' => 'Message content cannot be empty'], 400);
        }
        $content = $data['content'];
        // Create a new message entity
        $message = new Messages();
        $message->setContent($content);
        $message->setAuthor($this->getUser()); // Ensure the user is logged in
        // Persist the message
        $entityManager->persist($message);
        $entityManager->flush();
        // Publish the update to the Mercure Hub
        $update = new Update(
            'http://localhost:3000/chat', // The topic your frontend is subscribed to
            json_encode(['content' => $content, 'author' => $this->getUser()])
        );

        $hub->publish($update);

        return new JsonResponse(['status' => 'Message sent']);
    }
}
