<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Nodes;

use Fi1a\VarDumper\Nodes\IntNode;
use Fi1a\VarDumper\Nodes\KeyValue;
use Fi1a\VarDumper\Nodes\KeyValueCollection;
use Fi1a\VarDumper\Nodes\Options;
use Fi1a\VarDumper\Nodes\StringNode;
use PHPUnit\Framework\TestCase;

/**
 * Коллекция ключ-значений из узлов
 */
class KeyValueCollectionTest extends TestCase
{
    /**
     * Коллекция ключ-значений из узлов
     */
    public function testCollection(): void
    {
        $collection = new KeyValueCollection();
        $this->assertCount(0, $collection);
        $key = new StringNode('key1', new Options());
        $value = new IntNode(100);
        $keyValue = new KeyValue($value, $key);
        $collection[] = $keyValue;
        $key = new StringNode('key2', new Options());
        $value = new IntNode(200);
        $keyValue = new KeyValue($value, $key);
        $collection[] = $keyValue;
        $this->assertCount(2, $collection);
    }
}
