<?php

use function Pure\application;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

application();