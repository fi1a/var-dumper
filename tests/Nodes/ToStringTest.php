<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Facades\ToStringFacade;
use PHPUnit\Framework\TestCase;

/**
 * Преобразует к строковому представлению
 */
class ToStringTest extends TestCase
{
    public function testConvertBool(): void
    {
        $this->assertEquals('true', ToStringFacade::convert(true));
        $this->assertEquals('false', ToStringFacade::convert(false));
    }

    public function testConvertNull(): void
    {
        $this->assertEquals('null', ToStringFacade::convert(null));
    }

    public function testConvertArray(): void
    {
        $this->assertEquals('array', ToStringFacade::convert([1, 2, 3]));
    }

    public function testConvertObject(): void
    {
        $this->assertEquals('Fi1a\Unit\VarDumper\Nodes\ToStringTest', ToStringFacade::convert($this));
    }

    public function testConvertZero(): void
    {
        $this->assertEquals('0', ToStringFacade::convert(0));
    }

    public function testConvertString(): void
    {
        $this->assertEquals('test', ToStringFacade::convert('test'));
    }
}
