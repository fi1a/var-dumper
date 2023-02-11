<?php

declare(strict_types=1);

namespace Fi1a\VarDumper;

use Fi1a\VarDumper\Nodes\NodeInterface;

/**
 * Dump
 */
interface DumpInterface
{
    /**
     * Dump
     *
     * @param mixed $var
     */
    public function dump($var): NodeInterface;
}
