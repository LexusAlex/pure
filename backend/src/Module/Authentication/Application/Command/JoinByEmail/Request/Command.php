<?php

declare(strict_types=1);

namespace Pure\Module\Authentication\Application\Command\JoinByEmail\Request;

final class Command
{
    public string $email = '';
    public string $password = '';
}