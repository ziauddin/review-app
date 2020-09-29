<?php

declare(strict_types=1);

$container['users_repository'] = static function ($container): App\Repository\UsersRepository {
    return new App\Repository\UsersRepository($container['db']);
};

$container['review_app_user_repository'] = static function ($container): App\Repository\Review_app_userRepository {
    return new App\Repository\Review_app_userRepository($container['db']);
};

$container['review_items_repository'] = static function ($container): App\Repository\Review_itemsRepository {
    return new App\Repository\Review_itemsRepository($container['db']);
};

$container['reviews_repository'] = static function ($container): App\Repository\ReviewsRepository {
    return new App\Repository\ReviewsRepository($container['db']);
};
