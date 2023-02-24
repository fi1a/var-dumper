<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Имеет вложенные узлы
 */
interface WithChildsInterface
{
    /**
     * Возвращает вложенные узлы
     */
    public function getChildren(): KeyValueCollectionInterface;
}
