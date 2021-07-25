#!/usr/bin/env php
<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use function Pure\container;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = container();

$cli = new Application('Symfony console');

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get('em_pgsql');
$cli->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');

Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);

$cli->run();