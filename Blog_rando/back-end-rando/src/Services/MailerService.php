<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class MailerService
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig,
        private UrlGeneratorInterface $urlGenerator 
    ) {
    }

    public function send($from, $to, $subject, $verificationToken, $userName)
    {
        // Generate the verification URL
        $verificationUrl = $this->urlGenerator->generate('api_verify_email', ['token' => $verificationToken], UrlGeneratorInterface::ABSOLUTE_URL);

        // Render the email body using Twig
        $htmlBody = $this->twig->render('emails/verification_email.html.twig', [
            'verificationUrl' => $verificationUrl,
            'userName' => $userName
        ]);

        // Create and send the email
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($htmlBody);

        $this->mailer->send($email);
    }
}
