<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\ReviewsException;

final class ReviewsRepository
{
    protected $database;

    protected function getDb(): \PDO
    {
        return $this->database;
    }

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGet(int $reviewsId)
    {
        $query = 'SELECT * FROM `reviews` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $reviewsId);
        $statement->execute();
        $reviews = $statement->fetchObject();
        if (empty($reviews)) {
            throw new ReviewsException('Reviews not found.', 404);
        }

        return $reviews;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `reviews` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create(object $reviews)
    {
        $query = 'INSERT INTO `reviews` (`id`, `review_comment`, `review_rate`, `review_app_user_id`, `review_items_id`, `deleted_at`, `created_at`, `updated_at`) VALUES (:id, :review_comment, :review_rate, :review_app_user_id, :review_items_id, :deleted_at, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $reviews->id);
	$statement->bindParam('review_comment', $reviews->review_comment);
	$statement->bindParam('review_rate', $reviews->review_rate);
	$statement->bindParam('review_app_user_id', $reviews->review_app_user_id);
	$statement->bindParam('review_items_id', $reviews->review_items_id);
	$statement->bindParam('deleted_at', $reviews->deleted_at);
	$statement->bindParam('created_at', $reviews->created_at);
	$statement->bindParam('updated_at', $reviews->updated_at);
        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $reviews, object $data)
    {
        if (isset($data->review_comment)) { $reviews->review_comment = $data->review_comment; }
        if (isset($data->review_rate)) { $reviews->review_rate = $data->review_rate; }
        if (isset($data->review_app_user_id)) { $reviews->review_app_user_id = $data->review_app_user_id; }
        if (isset($data->review_items_id)) { $reviews->review_items_id = $data->review_items_id; }
        if (isset($data->deleted_at)) { $reviews->deleted_at = $data->deleted_at; }
        if (isset($data->created_at)) { $reviews->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $reviews->updated_at = $data->updated_at; }

        $query = 'UPDATE `reviews` SET `review_comment` = :review_comment, `review_rate` = :review_rate, `review_app_user_id` = :review_app_user_id, `review_items_id` = :review_items_id, `deleted_at` = :deleted_at, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $reviews->id);
	$statement->bindParam('review_comment', $reviews->review_comment);
	$statement->bindParam('review_rate', $reviews->review_rate);
	$statement->bindParam('review_app_user_id', $reviews->review_app_user_id);
	$statement->bindParam('review_items_id', $reviews->review_items_id);
	$statement->bindParam('deleted_at', $reviews->deleted_at);
	$statement->bindParam('created_at', $reviews->created_at);
	$statement->bindParam('updated_at', $reviews->updated_at);
        $statement->execute();

        return $this->checkAndGet((int) $reviews->id);
    }

    public function delete(int $reviewsId): void
    {
        $query = 'DELETE FROM `reviews` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $reviewsId);
        $statement->execute();
    }
}
