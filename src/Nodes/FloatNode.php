<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип float
 */
class FloatNode extends AbstractNode
{
    /**
     * @var float
     */
    protected $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_FLOAT;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return (string) $this->value;
    }
}
