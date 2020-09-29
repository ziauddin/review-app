<?php

declare(strict_types=1);

$container['users_service'] = static function ($container): App\Service\UsersService {
    return new App\Service\UsersService($container['users_repository']);
};

$container['review_app_user_service'] = static function ($container): App\Service\Review_app_userService {
    return new App\Service\Review_app_userService($container['review_app_user_repository']);
};

$container['review_items_service'] = static function ($container): App\Service\Review_itemsService {
    return new App\Service\Review_itemsService($container['review_items_repository']);
};

$container['reviews_service'] = static function ($container): App\Service\ReviewsService {
    return new App\Service\ReviewsService($container['reviews_repository']);
};
