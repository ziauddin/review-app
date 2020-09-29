<?php

declare(strict_types=1);

namespace App\Controller\Review_items;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $review_items = $this->getReview_itemsService()->create($input);

        return JsonResponse::withJson($response, json_encode($review_items), 201);
    }
}
