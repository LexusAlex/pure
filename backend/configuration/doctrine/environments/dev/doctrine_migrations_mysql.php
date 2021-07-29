<?php

return [];
//declare(strict_types=1);
/*
use Doctrine\Migrations;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command;
use Psr\Container\ContainerInterface;

return [
    DependencyFactory::class => static function (ContainerInterface $container) {
        $entityManager = $container->get('em_mysql');

        $configuration = new Doctrine\Migrations\Configuration\Configuration();
        $configuration->addMigrationsDirectory('Pure\Module\Common\Data\Migration\Mysql', __DIR__ . '/../../../../src/Module/Common/Data/Migration/Mysql');
        $configuration->setAllOrNothing(true);
        $configuration->setCheckDatabasePlatform(false);

        $storageConfiguration = new Migrations\Metadata\Storage\TableMetadataStorageConfiguration();
        $storageConfiguration->setTableName('migrations');

        $configuration->setMetadataStorageConfiguration($storageConfiguration);

        return DependencyFactory::fromEntityManager(
            new Migrations\Configuration\Migration\ExistingConfiguration($configuration),
            new Migrations\Configuration\EntityManager\ExistingEntityManager($entityManager)
        );
    },
    Command\ExecuteCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);
        return new Command\ExecuteCommand($factory);
    },
    Command\MigrateCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);
        return new Command\MigrateCommand($factory);
    },
    Command\LatestCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);
        return new Command\LatestCommand($factory);
    },
    Command\ListCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);
        return new Command\ListCommand($factory);
    },
    Command\StatusCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);
        return new Command\StatusCommand($factory);
    },
    Command\UpToDateCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);
        return new Command\UpToDateCommand($factory);
    },
    Command\DiffCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);
        return new Command\DiffCommand($factory);
    },
    Command\GenerateCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);
        return new Command\GenerateCommand($factory);
    },
];*/