<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Delete extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->getUsersService()->delete((int) $args['id']);

        return JsonResponse::withJson($response, '', 204);
    }
}
