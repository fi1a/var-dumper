<?php

declare(strict_types=1);

namespace Fi1a\VarDumper;

use Fi1a\VarDumper\Handlers\HandlerInterface;
use Fi1a\VarDumper\Nodes\OptionsInterface;

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
    public function dump($var, OptionsInterface $options): void;

    /**
     * Добавить обработчик
     */
    public function pushHandler(HandlerInterface $handler): void;

    /**
     * Очистить обработчики
     */
    public function clearHandlers(): void;
}
