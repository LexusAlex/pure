<?php

declare(strict_types=1);

namespace Test\Other\Builder;

use JetBrains\PhpStorm\Pure;
use Pure\Module\Common\Domain\Entities\User\Id;
use Pure\Module\Common\Domain\Entities\User\User;

final class UserBuilder
{
    private Id $id;

    public function __construct()
    {
        $this->id = Id::generate();
    }

    public function withId(Id $id): self
    {
        $clone = clone $this;
        $clone->id = $id;
        return $clone;
    }

    #[Pure] public function build() : User
    {
        return new User($this->id);
    }
}