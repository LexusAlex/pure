<?php

declare(strict_types=1);

namespace Pure\Module\Authentication\Application\Command\JoinByEmail\Request;

use Pure\Module\Common\Domain\Entities\User\Types\Id;
use Pure\Module\Common\Domain\Entities\User\User;
use Pure\Module\Common\Infrastructure\Repository\UserRepository;

final class Handler
{
    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function handle(Command $command): void
    {
        $user = new User(
            $id = Id::generate()
        );

        $this->users->add($user);
    }
}