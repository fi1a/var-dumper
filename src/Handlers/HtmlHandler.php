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

        echo '<div class="var-dumper"><pre>';

        switch ($node->getType()) {
            case NodeInterface::TYPE_STRING:
                $this->handleString($node);

                break;
            case NodeInterface::TYPE_INT:
                $this->handleInt($node);

                break;
            case NodeInterface::TYPE_FLOAT:
                $this->handleFloat($node);

                break;
            case NodeInterface::TYPE_BOOL:
                $this->handleBool($node);

                break;
        }

        if ($node instanceof CountableInterface) {
            $this->handleCountable($node);
        }

        echo '</pre></div>';
    }

    /**
     * Вывод строки
     *
     * @codeCoverageIgnore
     */
    protected function handleString(NodeInterface $node): void
    {
        echo '<span class="var-dumper-quotes">"</span>'
            . '<span class="var-dumper-string">' . $node->getValue() . '</span>'
            . '<span class="var-dumper-quotes">"</span>';
    }

    /**
     * Вывод bool
     *
     * @codeCoverageIgnore
     */
    protected function handleBool(NodeInterface $node): void
    {
        echo '<span class="var-dumper-bool">' . $node->getValue() . '</span>';
    }

    /**
     * Вывод int
     *
     * @codeCoverageIgnore
     */
    protected function handleInt(NodeInterface $node): void
    {
        echo '<span class="var-dumper-int">' . $node->getValue() . '</span>';
    }

    /**
     * Вывод float
     *
     * @codeCoverageIgnore
     */
    protected function handleFloat(NodeInterface $node): void
    {
        echo '<span class="var-dumper-float">' . $node->getValue() . '</span>';
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
