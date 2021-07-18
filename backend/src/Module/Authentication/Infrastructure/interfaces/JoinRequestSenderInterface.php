<?php

declare(strict_types=1);

namespace Pure\Module\Authentication\Infrastructure\interfaces;

interface JoinRequestSenderInterface
{
    public function send($email, $helloMessage): void;
}