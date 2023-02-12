<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

use ReflectionClass;
use ReflectionObject;

/**
 * Тип callable
 */
class ObjectNode implements NodeInterface, WithChildsInterface
{
    /**
     * @var object
     */
    protected $value;

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
        $collection = new KeyValueCollection();

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
            $collection[] = new KeyValue(
                NodeFactory::factory($property->getValue($this->value)),
                new StringNode($propertyName)
            );
        }

        return $collection;
    }
}
