<?php

declare(strict_types=1);

namespace Fi1a\VarDumper;

use Fi1a\VarDumper\Handlers\HandlerInterface;
use Fi1a\VarDumper\Nodes\NodeInterface;

/**
 * Dump
 */
interface DumperInterface
{
    /**
     * Dump
     *
     * @param mixed $var
     */
    public function dump($var): NodeInterface;

    /**
     * Добавить обработчик
     */
    public function pushHandler(HandlerInterface $handler): void;
}
