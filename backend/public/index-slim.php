<?php

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseFactoryInterface;
use Pure\Gateway\Http\Slim\Controllers\HomeController\IndexAction;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();

$builder->addDefinitions([
    'configuration' => [
        'env' => 'dev'
    ],
    ResponseFactoryInterface::class => static function (): ResponseFactoryInterface {
        return new ResponseFactory();
    },
]);
$container = $builder->build();

$app = AppFactory::createFromContainer($container);

$app->addErrorMiddleware(true, true, true);

$app->get('/', IndexAction::class);

$app->run();