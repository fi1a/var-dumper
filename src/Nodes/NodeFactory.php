<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

use LogicException;

/**
 * Фабрика
 */
class NodeFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public static function factory($var): NodeInterface
    {
        if (is_string($var)) {
            return new StringNode($var);
        } elseif (is_int($var)) {
            return new IntNode($var);
        } elseif (is_float($var)) {
            return new FloatNode($var);
        }

        // @codeCoverageIgnoreStart
        throw new LogicException('Неизвестный тип переменной');
        // @codeCoverageIgnoreEnd
    }
}
