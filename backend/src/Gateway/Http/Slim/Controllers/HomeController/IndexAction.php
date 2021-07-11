<?php

declare(strict_types=1);

namespace Pure\Gateway\Http\Slim\Controllers\HomeController;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Pure\Gateway\Http\Slim\Response\JsonResponse;
use stdClass;

class IndexAction implements RequestHandlerInterface
{
    /**
     * @throws JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse(new stdClass());
    }
}
