<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\Review_itemsException;

final class Review_itemsRepository
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

    public function checkAndGet(int $review_itemsId)
    {
        $query = 'SELECT * FROM `review_items` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_itemsId);
        $statement->execute();
        $review_items = $statement->fetchObject();
        if (empty($review_items)) {
            throw new Review_itemsException('Review_items not found.', 404);
        }

        return $review_items;
    }

    public function checkAndGetWithReview(int $review_itemsId)
    {
        $query = 'SELECT * FROM `review_items` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_itemsId);
        $statement->execute();
        $review_items = $statement->fetchObject();
        if(!empty($review_items)) {
            $review_items->reviews = self::getAllReviews((int)$review_itemsId);
            $review_items->no_of_reviews = count($review_items->reviews);
            $review_items->avg_rating = self::getAvgReviewRating((int)$review_itemsId);
        }
        if (empty($review_items)) {
            throw new Review_itemsException('Review_items not found.', 404);
        }

        return $review_items;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `review_items` ORDER BY `id` desc';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAllWithReview(): array
    {
        $review_items = self::getAll();
        //print_r($review_items);
        //die();
        $update_review_items = [];
        foreach($review_items as $item)  {
            
            $item['reviews'] = self::getAllReviews($item['id']);
            $item['no_of_reviews'] = count($item['reviews']);
            $item['avg_rating'] = self::getAvgReviewRating($item['id']);
            $update_review_items [] = $item;
        }

        return $update_review_items;
    }

    public function create(object $review_items)
    {
        $query = 'INSERT INTO `review_items` (`id`, `review_app_user_id`, `images`, `title`, `subtitle`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES (:id, :review_app_user_id, :images, :title, :subtitle, :description, :deleted_at, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_items->id);
	$statement->bindParam('review_app_user_id', $review_items->review_app_user_id);
	$statement->bindParam('images', $review_items->images);
	$statement->bindParam('title', $review_items->title);
	$statement->bindParam('subtitle', $review_items->subtitle);
	$statement->bindParam('description', $review_items->description);
	$statement->bindParam('deleted_at', $review_items->deleted_at);
	$statement->bindParam('created_at', $review_items->created_at);
	$statement->bindParam('updated_at', $review_items->updated_at);
        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $review_items, object $data)
    {
        if (isset($data->review_app_user_id)) { $review_items->review_app_user_id = $data->review_app_user_id; }
        if (isset($data->images)) { $review_items->images = $data->images; }
        if (isset($data->title)) { $review_items->title = $data->title; }
        if (isset($data->subtitle)) { $review_items->subtitle = $data->subtitle; }
        if (isset($data->description)) { $review_items->description = $data->description; }
        if (isset($data->deleted_at)) { $review_items->deleted_at = $data->deleted_at; }
        if (isset($data->created_at)) { $review_items->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $review_items->updated_at = $data->updated_at; }

        $query = 'UPDATE `review_items` SET `review_app_user_id` = :review_app_user_id, `images` = :images, `title` = :title, `subtitle` = :subtitle, `description` = :description, `deleted_at` = :deleted_at, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_items->id);
	$statement->bindParam('review_app_user_id', $review_items->review_app_user_id);
	$statement->bindParam('images', $review_items->images);
	$statement->bindParam('title', $review_items->title);
	$statement->bindParam('subtitle', $review_items->subtitle);
	$statement->bindParam('description', $review_items->description);
	$statement->bindParam('deleted_at', $review_items->deleted_at);
	$statement->bindParam('created_at', $review_items->created_at);
	$statement->bindParam('updated_at', $review_items->updated_at);
        $statement->execute();

        return $this->checkAndGet((int) $review_items->id);
    }

    public function delete(int $review_itemsId): void
    {
        $query = 'DELETE FROM `review_items` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_itemsId);
        $statement->execute();
    }

    public function getAllReviews(int $review_itemId)  {
        $query = 'SELECT `review_comment`,`review_rate`,`created_at` FROM `reviews` where `review_items_id` = :review_items_id  ORDER BY `id` desc';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('review_items_id', $review_itemId);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAvgReviewRating(int $review_itemId)  {
        $query = 'SELECT AVG(review_rate) as rating FROM `reviews` where `review_items_id` = :review_items_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('review_items_id', $review_itemId);
        $statement->execute();
        $review_rating = $statement->fetchObject();
        if ($review_rating->rating > 0) {
            return number_format((float)$review_rating->rating,2,'.', '');
        }
        else {
            return '0';
        }
    }

}
