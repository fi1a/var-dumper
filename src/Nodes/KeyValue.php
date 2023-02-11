<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Определяет ключ-значение из узлов
 */
class KeyValue implements KeyValueInterface
{
    /**
     * @var NodeInterface
     */
    protected $key;

    /**
     * @var NodeInterface
     */
    protected $value;

    public function __construct(NodeInterface $key, NodeInterface $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getKey(): NodeInterface
    {
        return $this->key;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): NodeInterface
    {
        return $this->value;
    }
}
