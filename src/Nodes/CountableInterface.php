<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Кол-во элементов
 */
interface CountableInterface
{
    /**
     * Возвращает кол-во элементов массива или длину строки
     */
    public function getCount(): int;
}
