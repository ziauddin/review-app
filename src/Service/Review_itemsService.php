<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Review_itemsException;
use App\Repository\Review_itemsRepository;

final class Review_itemsService
{
    protected $review_itemsRepository;

    public function __construct(Review_itemsRepository $review_itemsRepository)
    {
        $this->review_itemsRepository = $review_itemsRepository;
    }

    protected function checkAndGet(int $review_itemsId)
    {
        return $this->review_itemsRepository->checkAndGet($review_itemsId);
    }

    public function getAll(): array
    {
        return $this->review_itemsRepository->getAll();
    }

    public function getAllWithReview(): array
    {
        return $this->review_itemsRepository->getAllWithReview();
    }

    public function getOne(int $review_itemsId)
    {
        return $this->checkAndGet($review_itemsId);
    }

    public function getOneWithReview(int $review_itemsId)  {
        return $this->checkAndGetWithReview($review_itemsId);
    }

    public function create(array $input)
    {
        $review_items = json_decode(json_encode($input), false);

        return $this->review_itemsRepository->create($review_items);
    }

    public function update(array $input, int $review_itemsId)
    {
        $review_items = $this->checkAndGet($review_itemsId);
        $data = json_decode(json_encode($input), false);

        return $this->review_itemsRepository->update($review_items, $data);
    }

    public function delete(int $review_itemsId): void
    {
        $this->checkAndGet($review_itemsId);
        $this->review_itemsRepository->delete($review_itemsId);
    }
}
