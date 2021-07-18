<?php

declare(strict_types=1);

use Pure\Gateway\Console\Symfony\Commands\MailerCheckCommand;
use Pure\Gateway\Console\Symfony\Commands\TestCommand;

return [
    'config' => [
        'console' => [
            'commands' => [
                TestCommand::class,
                MailerCheckCommand::class
            ],
        ],
    ],
];