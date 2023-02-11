<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\ArrayNode;
use Fi1a\VarDumper\Nodes\BoolNode;
use Fi1a\VarDumper\Nodes\FloatNode;
use Fi1a\VarDumper\Nodes\IntNode;
use Fi1a\VarDumper\Nodes\NodeFactory;
use Fi1a\VarDumper\Nodes\NullNode;
use Fi1a\VarDumper\Nodes\StringNode;
use PHPUnit\Framework\TestCase;

/**
 * Фабрика
 */
class NodeFactoryTest extends TestCase
{
    /**
     * Провайдер данных
     *
     * @return array<array-key,array<array-key, mixed>>
     */
    public function dataProvider(): array
    {
        return [
            [StringNode::class, 'string'],
            [IntNode::class, 100],
            [FloatNode::class, 100.1],
            [BoolNode::class, true],
            [NullNode::class, null],
            [ArrayNode::class, [1, 2, 3]],
        ];
    }

    /**
     * Фабрика
     *
     * @param mixed $var
     *
     * @dataProvider dataProvider
     */
    public function testFactory(string $expected, $var): void
    {
        $this->assertInstanceOf($expected, NodeFactory::factory($var));
    }
}
