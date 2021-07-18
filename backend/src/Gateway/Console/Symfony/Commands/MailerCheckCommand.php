<?php

declare(strict_types=1);

namespace Pure\Gateway\Console\Symfony\Commands;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MailerCheckCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('mailer:check');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<comment>Sending</comment>');

        $transport = (new \Swift_SmtpTransport('mailer', 1025))
            ->setUsername('pure')
            ->setPassword('superpasswd')
            ->setEncryption('tcp');

        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message('Join Hello'))
            ->setFrom('info@pure.test')
            ->setTo('admin@pure.test')
            ->setBody('Test Message from pure application');

        if ($mailer->send($message) === 0) {
            throw new \RuntimeException('Unable to send mail');
        }

        $output->writeln('<info>Done!</info>');

        return 0;
    }
}