<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Фабрика
 */
interface FactoryInterface
{
    /**
     * Фабрика
     *
     * @param mixed $var
     */
    public function factory($var): NodeInterface;
}
