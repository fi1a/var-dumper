<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\NodeInterface;
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
        $node = new StringNode('string');
        $this->assertEquals(NodeInterface::TYPE_STRING, $node->getType());
    }

    /**
     * Значение
     */
    public function testVar(): void
    {
        $node = new StringNode('string');
        $this->assertEquals('string', $node->getValue());
    }
}
