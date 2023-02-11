<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\BoolNode;
use Fi1a\VarDumper\Nodes\NodeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Тип bool
 */
class BoolNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new BoolNode(true);
        $this->assertEquals(NodeInterface::TYPE_BOOL, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $node = new BoolNode(true);
        $this->assertEquals('true', $node->getValue());
        $node = new BoolNode(false);
        $this->assertEquals('false', $node->getValue());
    }
}
