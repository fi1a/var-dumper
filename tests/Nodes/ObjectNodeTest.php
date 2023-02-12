<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\Unit\VarDumper\Fixtures\ClassFoo;
use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\ObjectNode;
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
        $node = new ObjectNode($object);
        $this->assertEquals(NodeInterface::TYPE_OBJECT, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $object = new stdClass();
        $node = new ObjectNode($object);
        $this->assertIsString($node->getValue());
    }

    /**
     * Вложенные узлы
     */
    public function testChilds(): void
    {
        $object = new ClassFoo();
        $object->dynA = 'string';
        $node = new ObjectNode($object);
        $this->assertCount(8, $node->getChilds());
    }
}
