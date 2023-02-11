<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Преобразует к строковому представлению
 */
interface ToStringInterface
{
    /**
     * Преобразует к строковому представлению
     *
     * @param mixed $value
     */
    public function convert($value): string;
}
