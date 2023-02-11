<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Определяет ключ-значение из узлов
 */
interface KeyValueInterface
{
    /**
     * Узел ключа
     */
    public function getKey(): NodeInterface;

    /**
     * Узел значения
     */
    public function getValue(): NodeInterface;
}
