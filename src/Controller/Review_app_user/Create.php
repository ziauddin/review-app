<?php

declare(strict_types=1);

namespace App\Controller\Review_app_user;

use App\Helper\JsonResponse;
use App\Helper\InputUpdate;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $input = InputUpdate::addMissingDefault($input);
        $review_app_user = $this->getReview_app_userService()->create($input);

        return JsonResponse::withJson($response, json_encode($review_app_user), 201);
    }
}
