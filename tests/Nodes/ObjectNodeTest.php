<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\Unit\VarDumper\Fixtures\ClassFoo;
use Fi1a\VarDumper\Nodes\NestedLevelInterface;
use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\ObjectNode;
use Fi1a\VarDumper\Nodes\Options;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Тип object
 */
class ObjectNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $object = new stdClass();
        $node = new ObjectNode($object, new Options());
        $this->assertEquals(NodeInterface::TYPE_OBJECT, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $object = new stdClass();
        $node = new ObjectNode($object, new Options());
        $this->assertIsString($node->getValue());
    }

    /**
     * Вложенные узлы
     */
    public function testChilds(): void
    {
        $object = new ClassFoo();
        $object->dynA = 'string';
        $node = new ObjectNode($object, new Options());
        $collection = $node->getChildren();
        $this->assertCount(8, $collection);
        $this->assertEquals($collection, $node->getChildren());
    }

    /**
     * Максимальный уровень вложенности
     */
    public function testMaxNestedLevel(): void
    {
        $object = new stdClass();
        $object->object = &$object;
        $node = new ObjectNode($object, new Options());

        do {
            $childs = $node->getChildren();
            $this->assertCount(1, $childs);
            $node = $childs->first()->getValue();
        } while ($node instanceof NestedLevelInterface);
    }
}
