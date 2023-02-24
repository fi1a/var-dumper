<?php

declare(strict_types=1);

use Fi1a\VarDumper\DumperInterface;
use Fi1a\VarDumper\Nodes\OptionsInterface;

/**
 * Выводит и оформляет информацию о переменной
 *
 * @param mixed ...$vars
 */
function dump(...$vars): void
{
    /** @var DumperInterface $dumper */
    $dumper = di()->get(DumperInterface::class);
    /** @var OptionsInterface $options */
    $options = di()->get(OptionsInterface::class);
    /** @var mixed $var */
    foreach ($vars as $var) {
        $dumper->dump($var, $options);
    }
}

/**
 * Выводит и оформляет информацию о переменной. Прекращает работу скрипта
 *
 * @param mixed ...$vars
 *
 * @codeCoverageIgnore
 */
function dumpDie(...$vars): void
{
    dump(...$vars);
    exit(1);
}
