<?php

declare(strict_types=1);

namespace Pure;

use DI\Container;
use DI\ContainerBuilder;
use Exception;
use Pure\Gateway\Http\Slim\Controllers\HomeController\IndexAction;
use Pure\Gateway\Http\Slim\Controllers\V1\Authentication\JoinByEmailController\RequestAction;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

/**
 * @throws Exception
 */
function container(): Container
{
    $builder = new ContainerBuilder();

    $builder->addDefinitions(dependencies());

    return $builder->build();
}

function middleware(App $app): void
{
    $app->addErrorMiddleware(true, true, true);
    $app->addBodyParsingMiddleware();
}

function routes(App $app): void
{
    $app->get('/', IndexAction::class);
    $app->group('/v1', function (RouteCollectorProxy $group): void {
        $group->group('/authentication', function (RouteCollectorProxy $group): void {
            $group->get('/join-by-email', RequestAction::class);
        });
    });
}

/**
 * @throws Exception
 */
function application(): void
{
    $app = AppFactory::createFromContainer(\Pure\container());
    middleware($app);
    routes($app);
    $app->run();
}