<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Уровень вложенности
 */
interface NestedLevelInterface
{
    /**
     *  Максимальный уровень вложенности
     *
     * @return $this
     */
    public function setMaxNestedLevel(int $maxNestedLevel);

    /**
     * Уровень вложенности
     *
     * @return $this
     */
    public function setNestedLevel(int $nestedLevel);
}
