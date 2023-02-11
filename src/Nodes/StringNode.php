<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип строка
 */
class StringNode extends AbstractNode
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
    public function getValue()
    {
        return $this->value;
    }
}
