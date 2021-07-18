<?php

declare(strict_types=1);

namespace Pure\Module\Authentication\Test\Unit\Command\JoinByEmail;

use PHPUnit\Framework\TestCase;
use Pure\Module\Common\Domain\Entities\User\Id;
use Pure\Module\Common\Domain\Entities\User\User;

class RequestTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = new User(
            $id = Id::generate()
        );

        self::assertEquals($id, $user->getId());
    }
}