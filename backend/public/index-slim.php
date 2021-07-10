<?php

use Slim\Factory\AppFactory;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', \Pure\Gateway\Http\Slim\Controllers\HomeController\IndexAction::class);

$app->run();