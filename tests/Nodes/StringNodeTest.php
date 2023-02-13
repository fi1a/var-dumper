<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\Options;
use Fi1a\VarDumper\Nodes\StringNode;
use PHPUnit\Framework\TestCase;

/**
 * Тип строка
 */
class StringNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new StringNode('string', new Options());
        $this->assertEquals(NodeInterface::TYPE_STRING, $node->getType());
    }

    /**
     * Значение
     */
    public function testVar(): void
    {
        $node = new StringNode('string', new Options());
        $this->assertEquals('string', $node->getValue());
    }

    /**
     * Кол-во
     */
    public function testCount(): void
    {
        $node = new StringNode('string', new Options());
        $this->assertEquals(6, $node->getCount());
    }

    /**
     * Длина строки
     */
    public function testMaxLength(): void
    {
        $options = new Options();
        $options->setMaxLength(2);
        $node = new StringNode('string', $options);
        $this->assertEquals('st <...>', $node->getValue());
    }
}
