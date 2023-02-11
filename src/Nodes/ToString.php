<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Преобразует к строковому представлению
 */
class ToString implements ToStringInterface
{
    /**
     * @inheritDoc
     */
    public function convert($value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_null($value)) {
            return 'null';
        }
        if (is_array($value)) {
            return 'array';
        }
        if (is_object($value) && !method_exists($value, '__toString')) {
            return get_class($value);
        }
        if ($value === 0) {
            return '0';
        }

        return (string) $value;
    }
}
