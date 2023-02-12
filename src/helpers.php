<?php

declare(strict_types=1);

use Fi1a\VarDumper\DumperInterface;

/**
 * Выводит и оформляет информацию о переменной
 *
 * @param mixed $var
 */
function dump($var): void
{
    /** @var DumperInterface $dumper */
    $dumper = di()->get(DumperInterface::class);
    $dumper->dump($var);
}

/**
 * Выводит и оформляет информацию о переменной. Прекращает работу скрипта
 *
 * @param mixed $var
 *
 * @codeCoverageIgnore
 */
function dumpd($var): void
{
    dump($var);
    die;
}