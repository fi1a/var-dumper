<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\ArrayNode;
use Fi1a\VarDumper\Nodes\NestedLevelInterface;
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
        $collection = $node->getChilds();
        $this->assertCount(3, $collection);
        $this->assertEquals($collection, $node->getChilds());
    }

    /**
     * Максимальный уровень вложенности
     */
    public function testMaxNestedLevel(): void
    {
        $array = [];
        $array[] = &$array;
        $node = new ArrayNode($array);
        $node->setMaxNestedLevel(5);

        do {
            $childs = $node->getChilds();
            $this->assertCount(1, $childs);
            $node = $childs->first()->getValue();
        } while ($node instanceof NestedLevelInterface);
    }
}
