<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\Options;
use Fi1a\VarDumper\Nodes\OptionsInterface;
use PHPUnit\Framework\TestCase;

class OptionsTest extends TestCase
{
    protected function getOptions(): OptionsInterface
    {
        return new Options();
    }

    /**
     * Максимальная длина
     */
    public function testMaxLength(): void
    {
        $options = $this->getOptions();
        $this->assertEquals(500, $options->getMaxLength());
        $options->setMaxLength(1);
        $this->assertEquals(1, $options->getMaxLength());
        $options->setMaxLength(-1);
        $this->assertEquals(-1, $options->getMaxLength());
    }

    /**
     * Максимальное кол-во
     */
    public function testMaxCount(): void
    {
        $options = $this->getOptions();
        $this->assertEquals(50, $options->getMaxCount());
        $options->setMaxCount(1);
        $this->assertEquals(1, $options->getMaxCount());
        $options->setMaxCount(-1);
        $this->assertEquals(-1, $options->getMaxCount());
    }

    /**
     * Максимальная вложенность
     */
    public function testMaxNestedLevel(): void
    {
        $options = $this->getOptions();
        $this->assertEquals(5, $options->getMaxNestedLevel());
        $options->setMaxNestedLevel(1);
        $this->assertEquals(1, $options->getMaxNestedLevel());
        $options->setMaxNestedLevel(-1);
        $this->assertEquals(-1, $options->getMaxNestedLevel());
    }
}
