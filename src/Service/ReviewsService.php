<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\ReviewsException;
use App\Repository\ReviewsRepository;

final class ReviewsService
{
    protected $reviewsRepository;

    public function __construct(ReviewsRepository $reviewsRepository)
    {
        $this->reviewsRepository = $reviewsRepository;
    }

    protected function checkAndGet(int $reviewsId)
    {
        return $this->reviewsRepository->checkAndGet($reviewsId);
    }

    public function getAll(): array
    {
        return $this->reviewsRepository->getAll();
    }

    public function getOne(int $reviewsId)
    {
        return $this->checkAndGet($reviewsId);
    }

    public function create(array $input)
    {
        $reviews = json_decode(json_encode($input), false);

        return $this->reviewsRepository->create($reviews);
    }

    public function update(array $input, int $reviewsId)
    {
        $reviews = $this->checkAndGet($reviewsId);
        $data = json_decode(json_encode($input), false);

        return $this->reviewsRepository->update($reviews, $data);
    }

    public function delete(int $reviewsId): void
    {
        $this->checkAndGet($reviewsId);
        $this->reviewsRepository->delete($reviewsId);
    }
}
