<?php

declare(strict_types=1);

namespace Pure\Module\Common\Domain\Entities\User;

use Doctrine\ORM\Mapping as ORM;
use Pure\Module\Common\Domain\Entities\User\Types\Id;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="common_user")
 */
final class User
{
    /**
     * @ORM\Column(type="common_user_id")
     * @ORM\Id()
     */
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