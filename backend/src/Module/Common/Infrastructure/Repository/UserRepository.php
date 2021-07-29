<?php

declare(strict_types=1);

namespace Pure\Module\Common\Infrastructure\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use DomainException;
use Pure\Module\Common\Domain\Entities\User\Types\Id;
use Pure\Module\Common\Domain\Entities\User\User;

final class UserRepository
{
    private EntityRepository $entityRepository;
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager, EntityRepository $entityRepository)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityRepository;
    }
    public function get(Id $id): object
    {
        $user = $this->entityRepository->find($id->getValue());
        if ($user === null) {
            throw new DomainException('User is not found.');
        }
        return $user;
    }

    /**
     * @throws ORMException
     */
    public function add(User $user) : void
    {
        $this->entityManager->persist($user);
    }

    /**
     * @throws ORMException
     */
    public function remove(User $user)
    {
        $this->entityManager->remove($user);
    }
}