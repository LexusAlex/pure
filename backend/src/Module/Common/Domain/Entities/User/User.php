<?php

declare(strict_types=1);

namespace Pure\Module\Common\Domain\Entities\User;

final class User
{
    private Id $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public function getId(): Id
    {
        return $this->id;
    }
}