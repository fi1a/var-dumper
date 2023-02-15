<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип int
 */
class IntNode extends AbstractNode
{
    /**
     * @var int
     */
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_INT;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return $this->value === 0 ? '0' : (string) $this->value;
    }
}
