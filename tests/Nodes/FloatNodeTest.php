<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\FloatNode;
use Fi1a\VarDumper\Nodes\NodeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Тип float
 */
class FloatNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new FloatNode(100.10);
        $this->assertEquals(NodeInterface::TYPE_FLOAT, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $node = new FloatNode(100.10);
        $this->assertEquals('100.1', $node->getValue());
        $node = new FloatNode(0);
        $this->assertEquals('0', $node->getValue());
    }
}
