<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Review_app_userException;
use App\Repository\Review_app_userRepository;

final class Review_app_userService
{
    protected $review_app_userRepository;

    public function __construct(Review_app_userRepository $review_app_userRepository)
    {
        $this->review_app_userRepository = $review_app_userRepository;
    }

    protected function checkAndGet(int $review_app_userId)
    {
        return $this->review_app_userRepository->checkAndGet($review_app_userId);
    }

    public function getAll(): array
    {
        return $this->review_app_userRepository->getAll();
    }

    public function getOne(int $review_app_userId)
    {
        return $this->checkAndGet($review_app_userId);
    }

    public function create(array $input)
    {
        $review_app_user = json_decode(json_encode($input), false);

        return $this->review_app_userRepository->create($review_app_user);
    }

    public function update(array $input, int $review_app_userId)
    {
        $review_app_user = $this->checkAndGet($review_app_userId);
        $data = json_decode(json_encode($input), false);

        return $this->review_app_userRepository->update($review_app_user, $data);
    }

    public function delete(int $review_app_userId): void
    {
        $this->checkAndGet($review_app_userId);
        $this->review_app_userRepository->delete($review_app_userId);
    }
}
