<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');

$app->get('/users', App\Controller\Users\GetAll::class);
$app->post('/users', App\Controller\Users\Create::class);
$app->get('/users/{id}', App\Controller\Users\GetOne::class);
$app->put('/users/{id}', App\Controller\Users\Update::class);
$app->delete('/users/{id}', App\Controller\Users\Delete::class);

$app->get('/review_app_user', App\Controller\Review_app_user\GetAll::class);
$app->post('/review_app_user', App\Controller\Review_app_user\Create::class);
$app->get('/review_app_user/{id}', App\Controller\Review_app_user\GetOne::class);
$app->put('/review_app_user/{id}', App\Controller\Review_app_user\Update::class);
$app->delete('/review_app_user/{id}', App\Controller\Review_app_user\Delete::class);

$app->get('/review_items', App\Controller\Review_items\GetAll::class);
$app->post('/review_items', App\Controller\Review_items\Create::class);
$app->get('/review_items/{id}', App\Controller\Review_items\GetOne::class);
$app->put('/review_items/{id}', App\Controller\Review_items\Update::class);
$app->delete('/review_items/{id}', App\Controller\Review_items\Delete::class);

$app->get('/reviews', App\Controller\Reviews\GetAll::class);
$app->post('/reviews', App\Controller\Reviews\Create::class);
$app->get('/reviews/{id}', App\Controller\Reviews\GetOne::class);
$app->put('/reviews/{id}', App\Controller\Reviews\Update::class);
$app->delete('/reviews/{id}', App\Controller\Reviews\Delete::class);
