<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Null
 */
class NullNode extends AbstractNode
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_NULL;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return 'null';
    }
}
