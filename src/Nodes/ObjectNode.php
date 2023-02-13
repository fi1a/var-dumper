<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

use ReflectionClass;
use ReflectionObject;

/**
 * Тип callable
 */
class ObjectNode implements NodeInterface, WithChildsInterface, NestedLevelInterface
{
    /**
     * @var object
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

    public function __construct(object $value, OptionsInterface $options)
    {
        $this->value = $value;
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_OBJECT;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        $reflection = new ReflectionClass($this->value);

        return $reflection->getName() . ' [' . spl_object_id($this->value) . ']';
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

        $keyOptions = clone $this->options;
        $keyOptions->setMaxLength(100);

        $reflection = new ReflectionObject($this->value);
        foreach ($reflection->getProperties() as $property) {
            if ($property->isPrivate() || $property->isProtected()) {
                $property->setAccessible(true);
            }
            $propertyName = '+';
            if ($property->isProtected()) {
                $propertyName = '#';
            }
            if ($property->isPrivate()) {
                $propertyName = '-';
            }
            if ($property->isStatic()) {
                $propertyName .= '::';
            }
            $propertyName .= (!$property->isDefault() ? '"' : '')
                . $property->getName()
                . (!$property->isDefault() ? '"' : '');

            $nodeValue = NodeFactory::factory($property->getValue($this->value), $this->options);
            if ($nodeValue instanceof NestedLevelInterface) {
                $nodeValue->setNestedLevel($this->nestedLevel + 1);
            }
            $nodeKey = new StringNode($propertyName, $keyOptions);

            $this->collection[] = new KeyValue($nodeValue, $nodeKey);
        }

        return $this->collection;
    }
}
