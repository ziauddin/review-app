<?php

declare(strict_types=1);

namespace App\Controller\Reviews;

use App\Service\ReviewsService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected $container;

    protected $reviewsService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getReviewsService(): ReviewsService
    {
        return $this->container->get('reviews_service');
    }
}
