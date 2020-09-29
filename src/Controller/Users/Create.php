<?php

declare(strict_types=1);

namespace App\Controller\Users;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $users = $this->getUsersService()->create($input);

        return JsonResponse::withJson($response, json_encode($users), 201);
    }
}