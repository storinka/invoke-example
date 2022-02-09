<?php

namespace App\Repositories\Users;

use App\Extensions\HasPagination;
use App\Models\User;
use Cycle\ORM\EntityManager;
use Cycle\ORM\ORM;
use Cycle\ORM\Select;
use Cycle\ORM\Select\Repository;

class UsersRepository extends Repository
{
    protected ORM $orm;

    public function __construct(ORM $orm)
    {
        parent::__construct(
            new Select($orm, User::class)
        );

        $this->orm = $orm;
    }

    public function findAllWithPagination(HasPagination $pagination): array
    {
        return $this->select()
            ->offset($pagination->getPerPage() * ($pagination->getPage() - 1))
            ->limit($pagination->getPerPage())
            ->fetchAll();
    }

    public function create(string $name): User
    {
        $user = new User($name);

        $entityManager = new EntityManager($this->orm);
        $entityManager->persist($user);
        $entityManager->run();

        return $user;
    }

    public function delete(User $user): void
    {
        $entityManager = new EntityManager($this->orm);
        $entityManager->delete($user);
        $entityManager->run();
    }

    public function updateName(User $user, string $name): User
    {
        $user->name = $name;

        $entityManager = new EntityManager($this->orm);
        $entityManager->persist($user);
        $entityManager->run();

        return $user;
    }
}