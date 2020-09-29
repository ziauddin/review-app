<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\Review_app_userException;

final class Review_app_userRepository
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

    public function checkAndGet(int $review_app_userId)
    {
        $query = 'SELECT * FROM `review_app_user` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_app_userId);
        $statement->execute();
        $review_app_user = $statement->fetchObject();
        if (empty($review_app_user)) {
            throw new Review_app_userException('Review_app_user not found.', 404);
        }

        return $review_app_user;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `review_app_user` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create(object $review_app_user)
    {
        $query = 'INSERT INTO `review_app_user` (`id`, `deviceId`, `os`, `fcm_token`, `deleted_at`, `created_at`, `updated_at`) VALUES (:id, :deviceId, :os, :fcm_token, :deleted_at, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_app_user->id);
	$statement->bindParam('deviceId', $review_app_user->deviceId);
	$statement->bindParam('os', $review_app_user->os);
	$statement->bindParam('fcm_token', $review_app_user->fcm_token);
	$statement->bindParam('deleted_at', $review_app_user->deleted_at);
	$statement->bindParam('created_at', $review_app_user->created_at);
	$statement->bindParam('updated_at', $review_app_user->updated_at);
        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $review_app_user, object $data)
    {
        if (isset($data->deviceId)) { $review_app_user->deviceId = $data->deviceId; }
        if (isset($data->os)) { $review_app_user->os = $data->os; }
        if (isset($data->fcm_token)) { $review_app_user->fcm_token = $data->fcm_token; }
        if (isset($data->deleted_at)) { $review_app_user->deleted_at = $data->deleted_at; }
        if (isset($data->created_at)) { $review_app_user->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $review_app_user->updated_at = $data->updated_at; }

        $query = 'UPDATE `review_app_user` SET `deviceId` = :deviceId, `os` = :os, `fcm_token` = :fcm_token, `deleted_at` = :deleted_at, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_app_user->id);
	$statement->bindParam('deviceId', $review_app_user->deviceId);
	$statement->bindParam('os', $review_app_user->os);
	$statement->bindParam('fcm_token', $review_app_user->fcm_token);
	$statement->bindParam('deleted_at', $review_app_user->deleted_at);
	$statement->bindParam('created_at', $review_app_user->created_at);
	$statement->bindParam('updated_at', $review_app_user->updated_at);
        $statement->execute();

        return $this->checkAndGet((int) $review_app_user->id);
    }

    public function delete(int $review_app_userId): void
    {
        $query = 'DELETE FROM `review_app_user` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $review_app_userId);
        $statement->execute();
    }
}
