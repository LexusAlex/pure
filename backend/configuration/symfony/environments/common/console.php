<?php

declare(strict_types=1);

use Doctrine\Migrations\Tools\Console\Command\CurrentCommand;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Pure\Gateway\Console\Doctrine\Fixtures\FixturesLoadCommand;
use Pure\Gateway\Console\Symfony\Commands\MailerCheckCommand;
use Pure\Gateway\Console\Symfony\Commands\TestCommand;

return [
    FixturesLoadCommand::class => static function (ContainerInterface $container) {
        /**
         * @psalm-suppress MixedArrayAccess
         * @var array{fixture_paths:string[]} $config
         */
        $config = $container->get('config')['console'];

        return new FixturesLoadCommand(
            $container->get('em_pgsql'),
            $config['fixture_paths'],
        );
    },
    'config' => [
        'console' => [
            'commands' => [
                TestCommand::class,
                MailerCheckCommand::class,

                ExecuteCommand::class,
                CurrentCommand::class,
                DumpSchemaCommand::class,
                GenerateCommand::class,
                RollupCommand::class,
                SyncMetadataCommand::class,
                UpToDateCommand::class,
                VersionCommand::class,
                MigrateCommand::class,
                LatestCommand::class,
                ListCommand::class,
                StatusCommand::class,
                DiffCommand::class,

                FixturesLoadCommand::class,
            ],
            'fixture_paths' => [
                __DIR__ . '/../../../../src/Module/Common/Infrastructure/Fixture',
            ],
        ],
    ],
];