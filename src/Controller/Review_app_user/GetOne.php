<?php

declare(strict_types=1);

namespace App\Controller\Review_app_user;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetOne extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $review_app_user = $this->getReview_app_userService()->getOne((int) $args['id']);

        return JsonResponse::withJson($response, json_encode($review_app_user));
    }
}
