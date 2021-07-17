<?php

declare(strict_types=1);

namespace Pure;

use DI\Container;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Exception;
use Pure\Gateway\Http\Slim\Controllers\HomeController\IndexAction;
use Slim\App;
use Slim\Factory\AppFactory;

function loadDotEnv()
{
    $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
    $dotenv->load();
}
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
    $app->addBodyParsingMiddleware();
}

function routes(App $app): void
{
    $app->get('/', IndexAction::class);
}

/**
 * @throws Exception
 */
function application(): void
{
    loadDotEnv();
    $app = AppFactory::createFromContainer(\Pure\container());
    middleware($app);
    routes($app);
    $app->run();
}