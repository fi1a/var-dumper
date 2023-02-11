<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Узел
 */
interface NodeInterface
{
    /**
     * Возвращает тип
     */
    public function getType(): string;

    /**
     * Возвращает значение
     *
     * @return mixed
     */
    public function getValue();
}
