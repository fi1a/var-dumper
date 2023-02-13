<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

use ReflectionClass;
use ReflectionObject;

/**
 * Тип callable
 */
class ObjectNode extends AbstractNestedLevel implements NodeInterface, WithChildsInterface, NestedLevelInterface
{
    /**
     * @var object
     */
    protected $value;

    /**
     * @var KeyValueCollectionInterface|null
     */
    protected $collection;

    public function __construct(object $value)
    {
        $this->value = $value;
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

            $nodeValue = NodeFactory::factory($property->getValue($this->value));
            if ($nodeValue instanceof NestedLevelInterface) {
                $nodeValue->setMaxNestedLevel($this->maxNestedLevel)
                    ->setNestedLevel($this->nestedLevel + 1);
            }

            $this->collection[] = new KeyValue(
                $nodeValue,
                new StringNode($propertyName)
            );
        }

        return $this->collection;
    }
}
