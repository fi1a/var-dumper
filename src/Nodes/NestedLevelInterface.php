<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Уровень вложенности
 */
interface NestedLevelInterface
{
    /**
     * Уровень вложенности
     */
    public function setNestedLevel(int $nestedLevel): void;
}
