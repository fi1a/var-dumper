<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Nodes;

/**
 * Параметры
 */
interface OptionsInterface
{
    /**
     * Максимальный уровень вложенности
     *
     * @return $this
     */
    public function setMaxNestedLevel(int $maxNestedLevel);

    /**
     * Максимальный уровень вложенности
     */
    public function getMaxNestedLevel(): int;

    /**
     * Максимальная длина
     *
     * @return $this
     */
    public function setMaxLength(int $maxLength);

    /**
     * Максимальная длина
     */
    public function getMaxLength(): int;

    /**
     * Максимальное кол-во элементов
     *
     * @return $this
     */
    public function setMaxCount(int $maxCount);

    /**
     * Максимальное кол-во элементов
     */
    public function getMaxCount(): int;
}
