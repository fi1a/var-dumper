<?php

declare(strict_types=1);

namespace Fi1a\VarDumper\Facades;

use Fi1a\Facade\AbstractFacade;
use Fi1a\VarDumper\Nodes\ToString;

/**
 * Преобразует к строковому представлению
 *
 * @method static string convert($value)
 */
class ToStringFacade extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function factory(): object
    {
        return new ToString();
    }
}
