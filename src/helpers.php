<?php

declare(strict_types=1);

use Fi1a\VarDumper\DumperInterface;
use Fi1a\VarDumper\Nodes\OptionsInterface;

/**
 * Выводит и оформляет информацию о переменной
 *
 * @param mixed $var
 */
function dump($var): void
{
    /** @var DumperInterface $dumper */
    $dumper = di()->get(DumperInterface::class);
    /** @var OptionsInterface $options */
    $options = di()->get(OptionsInterface::class);
    $dumper->dump($var, $options);
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
