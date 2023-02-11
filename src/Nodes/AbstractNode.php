<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Абстрактный узел
 */
abstract class AbstractNode implements NodeInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return (string) $this->value;
    }
}
