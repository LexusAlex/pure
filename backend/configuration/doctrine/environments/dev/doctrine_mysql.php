<?php

declare(strict_types=1);

use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\Common\EventManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Pure\Module\Common\Domain\Entities\User\Types\IdType;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use function Pure\env;


return [
    'em_mysql' => static function (ContainerInterface $container): EntityManagerInterface {

        $settings = $container->get('config')['doctrine_mysql'];

        $config = Setup::createAnnotationMetadataConfiguration(
            $settings['metadata_dirs'],
            $settings['dev_mode'],
            $settings['proxy_dir'],
            $settings['cache_dir'] ?
                DoctrineProvider::wrap(new FilesystemAdapter('', 0, $settings['cache_dir'])) :
                DoctrineProvider::wrap(new ArrayAdapter()),
            false
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        foreach ($settings['types'] as $name => $class) {
            if (!Type::hasType($name)) {
                Type::addType($name, $class);
            }
        }

        $eventManager = new EventManager();

        foreach ($settings['subscribers'] as $name) {
            /** @var EventSubscriber $subscriber */
            $subscriber = $container->get($name);
            $eventManager->addEventSubscriber($subscriber);
        }

        return EntityManager::create(
            $settings['connection'],
            $config,
            $eventManager
        );
    },
    Connection::class => static function (ContainerInterface $container): Connection {
        $em = $container->get('em_mysql');
        return $em->getConnection();
    },

    'config' => [
        'doctrine_mysql' => [
            'dev_mode' => true,
            'cache_dir' => null,
            'proxy_dir' => __DIR__ . '/../../../../var/cache/' . PHP_SAPI . '/doctrine/mysql/proxy',
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => env('PURE_MYSQL_HOST'),
                'user' => env('PURE_MYSQL_USER'),
                'password' => env('PURE_MYSQL_PASSWORD'),
                'dbname' => env('PURE_MYSQL_DATABASE'),
                'charset' => 'utf8',
            ],
            'subscribers' => [],
            'metadata_dirs' => [
                __DIR__ . '/../../../../src/Module/Common/Domain/Entities',
                //__DIR__ . '/../../src/OAuth/Entity',
            ],
            'types' => [
                IdType::NAME => IdType::class
            ],
        ],
    ],
];