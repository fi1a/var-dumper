<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

use Fi1a\VarDumper\Facades\ToStringFacade;
use ReflectionFunction;
use ReflectionMethod;

use const PHP_EOL;

/**
 * Тип callable
 */
class CallableNode extends AbstractNode implements WithChildsInterface
{
    /**
     * @var callable
     */
    protected $value;

    public function __construct(callable $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return self::TYPE_CALLABLE;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return 'callable';
    }

    /**
     * @inheritDoc
     */
    public function getChildren(): KeyValueCollectionInterface
    {
        $collection = new KeyValueCollection();

        $collection[] = new KeyValue(new ImageNode($this->getImage()));

        return $collection;
    }

    /**
     * Возвращает дополнительную информацию
     */
    protected function getImage(): string
    {
        if (is_array($this->value)) {
            $reflection = new ReflectionMethod($this->value[0], $this->value[1]);
            $resultName = is_string($this->value[0]) ? $this->value[0] : get_class($this->value[0]);
            $resultName .= $reflection->isStatic() ? '::' : '->';
            $resultName .= $reflection->getName();
        } else {
            /** @psalm-suppress ArgumentTypeCoercion */
            $reflection = new ReflectionFunction($this->value);
            $resultName = 'Closure';
        }

        $result = $resultName;
        $result .= ' (';
        $resultParameters = '';
        foreach ($reflection->getParameters() as $parameter) {
            $resultParameters .= ($resultParameters ? ', ' : '');
            if ($parameter->hasType()) {
                /** @var \ReflectionNamedType $parameterType */
                $parameterType = $parameter->getType();
                if ($parameterType->allowsNull()) {
                    $resultParameters .= '?';
                }
                $resultParameters .= $parameterType->getName() . ' ';
            }
            if ($parameter->isPassedByReference()) {
                $resultParameters .= '&';
            }
            $resultParameters .= '$' . $parameter->getName();
            if ($parameter->isDefaultValueAvailable()) {

                /** @var mixed $parameterDefaultValue */
                $parameterDefaultValue = $parameter->getDefaultValue();
                $resultParameters .= ' = ' . ToStringFacade::convert($parameterDefaultValue);
            }
        }
        $result .= $resultParameters;
        $result .= ')';
        $result .= ' {';
        $result .= PHP_EOL;
        $result .= '    @@ ' . $reflection->getFileName() . ':' . $reflection->getStartLine();
        if ($reflection->getStartLine() !== $reflection->getEndLine()) {
            $result .= '-' . $reflection->getEndLine();
        }
        $result .= PHP_EOL;
        $result .= '}';

        return $result;
    }
}
