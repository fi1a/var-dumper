<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Тип array
 */
class ArrayNode implements NodeInterface, CountableInterface, WithChildsInterface
{
    /**
     * @var array<array-key, mixed>
     */
    protected $value;

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
        $collection = new KeyValueCollection();
        /**
         * @var mixed $key
         * @var mixed $value
         */
        foreach ($this->value as $key => $value) {
            $collection[] = new KeyValue(NodeFactory::factory($value), NodeFactory::factory($key));
        }

        return $collection;
    }
}
