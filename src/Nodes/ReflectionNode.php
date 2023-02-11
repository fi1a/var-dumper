<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип reflection
 */
class ReflectionNode extends AbstractNode
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_REFLECTION;
    }
}
