<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\ResourceNode;
use PHPUnit\Framework\TestCase;

/**
 * Тип resource
 */
class ResourceNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new ResourceNode(fopen(__FILE__, 'r'));
        $this->assertEquals(NodeInterface::TYPE_RESOURCE, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $node = new ResourceNode(fopen(__FILE__, 'r'));
        $this->assertIsString($node->getValue());
    }
}
