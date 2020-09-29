<?php

declare(strict_types=1);

namespace App\Controller\Review_items;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Delete extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->getReview_itemsService()->delete((int) $args['id']);

        return JsonResponse::withJson($response, '', 204);
    }
}
