<?php

declare(strict_types=1);

namespace Test\Unit\Domain\Entities\User;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Pure\Module\Common\Domain\Entities\User\Types\Id;
use Ramsey\Uuid\Uuid;

final class IdTest extends TestCase
{
    public function testSuccess(): void
    {
        $id = new Id($value = Uuid::uuid4()->toString());

        self::assertEquals($value, $id->getValue());
    }

    public function testGenerate(): void
    {
        $id = Id::generate();

        self::assertNotEmpty($id->getValue());
    }

    public function testIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Id('12345');
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Id('');
    }
}