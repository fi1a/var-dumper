<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Fixtures;

class ClassFoo
{
    public static $staticA;

    protected static $staticB = true;

    private static $staticC = [1, 2, 3];

    public $propertyA;

    protected $propertyB = 'string';

    private $propertyC = 1;

    private $propertyD;
}
