<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Абстрактный класс с методами для уровня вложенности
 */
abstract class AbstractNestedLevel implements NestedLevelInterface
{
    /**
     * @var int
     */
    protected $maxNestedLevel = 1;

    /**
     * @var int
     */
    protected $nestedLevel = 1;

    /**
     * @inheritDoc
     */
    public function setMaxNestedLevel(int $maxNestedLevel)
    {
        $this->maxNestedLevel = $maxNestedLevel;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNestedLevel(int $nestedLevel)
    {
        $this->nestedLevel = $nestedLevel;

        return $this;
    }
}
