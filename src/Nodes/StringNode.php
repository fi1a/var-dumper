<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип строка
 */
class StringNode extends AbstractNode implements CountableInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var OptionsInterface
     */
    protected $options;

    public function __construct(string $value, OptionsInterface $options)
    {
        $this->value = $value;
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_STRING;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        $value = $this->value;
        if ($this->options->getMaxLength() && $this->getCount() > $this->options->getMaxLength()) {
            $value = mb_substr($value, 0, $this->options->getMaxLength()) . ' <...>';
        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        return mb_strlen($this->value);
    }
}
