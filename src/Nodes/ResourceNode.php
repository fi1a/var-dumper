<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип resource
 */
class ResourceNode extends AbstractNode
{
    /**
     * @var resource
     */
    protected $value;

    /**
     * @param resource $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_RESOURCE;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return 'resource(' . get_resource_id($this->value) . ', ' . get_resource_type($this->value) . ')';
    }
}
