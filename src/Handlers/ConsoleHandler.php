<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Handlers;

use Fi1a\Console\IO\ConsoleOutputInterface;
use Fi1a\Console\IO\Safe;
use Fi1a\Console\IO\Style\ANSIColor;
use Fi1a\Console\IO\Style\ANSIStyle;
use Fi1a\VarDumper\Nodes\CountableInterface;
use Fi1a\VarDumper\Nodes\KeyValueInterface;
use Fi1a\VarDumper\Nodes\NodeInterface;
use Fi1a\VarDumper\Nodes\WithChildsInterface;

use const PHP_EOL;

/**
 * Вывод в консоль
 */
class ConsoleHandler implements HandlerInterface
{
    /**
     * @var ConsoleOutputInterface
     */
    protected $output;

    public function __construct(ConsoleOutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @inheritDoc
     */
    public function handle(NodeInterface $node, ?string $callPlace = null): void
    {
        if ($callPlace) {
            $this->callPlace($callPlace);
        }
        $this->handleType($node);
        $this->output->writeln();
    }

    /**
     * Вывод места вызова
     *
     * @codeCoverageIgnore
     */
    protected function callPlace(string $callPlace): void
    {
        $this->output->writeln(Safe::escape($callPlace), [], new ANSIStyle(ANSIColor::LIGHT_YELLOW));
    }

    /**
     * Обработка типа узла
     */
    protected function handleType(NodeInterface $node, int $indent = 0, bool $newLine = true): void
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
            case NodeInterface::TYPE_IMAGE:
                $this->handleImage($node, $indent);

                break;
            case NodeInterface::TYPE_OBJECT:
                $this->handleObject($node);

                break;
            case NodeInterface::TYPE_RESOURCE:
                $this->handleResource($node);

                break;
        }

        if ($newLine) {
            $this->output->writeln();
        }
    }

    /**
     * Вывод строки
     *
     * @codeCoverageIgnore
     */
    protected function handleString(NodeInterface $node): void
    {
        $this->output->write('"', [], new ANSIStyle(ANSIColor::YELLOW));
        $this->output->write(Safe::escape($node->getValue()), [], new ANSIStyle(ANSIColor::GREEN));
        $this->output->write('"', [], new ANSIStyle(ANSIColor::YELLOW));

        if ($node instanceof CountableInterface) {
            $this->handleCountable($node);
        }
    }

    /**
     * Вывод кол-ва
     *
     * @codeCoverageIgnore
     */
    protected function handleCountable(CountableInterface $node): void
    {
        $this->output->write(' (' . $node->getCount() . ')', [], new ANSIStyle(ANSIColor::LIGHT_BLUE));
    }

    /**
     * Вывод int
     *
     * @codeCoverageIgnore
     */
    protected function handleInt(NodeInterface $node): void
    {
        $this->output->write($node->getValue(), [], new ANSIStyle(ANSIColor::LIGHT_BLUE));
    }

    /**
     * Вывод float
     *
     * @codeCoverageIgnore
     */
    protected function handleFloat(NodeInterface $node): void
    {
        $this->output->write($node->getValue(), [], new ANSIStyle(ANSIColor::LIGHT_BLUE));
    }

    /**
     * Вывод bool
     *
     * @codeCoverageIgnore
     */
    protected function handleBool(NodeInterface $node): void
    {
        $this->output->write($node->getValue(), [], new ANSIStyle(ANSIColor::LIGHT_MAGENTA));
    }

    /**
     * Вывод null
     *
     * @codeCoverageIgnore
     */
    protected function handleNull(NodeInterface $node): void
    {
        $this->output->write($node->getValue(), [], new ANSIStyle(ANSIColor::LIGHT_BLUE));
    }

    /**
     * Вывод array
     *
     * @codeCoverageIgnore
     */
    protected function handleArray(NodeInterface $node, int $indent): void
    {
        $this->output->write($node->getValue(), [], new ANSIStyle(ANSIColor::LIGHT_BLUE));

        if ($node instanceof CountableInterface) {
            $this->handleCountable($node);
        }
        $this->output->writeln(' [', [], new ANSIStyle(ANSIColor::YELLOW));
        if ($node instanceof WithChildsInterface) {
            /** @var KeyValueInterface $child */
            foreach ($node->getChilds() as $child) {
                $this->output->write(str_repeat('  ', $indent + 1));
                $key = $child->getKey();
                if ($key) {
                    $this->handleType($key, 0, false);
                    $this->output->write(' => ', [], new ANSIStyle(ANSIColor::WHITE));
                }
                $this->handleType($child->getValue(), $indent + 1);
            }
        }
        $this->output->write(str_repeat('  ', $indent));
        $this->output->write(']', [], new ANSIStyle(ANSIColor::YELLOW));
    }

    /**
     * Замыкания и методы
     *
     * @codeCoverageIgnore
     */
    protected function handleImage(NodeInterface $node, int $indent): void
    {
        $result = '';
        $images = explode(PHP_EOL, $node->getValue());
        foreach ($images as $index => $image) {
            if (count($images) > 1) {
                $result .= $index > 0 ? str_repeat('  ', $indent + 1) : str_repeat('  ', $indent);
            }
            $result .= $image . ($index < count($images) - 1 ? PHP_EOL : '');
        }

        $this->output->write(Safe::escape($result), [], new ANSIStyle(ANSIColor::YELLOW));
    }

    /**
     * Вывод callable
     *
     * @codeCoverageIgnore
     */
    protected function handleCallable(NodeInterface $node, int $indent): void
    {
        $this->output->write(Safe::escape($node->getValue()), [], new ANSIStyle(ANSIColor::LIGHT_BLUE));
        $this->output->write(' {', [], new ANSIStyle(ANSIColor::YELLOW));
        $this->output->writeln();

        if ($node instanceof WithChildsInterface) {
            /** @var KeyValueInterface $child */
            foreach ($node->getChilds() as $child) {
                $this->output->write('  ');
                $this->handleType($child->getValue(), $indent + 1);
            }
        }
        $this->output->write(str_repeat('  ', $indent));
        $this->output->write(' }', [], new ANSIStyle(ANSIColor::YELLOW));
    }

    /**
     * Вывод resource
     *
     * @codeCoverageIgnore
     */
    protected function handleResource(NodeInterface $node): void
    {
        $this->output->write(Safe::escape($node->getValue()), [], new ANSIStyle(ANSIColor::RED));
    }

    /**
     * Вывод object
     *
     * @codeCoverageIgnore
     */
    protected function handleObject(NodeInterface $node): void
    {
        $this->output->write($node->getValue(), [], new ANSIStyle(ANSIColor::LIGHT_BLUE));
        $this->output->write(' {', [], new ANSIStyle(ANSIColor::YELLOW));
        $this->output->writeln();
        if ($node instanceof WithChildsInterface) {
            /** @var KeyValueInterface $child */
            foreach ($node->getChilds() as $child) {
                $this->output->write('  ');
                $keyNode = $child->getKey();
                if ($keyNode) {
                    $this->output->write(Safe::escape($keyNode->getValue() . ': '));
                }
                $this->handleType($child->getValue(), 1);
            }
        }
        $this->output->write('}', [], new ANSIStyle(ANSIColor::YELLOW));
    }
}
