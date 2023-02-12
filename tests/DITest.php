<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper;

use Fi1a\VarDumper\DumperInterface;
use PHPUnit\Framework\TestCase;

/**
 * Dependency injection конфигурация
 */
class DITest extends TestCase
{
    /**
     * DumperInterface
     */
    public function testDumper(): void
    {
        $this->assertInstanceOf(DumperInterface::class, di()->get(DumperInterface::class));
    }
}
