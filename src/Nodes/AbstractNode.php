<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Абстрактный узел
 */
abstract class AbstractNode implements NodeInterface
{
    /**
     * @var bool
     */
    protected $byReference = false;

    /**
     * @inheritDoc
     */
    public function isByReference(): bool
    {
        return $this->byReference;
    }

    /**
     * @inheritDoc
     */
    public function setByReference(bool $byReference)
    {
        $this->byReference = $byReference;

        return $this;
    }
}
