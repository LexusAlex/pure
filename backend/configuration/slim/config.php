<?php

declare(strict_types=1);

namespace Pure;

use DI\Container;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Exception;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use Pure\Gateway\Http\Slim\Controllers\HomeController\IndexAction;
use RuntimeException;
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

function dependencies(): array
{
    $aggregator = new ConfigAggregator([
        new PhpFileProvider(__DIR__ . '/environments/common/*.php'),
        new PhpFileProvider(__DIR__ . '/environments/' . env('PURE_ENV', 'prod') . '/*.php'),
    ]);

    return $aggregator->getMergedConfig();
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

function env(string $name, ?string $default = null): string
{
    $value = getenv($name);

    if ($value !== false) {
        return $value;
    }

    if ($default !== null) {
        return $default;
    }

    throw new RuntimeException('Undefined env ' . $name);
}





