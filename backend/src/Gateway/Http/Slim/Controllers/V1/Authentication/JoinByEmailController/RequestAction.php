<?php

declare(strict_types=1);

namespace Pure\Gateway\Http\Slim\Controllers\V1\Authentication\JoinByEmailController;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Pure\Gateway\Http\Slim\Response\JsonResponse;
use Pure\Module\Authentication\Infrastructure\Sender\JoinRequestSender;
use Pure\Module\Common\Infrastructure\Service\UserService;

final class RequestAction implements RequestHandlerInterface
{
    private UserService $userService;
    private JoinRequestSender $joinRequestSender;

    public function __construct(UserService $userService, JoinRequestSender $joinRequestSender)
    {
        $this->userService = $userService;
        $this->joinRequestSender = $joinRequestSender;
    }
    /**
     * @throws \JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        $this->userService->joinByEmail($data);

        //$this->joinRequestSender->send('test@qwery.test', '123456789');

        return new JsonResponse('');
    }
}