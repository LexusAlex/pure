<?php

declare(strict_types=1);

namespace Pure;

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use RuntimeException;

function dependencies(): array
{
    $aggregator = new ConfigAggregator([
        new PhpFileProvider(__DIR__ . '/slim/environments/common/*.php'),
        new PhpFileProvider(__DIR__ . '/symfony/environments/common/*.php'),
        new PhpFileProvider(__DIR__ . '/swift_mailer/environments/common/*.php'),
        new PhpFileProvider(__DIR__ . '/twig/environments/common/*.php'),
        new PhpFileProvider(__DIR__ . '/slim/environments/' . env('PURE_ENV', 'prod') . '/*.php'),
    ]);

    return $aggregator->getMergedConfig();
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





