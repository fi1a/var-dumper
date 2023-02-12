<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Handlers;

use Fi1a\VarDumper\Nodes\NodeInterface;

/**
 * Обработчик
 */
interface HandlerInterface
{
    /**
     * Обработчик
     */
    public function handle(NodeInterface $node, ?string $callPlace = null): void;
}
