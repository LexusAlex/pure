#!/usr/bin/env php
<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use function Pure\container;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = container();

$cli = new Application('Symfony console');

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get('em_mysql');
$cli->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');

$commands = $container->get('config')['console']['commands'];

foreach ($commands as $name) {
    /** @var Command $command */
    $command = $container->get($name);
    $cli->add($command);
}

Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);

$cli->run();