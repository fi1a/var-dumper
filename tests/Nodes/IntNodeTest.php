<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\IntNode;
use Fi1a\VarDumper\Nodes\NodeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Тип int
 */
class IntNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new IntNode(100);
        $this->assertEquals(NodeInterface::TYPE_INT, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $node = new IntNode(100);
        $this->assertEquals('100', $node->getValue());
        $node = new IntNode(0);
        $this->assertEquals('0', $node->getValue());
    }
}
