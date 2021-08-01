<?php

declare(strict_types=1);

namespace Pure\Module\Common\Infrastructure\Fixture\User;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Pure\Module\Common\Domain\Entities\User\Types\Id;
use Pure\Module\Common\Domain\Entities\User\User;
use Ramsey\Uuid\Uuid;

final class UserFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User(
            new Id('00000000-0000-0000-0000-000000000001')
        );

        $manager->persist($user);

        $user2 = new User(
            Id::generate()
        );

        $manager->persist($user2);

        $manager->flush();
    }
}