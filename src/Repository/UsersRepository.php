<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\UsersException;

final class UsersRepository
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

    public function checkAndGet(int $usersId)
    {
        $query = 'SELECT * FROM `users` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usersId);
        $statement->execute();
        $users = $statement->fetchObject();
        if (empty($users)) {
            throw new UsersException('Users not found.', 404);
        }

        return $users;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `users` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create(object $users)
    {
        $query = 'INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES (:id, :name, :email, :email_verified_at, :password, :two_factor_secret, :two_factor_recovery_codes, :remember_token, :current_team_id, :profile_photo_path, :created_at, :updated_at)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $users->id);
	$statement->bindParam('name', $users->name);
	$statement->bindParam('email', $users->email);
	$statement->bindParam('email_verified_at', $users->email_verified_at);
	$statement->bindParam('password', $users->password);
	$statement->bindParam('two_factor_secret', $users->two_factor_secret);
	$statement->bindParam('two_factor_recovery_codes', $users->two_factor_recovery_codes);
	$statement->bindParam('remember_token', $users->remember_token);
	$statement->bindParam('current_team_id', $users->current_team_id);
	$statement->bindParam('profile_photo_path', $users->profile_photo_path);
	$statement->bindParam('created_at', $users->created_at);
	$statement->bindParam('updated_at', $users->updated_at);
        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $users, object $data)
    {
        if (isset($data->name)) { $users->name = $data->name; }
        if (isset($data->email)) { $users->email = $data->email; }
        if (isset($data->email_verified_at)) { $users->email_verified_at = $data->email_verified_at; }
        if (isset($data->password)) { $users->password = $data->password; }
        if (isset($data->two_factor_secret)) { $users->two_factor_secret = $data->two_factor_secret; }
        if (isset($data->two_factor_recovery_codes)) { $users->two_factor_recovery_codes = $data->two_factor_recovery_codes; }
        if (isset($data->remember_token)) { $users->remember_token = $data->remember_token; }
        if (isset($data->current_team_id)) { $users->current_team_id = $data->current_team_id; }
        if (isset($data->profile_photo_path)) { $users->profile_photo_path = $data->profile_photo_path; }
        if (isset($data->created_at)) { $users->created_at = $data->created_at; }
        if (isset($data->updated_at)) { $users->updated_at = $data->updated_at; }

        $query = 'UPDATE `users` SET `name` = :name, `email` = :email, `email_verified_at` = :email_verified_at, `password` = :password, `two_factor_secret` = :two_factor_secret, `two_factor_recovery_codes` = :two_factor_recovery_codes, `remember_token` = :remember_token, `current_team_id` = :current_team_id, `profile_photo_path` = :profile_photo_path, `created_at` = :created_at, `updated_at` = :updated_at WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $users->id);
	$statement->bindParam('name', $users->name);
	$statement->bindParam('email', $users->email);
	$statement->bindParam('email_verified_at', $users->email_verified_at);
	$statement->bindParam('password', $users->password);
	$statement->bindParam('two_factor_secret', $users->two_factor_secret);
	$statement->bindParam('two_factor_recovery_codes', $users->two_factor_recovery_codes);
	$statement->bindParam('remember_token', $users->remember_token);
	$statement->bindParam('current_team_id', $users->current_team_id);
	$statement->bindParam('profile_photo_path', $users->profile_photo_path);
	$statement->bindParam('created_at', $users->created_at);
	$statement->bindParam('updated_at', $users->updated_at);
        $statement->execute();

        return $this->checkAndGet((int) $users->id);
    }

    public function delete(int $usersId): void
    {
        $query = 'DELETE FROM `users` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usersId);
        $statement->execute();
    }
}
