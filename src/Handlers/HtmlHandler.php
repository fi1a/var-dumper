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
    public function handle(NodeInterface $node, ?string $callPlace = null): void
    {
        $this->addAssets();
        echo '<pre class="vd">';
        if ($callPlace) {
            $this->callPlace($callPlace);
        }
        $this->handleType($node);
        echo '</pre>';
    }

    /**
     * Вывод места вызова
     *
     * @codeCoverageIgnore
     */
    protected function callPlace(string $callPlace): void
    {
        echo '<span class="vd-call-place">@@ ' . $callPlace . '</span>' . PHP_EOL;
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
            case NodeInterface::TYPE_CALLABLE:
                $this->handleCallable($node, $indent);

                break;
            case NodeInterface::TYPE_REFLECTION:
                $this->handleReflection($node, $indent);

                break;
            case NodeInterface::TYPE_OBJECT:
                $this->handleObject($node);

                break;
            case NodeInterface::TYPE_RESOURCE:
                $this->handleResource($node);

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
        echo '<span class="vd-quotes">"</span>'
            . '<span class="vd-string">' . $node->getValue() . '</span>'
            . '<span class="vd-quotes">"</span>';

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
        echo '<span class="vd-bool">' . $node->getValue() . '</span>';
    }

    /**
     * Вывод null
     *
     * @codeCoverageIgnore
     */
    protected function handleNull(NodeInterface $node): void
    {
        echo '<span class="vd-null">' . $node->getValue() . '</span>';
    }

    /**
     * Вывод int
     *
     * @codeCoverageIgnore
     */
    protected function handleInt(NodeInterface $node): void
    {
        echo '<span class="vd-int">' . $node->getValue() . '</span>';
    }

    /**
     * Вывод float
     *
     * @codeCoverageIgnore
     */
    protected function handleFloat(NodeInterface $node): void
    {
        echo '<span class="vd-float">' . $node->getValue() . '</span>';
    }

    /**
     * Вывод resource
     *
     * @codeCoverageIgnore
     */
    protected function handleResource(NodeInterface $node): void
    {
        echo '<span class="vd-resource">' . $node->getValue() . '</span>';
    }

    /**
     * Вывод callable
     *
     * @codeCoverageIgnore
     */
    protected function handleCallable(NodeInterface $node, int $indent): void
    {
        echo '<span class="vd-callable">' . $node->getValue() . '</span>';
        echo ' <span class="vd-square">{</span>';
        $this->nodeDotts($indent === 0);
        $this->node($indent === 0);
        echo '<span class="vd-container '
            . ($indent === 0 ? 'vd-container-open' : 'vd-container-close')
            . '">';
        echo PHP_EOL;
        if ($node instanceof WithChildsInterface) {
            /** @var KeyValueInterface $child */
            foreach ($node->getChilds() as $child) {
                echo '    ';
                $this->handleType($child->getValue(), $indent + 1);
                echo PHP_EOL;
            }
        }
        echo str_repeat('    ', $indent);
        echo '</span>';
        echo '<span class="vd-square">}</span>';
    }

    /**
     * Вывод object
     *
     * @codeCoverageIgnore
     */
    protected function handleObject(NodeInterface $node): void
    {
        echo '<span class="vd-object">' . $node->getValue() . '</span>';
        echo ' <span class="vd-square">{</span>' . PHP_EOL;
        if ($node instanceof WithChildsInterface) {
            /** @var KeyValueInterface $child */
            foreach ($node->getChilds() as $child) {
                echo '    ';
                $keyNode = $child->getKey();
                if ($keyNode) {
                    echo $keyNode->getValue() . ': ';
                }
                $this->handleType($child->getValue(), 1);
                echo PHP_EOL;
            }
        }
        echo '<span class="vd-square">}</span>';
    }

    /**
     * Замыкания и методы
     *
     * @codeCoverageIgnore
     */
    protected function handleReflection(NodeInterface $node, int $indent): void
    {
        $result = '';
        $images = explode(PHP_EOL, $node->getValue());
        foreach ($images as $index => $image) {
            if (count($images) > 1) {
                $result .= $index > 0 ? str_repeat('    ', $indent + 1) : str_repeat('    ', $indent);
            }
            $result .= $image . ($index < count($images) - 1 ? PHP_EOL : '');
        }
        echo '<span class="vd-reflection">' . $result . '</span>';
    }

    /**
     * Вывод кол-ва
     *
     * @codeCoverageIgnore
     */
    protected function handleCountable(CountableInterface $node): void
    {
        echo ' <span class="vd-count">(' . $node->getCount() . ')</span>';
    }

    /**
     * Вывод array
     *
     * @codeCoverageIgnore
     */
    protected function handleArray(NodeInterface $node, int $indent): void
    {
        echo '<span class="vd-array">' . $node->getValue() . '</span>';

        if ($node instanceof CountableInterface) {
            $this->handleCountable($node);
        }

        echo ' <span class="vd-square">[</span>';
        $this->nodeDotts($indent === 0);
        $this->node($indent === 0);
        echo '<span class="vd-container '
            . ($indent === 0 ? 'vd-container-open' : 'vd-container-close')
            . '">';
        echo PHP_EOL;
        if ($node instanceof WithChildsInterface) {
            /** @var KeyValueInterface $child */
            foreach ($node->getChilds() as $child) {
                echo str_repeat('    ', $indent + 1);
                $key = $child->getKey();
                if ($key) {
                    $this->handleType($key);
                    echo '  <span class="vd-arrow">=></span>  ';
                }
                $this->handleType($child->getValue(), $indent + 1);
                echo PHP_EOL;
            }
        }
        echo str_repeat('    ', $indent);
        echo '</span>';
        echo '<span class="vd-square">]</span>';
    }

    /**
     * Стрелка для сворачивания/разворачивания
     *
     * @codeCoverageIgnore
     */
    protected function node(bool $open): void
    {
        echo '<span class="vd-node ' . ($open ? 'vd-expanded' : 'vd-collapsed') . '"></span>';
    }

    /**
     * Стрелка для сворачивания/разворачивания
     *
     * @codeCoverageIgnore
     */
    protected function nodeDotts(bool $open): void
    {
        echo '<span class="vd-dots '
            . ($open ? 'vd-expanded' : 'vd-collapsed')
            . '">...</span>';
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
        echo '<style>' . file_get_contents(__DIR__ . '/../../resources/html-handler.css') . '</style>';
        echo '<script>' . file_get_contents(__DIR__ . '/../../resources/html-handler.js') . '</script>';
    }
}
