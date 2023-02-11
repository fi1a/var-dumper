<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\ArrayNode;
use Fi1a\VarDumper\Nodes\NodeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Тип array
 */
class ArrayNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new ArrayNode([]);
        $this->assertEquals(NodeInterface::TYPE_ARRAY, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $node = new ArrayNode([]);
        $this->assertEquals('array', $node->getValue());
    }

    /**
     * Кол-во
     */
    public function testCount(): void
    {
        $node = new ArrayNode([1, 2, 3]);
        $this->assertEquals(3, $node->getCount());
    }

    /**
     * Вложенные узлы
     */
    public function testChilds(): void
    {
        $node = new ArrayNode([1, 2, 3]);
        $this->assertCount(3, $node->getChilds());
    }
}
