<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Handlers;

use Fi1a\VarDumper\Nodes\CountableInterface;
use Fi1a\VarDumper\Nodes\NodeInterface;

/**
 * Html обработчик
 */
class HtmlHandler implements HandlerInterface
{
    /**
     * @var bool
     */
    protected static $addAssets = false;

    /**
     * @inheritDoc
     */
    public function handle(NodeInterface $node): void
    {
        $this->addAssets();

        switch ($node->getType()) {
            case NodeInterface::TYPE_STRING:
                $this->handleString($node);

                break;
        }

        if ($node instanceof CountableInterface) {
            $this->handleCountable($node);
        }
    }

    /**
     * Вывод строки
     *
     * @codeCoverageIgnore
     */
    protected function handleString(NodeInterface $node): void
    {
        echo '<span class="var-dumper-quotes">"</span>'
            . '<span class="var-dumper-string">' . (string) $node->getValue() . '</span>'
            . '<span class="var-dumper-quotes">"</span>';
    }

    /**
     * Вывод кол-ва
     *
     * @codeCoverageIgnore
     */
    protected function handleCountable(CountableInterface $node): void
    {
        echo ' <span class="var-dumper-count">(' . $node->getCount() . ')</span>';
    }

    /**
     * Добавление css
     *
     * @codeCoverageIgnore
     */
    protected function addAssets(): void
    {
        if (static::$addAssets) {
            return;
        }

        static::$addAssets = true;
        echo '<style>' . file_get_contents(__DIR__ . '/../../resources/html-handler-style.css') . '</style>';
    }
}
