<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\NullNode;
use PHPUnit\Framework\TestCase;

/**
 * Null
 */
class NullNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new NullNode(null);
        $this->assertEquals(NodeInterface::TYPE_NULL, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $node = new NullNode(null);
        $this->assertEquals('null', $node->getValue());
    }
}
