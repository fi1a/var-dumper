<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\ImageNode;
use Fi1a\VarDumper\Nodes\NodeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Image
 */
class ImageNodeTest extends TestCase
{
    /**
     * Тип
     */
    public function testType(): void
    {
        $node = new ImageNode('string');
        $this->assertEquals(NodeInterface::TYPE_IMAGE, $node->getType());
    }

    /**
     * Значение
     */
    public function testVar(): void
    {
        $node = new ImageNode('string');
        $this->assertEquals('string', $node->getValue());
    }
}
