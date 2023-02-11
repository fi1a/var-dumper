<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

use Fi1a\Collection\Collection;

/**
 * Коллекция ключ-значений из узлов
 */
class KeyValueCollection extends Collection implements KeyValueCollectionInterface
{
    /**
     * @inheritDoc
     */
    public function __construct(?array $data = null)
    {
        parent::__construct(KeyValueInterface::class, $data);
    }
}
