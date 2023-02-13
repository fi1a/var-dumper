<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип array
 */
class ArrayNode implements NodeInterface, CountableInterface, WithChildsInterface, NestedLevelInterface
{
    /**
     * @var array<array-key, mixed>
     */
    protected $value;

    /**
     * @var KeyValueCollectionInterface|null
     */
    protected $collection;

    /**
     * @var OptionsInterface
     */
    protected $options;

    /**
     * @var int
     */
    protected $nestedLevel = 0;

    /**
     * @param array<array-key, mixed> $value
     */
    public function __construct(array $value, OptionsInterface $options)
    {
        $this->value = $value;
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_ARRAY;
    }

    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        return count($this->value);
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return 'array';
    }

    /**
     * @inheritDoc
     */
    public function setNestedLevel(int $nestedLevel): void
    {
        $this->nestedLevel = $nestedLevel;
    }

    /**
     * @inheritDoc
     */
    public function getChilds(): KeyValueCollectionInterface
    {
        if ($this->collection !== null) {
            return $this->collection;
        }

        $this->collection = new KeyValueCollection();

        if ($this->options->getMaxNestedLevel() && $this->nestedLevel > $this->options->getMaxNestedLevel()) {
            $this->collection[] = new KeyValue(new ImageNode('<...>'));

            return $this->collection;
        }

        $index = 0;
        /**
         * @var mixed $key
         * @var mixed $value
         */
        foreach ($this->value as $key => $value) {
            if ($this->options->getMaxCount() && $index >= $this->options->getMaxCount()) {
                $this->collection[] = new KeyValue(new ImageNode('<...>'));

                break;
            }
            $nodeValue = NodeFactory::factory($value, $this->options);
            if ($nodeValue instanceof NestedLevelInterface) {
                $nodeValue->setNestedLevel($this->nestedLevel + 1);
            }
            $this->collection[] = new KeyValue($nodeValue, NodeFactory::factory($key, $this->options));
            $index++;
        }

        return $this->collection;
    }
}
