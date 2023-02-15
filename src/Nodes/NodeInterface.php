<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Узел
 */
interface NodeInterface
{
    public const TYPE_INT = 'int';

    public const TYPE_FLOAT = 'float';

    public const TYPE_STRING = 'string';

    public const TYPE_BOOL = 'bool';

    public const TYPE_NULL = 'null';

    public const TYPE_ARRAY = 'array';

    public const TYPE_OBJECT = 'object';

    public const TYPE_CALLABLE = 'callable';

    public const TYPE_RESOURCE = 'resource';

    public const TYPE_IMAGE = 'image';

    /**
     * Возвращает тип
     */
    public function getType(): string;

    /**
     * Возвращает значение
     */
    public function getValue(): string;

    /**
     * Ссылка или нет
     */
    public function isByReference(): bool;

    /**
     * Устанавливает значение ссылки
     *
     * @return $this
     */
    public function setByReference(bool $byReference);
}
