<?php

declare(strict_types=1);

namespace Pure\Module\Common\Infrastructure\Service;

use Pure\Module\Authentication\Application\Command\JoinByEmail\Request\Command;
use Pure\Module\Authentication\Application\Command\JoinByEmail\Request\Handler;

final class UserService
{
    private Handler $joinByEmailHandler;

    public function __construct(Handler $joinByEmailHandler)
    {
        $this->joinByEmailHandler= $joinByEmailHandler;
    }
    public function joinByEmail($data)
    {
        $command = new Command();
        $command->email = $data['email'] ?? '';
        $command->password = $data['password'] ?? '';

        $this->joinByEmailHandler->handle($command);
    }
}