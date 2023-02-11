<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип строка
 */
class StringNode extends AbstractNode implements CountableInterface
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_STRING;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return (string) $this->value;
    }

    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        return mb_strlen((string) $this->value);
    }
}
