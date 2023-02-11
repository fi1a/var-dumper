<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Handlers;

use Fi1a\VarDumper\Nodes\CountableInterface;
use Fi1a\VarDumper\Nodes\KeyValueInterface;
use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\WithChildsInterface;

use const PHP_EOL;

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
        echo '<pre class="var-dumper">';
        $this->handleType($node);
        echo '</pre>';
    }

    /**
     * Обработка типа узла
     */
    protected function handleType(NodeInterface $node, int $indent = 0): void
    {
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
            case NodeInterface::TYPE_NULL:
                $this->handleNull($node);

                break;
            case NodeInterface::TYPE_ARRAY:
                $this->handleArray($node, $indent);

                break;
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
            . '<span class="var-dumper-string">' . $node->getValue() . '</span>'
            . '<span class="var-dumper-quotes">"</span>';

        if ($node instanceof CountableInterface) {
            $this->handleCountable($node);
        }
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
     * Вывод null
     *
     * @codeCoverageIgnore
     */
    protected function handleNull(NodeInterface $node): void
    {
        echo '<span class="var-dumper-null">' . $node->getValue() . '</span>';
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
     * Вывод array
     *
     * @codeCoverageIgnore
     */
    protected function handleArray(NodeInterface $node, int $indent = 0): void
    {
        echo '<span class="var-dumper-array">' . $node->getValue() . '</span>';

        if ($node instanceof CountableInterface) {
            $this->handleCountable($node);
        }

        echo ' <span class="var-dumper-square">[</span>' . PHP_EOL;
        if ($node instanceof WithChildsInterface) {
            /** @var KeyValueInterface $child */
            foreach ($node->getChilds() as $child) {
                echo str_repeat('    ', $indent + 1);
                $this->handleType($child->getKey());
                echo '  <span class="var-dumper-arrow">=></span>  ';
                $this->handleType($child->getValue(), $indent + 1);
                echo PHP_EOL;
            }
        }
        echo str_repeat('    ', $indent);
        echo '<span class="var-dumper-square">]</span>';
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
