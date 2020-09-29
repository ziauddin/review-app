<?php

declare(strict_types=1);

namespace App\Controller\Review_app_user;

use App\Service\Review_app_userService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected $container;

    protected $review_app_userService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getReview_app_userService(): Review_app_userService
    {
        return $this->container->get('review_app_user_service');
    }
}
