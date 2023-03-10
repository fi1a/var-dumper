<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип bool
 */
class BoolNode extends AbstractNode
{
    /**
     * @var bool
     */
    protected $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_BOOL;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return $this->value === true ? 'true' : 'false';
    }
}
