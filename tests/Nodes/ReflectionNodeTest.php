<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\ReflectionNode;
use PHPUnit\Framework\TestCase;

/**
 * Reflection
 */
class ReflectionNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new ReflectionNode('string');
        $this->assertEquals(NodeInterface::TYPE_REFLECTION, $node->getType());
    }

    /**
     * Значение
     */
    public function testVar(): void
    {
        $node = new ReflectionNode('string');
        $this->assertEquals('string', $node->getValue());
    }
}
