<?php

declare(strict_types=1);

namespace App\Controller\Review_app_user;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $review_app_user = $this->getReview_app_userService()->update($input, (int) $args['id']);

        return JsonResponse::withJson($response, json_encode($review_app_user));
    }
}
