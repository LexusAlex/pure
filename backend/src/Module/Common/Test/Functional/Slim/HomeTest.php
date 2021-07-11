<?php

declare(strict_types=1);

namespace Test\Functional\Slim;

/**
 * @internal
 */
final class HomeTest extends WebTestCase
{
    public function testHomePage():void
    {
        self::assertCount(1,[1]);
    }
}