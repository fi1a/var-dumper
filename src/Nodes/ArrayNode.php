<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип array
 */
class ArrayNode extends AbstractNestedLevel implements
    NodeInterface,
    CountableInterface,
    WithChildsInterface,
    NestedLevelInterface
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
     * @param array<array-key, mixed> $value
     */
    public function __construct(array $value)
    {
        $this->value = $value;
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
    public function getChilds(): KeyValueCollectionInterface
    {
        if ($this->collection !== null) {
            return $this->collection;
        }

        $this->collection = new KeyValueCollection();

        if ($this->nestedLevel > $this->maxNestedLevel) {
            $this->collection[] = new KeyValue(new ReflectionNode('<...>'));

            return $this->collection;
        }

        /**
         * @var mixed $key
         * @var mixed $value
         */
        foreach ($this->value as $key => $value) {
            $nodeValue = NodeFactory::factory($value);
            if ($nodeValue instanceof NestedLevelInterface) {
                $nodeValue->setMaxNestedLevel($this->maxNestedLevel)
                    ->setNestedLevel($this->nestedLevel + 1);
            }
            $this->collection[] = new KeyValue($nodeValue, NodeFactory::factory($key));
        }

        return $this->collection;
    }
}
