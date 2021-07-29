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
    'em_pgsql' => static function (ContainerInterface $container): EntityManagerInterface {

        $settings = $container->get('config')['doctrine_pgsql'];

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
        $em = $container->get('em_pgsql');
        return $em->getConnection();
    },

    'config' => [
        'doctrine_pgsql' => [
            'dev_mode' => false,
            'cache_dir' => __DIR__ . '/../../../../var/cache/doctrine/pgsql/cache',
            'proxy_dir' => __DIR__ . '/../../../../var/cache/doctrine/pgsql/proxy',
            'connection' => [
                'driver' => 'pdo_pgsql',
                'host' => env('PURE_POSTGRES_HOST'),
                'user' => env('PURE_POSTGRES_USER'),
                'password' => env('PURE_POSTGRES_PASSWORD'),
                'dbname' => env('PURE_POSTGRES_DB'),
                'charset' => 'utf-8',
            ],
            'subscribers' => [],
            'metadata_dirs' => [
                __DIR__ . '/../../../../src/Module/Common/Domain/Entities',
                //__DIR__ . '/../../src/OAuth/Entity',
            ],
            'types' => [
                IdType::NAME => IdType::class
                //Auth\Entity\User\IdType::NAME => Auth\Entity\User\IdType::class,
                //Auth\Entity\User\EmailType::NAME => Auth\Entity\User\EmailType::class,
                //Auth\Entity\User\RoleType::NAME => Auth\Entity\User\RoleType::class,
                //Auth\Entity\User\StatusType::NAME => Auth\Entity\User\StatusType::class,
            ],
        ],
    ],
];