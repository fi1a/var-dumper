<?php

declare(strict_types=1);

namespace Fi1a\VarDumper;

use Fi1a\VarDumper\Handlers\HandlerInterface;
use Fi1a\VarDumper\Nodes\NodeFactory;
use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\OptionsInterface;

/**
 * Выводит и оформляет информацию о переменной
 */
class Dumper implements DumperInterface
{
    /**
     * @var HandlerInterface[]
     */
    protected $handlers = [];

    /**
     * @inheritDoc
     */
    public function dump($var, OptionsInterface $options): void
    {
        $callPlace = $this->getCallPlace();
        $node = NodeFactory::factory($var, $options);

        foreach ($this->handlers as $handler) {
            $this->handle($handler, $node, $callPlace);
        }
    }

    /**
     * @inheritDoc
     */
    public function pushHandler(HandlerInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    /**
     * @inheritDoc
     */
    public function clearHandlers(): void
    {
        $this->handlers = [];
    }

    /**
     * @codeCoverageIgnore
     */
    protected function handle(HandlerInterface $handler, NodeInterface $node, string $callPlace): void
    {
        $handler->handle($node, $callPlace);
    }

    /**
     * Возвращает место вызова
     */
    protected function getCallPlace(): string
    {
        $backtraces = debug_backtrace();
        array_shift($backtraces);
        $backtrace = null;
        foreach ($backtraces as $item) {
            if (
                (
                    isset($item['function']) && $item['function'] === 'dump'
                    && isset($item['class']) && $item['class'] === static::class
                )
                || (
                    isset($item['function']) && $item['function'] === 'dump'
                    && (!isset($item['class']))
                )
            ) {
                $backtrace = $item;
            }
        }

        return $backtrace ? $backtrace['file'] . ':' . $backtrace['line'] : '';
    }
}
