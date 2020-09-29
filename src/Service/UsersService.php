<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\UsersException;
use App\Repository\UsersRepository;

final class UsersService
{
    protected $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    protected function checkAndGet(int $usersId)
    {
        return $this->usersRepository->checkAndGet($usersId);
    }

    public function getAll(): array
    {
        return $this->usersRepository->getAll();
    }

    public function getOne(int $usersId)
    {
        return $this->checkAndGet($usersId);
    }

    public function create(array $input)
    {
        $users = json_decode(json_encode($input), false);

        return $this->usersRepository->create($users);
    }

    public function update(array $input, int $usersId)
    {
        $users = $this->checkAndGet($usersId);
        $data = json_decode(json_encode($input), false);

        return $this->usersRepository->update($users, $data);
    }

    public function delete(int $usersId): void
    {
        $this->checkAndGet($usersId);
        $this->usersRepository->delete($usersId);
    }
}
