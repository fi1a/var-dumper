<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\IntNode;
use Fi1a\VarDumper\Nodes\KeyValue;
use Fi1a\VarDumper\Nodes\Options;
use Fi1a\VarDumper\Nodes\StringNode;
use PHPUnit\Framework\TestCase;

/**
 * Определяет ключ-значение из узлов
 */
class KeyValueTest extends TestCase
{
    /**
     * Определяет ключ-значение из узлов
     */
    public function testKeyValue(): void
    {
        $key = new StringNode('key1', new Options());
        $value = new IntNode(100);
        $keyValue = new KeyValue($value, $key);
        $this->assertEquals($key, $keyValue->getKey());
        $this->assertEquals($value, $keyValue->getValue());
    }

    /**
     * Определяет ключ-значение из узлов
     */
    public function testKeyNull(): void
    {
        $value = new IntNode(100);
        $keyValue = new KeyValue($value);
        $this->assertNull($keyValue->getKey());
        $this->assertEquals($value, $keyValue->getValue());
    }
}
