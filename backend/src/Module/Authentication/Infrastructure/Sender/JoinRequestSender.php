<?php

declare(strict_types=1);

namespace Pure\Module\Authentication\Infrastructure\Sender;

use Pure\Module\Authentication\Infrastructure\interfaces\JoinRequestSenderInterface;
use RuntimeException;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class JoinRequestSender implements JoinRequestSenderInterface
{
    private Swift_Mailer $mailer;
    private Environment $twig;

    public function __construct(Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function send($email, $helloMessage): void
    {
        $message = (new Swift_Message('Join Request'))
            ->setTo($email)
            ->setBody($this->twig->render('authentication/join/request.html.twig', ['helloMessage' => $helloMessage]), 'text/html');

        if ($this->mailer->send($message) === 0) {
            throw new RuntimeException('Unable to send email.');
        }
    }
}
