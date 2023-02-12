<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\CallableNode;
use Fi1a\VarDumper\Nodes\NodeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Тип callable
 */
class CallableNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new CallableNode(function () {
        });
        $this->assertEquals(NodeInterface::TYPE_CALLABLE, $node->getType());
    }

    /**
     * Значение
     */
    public function testValue(): void
    {
        $node = new CallableNode(function () {
        });
        $this->assertIsString($node->getValue());
    }

    /**
     * Вложенные узлы
     */
    public function testChilds(): void
    {
        $node = new CallableNode(function ($a, ?string $b = null, TestCase $testCase, &$byRef) {
        });
        $this->assertCount(1, $node->getChilds());
        $node = new CallableNode([$this, 'testChilds']);
        $this->assertCount(1, $node->getChilds());
    }
}
