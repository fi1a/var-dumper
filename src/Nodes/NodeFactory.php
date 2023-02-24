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
    public static function factory($var, OptionsInterface $options): NodeInterface
    {
        if (is_string($var)) {
            return new StringNode($var, $options);
        } elseif (is_int($var)) {
            return new IntNode($var);
        } elseif (is_float($var)) {
            return new FloatNode($var);
        } elseif (is_bool($var)) {
            return new BoolNode($var);
        } elseif (is_null($var)) {
            return new NullNode();
        } elseif (is_callable($var)) {
            return new CallableNode($var);
        } elseif (is_array($var)) {
            return new ArrayNode($var, $options);
        } elseif (is_object($var)) {
            return new ObjectNode($var, $options);
        } elseif (is_resource($var)) {
            return new ResourceNode($var);
        }

        // @codeCoverageIgnoreStart
        throw new LogicException('Неизвестный тип переменной');
        // @codeCoverageIgnoreEnd
    }
}
