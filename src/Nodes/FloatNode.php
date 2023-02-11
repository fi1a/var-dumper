<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип float
 */
class FloatNode extends AbstractNode
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_FLOAT;
    }
}
