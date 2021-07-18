<?php

declare(strict_types=1);

namespace Pure\Gateway\Http\Slim\Controllers\V1\Authentication\JoinByEmailController;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Pure\Gateway\Http\Slim\Response\JsonResponse;
use Pure\Module\Common\Infrastructure\Service\UserService;

final class RequestAction implements RequestHandlerInterface
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * @throws \JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        $this->userService->joinByEmail($data);

        return new JsonResponse('');
    }
}