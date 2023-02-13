<?php

declare(strict_types=1);

namespace Fi1a\VarDumper;

use Fi1a\VarDumper\Handlers\HandlerInterface;

/**
 * Выводит и оформляет информацию о переменной
 */
interface DumperInterface
{
    /**
     * Dump
     *
     * @param mixed $var
     */
    public function dump($var, ?int $maxNestedLevel = null): void;

    /**
     * Добавить обработчик
     */
    public function pushHandler(HandlerInterface $handler): void;

    /**
     * Очистить обработчики
     */
    public function clearHandlers(): void;
}
