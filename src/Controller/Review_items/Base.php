<?php

declare(strict_types=1);

namespace App\Controller\Review_items;

use App\Service\Review_itemsService;
use App\Service\ReviewsService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected $container;

    protected $review_itemsService;

    protected $reviewsService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getReview_itemsService(): Review_itemsService
    {
        return $this->container->get('review_items_service');
    }
    protected function getReviewsService(): ReviewsService
    {
        return $this->container->get('reviews_service');
    }
}
