<?php

declare(strict_types=1);

namespace App\Controller\Review_app_user;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $review_app_users = $this->getReview_app_userService()->getAll();

        return JsonResponse::withJson($response, json_encode($review_app_users));
    }
}
