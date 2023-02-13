<?php

declare(strict_types=1);

use Fi1a\DI\Builder;
use Fi1a\VarDumper\Dumper;
use Fi1a\VarDumper\DumperInterface;
use Fi1a\VarDumper\Handlers\HtmlHandler;
use Fi1a\VarDumper\Nodes\Options;
use Fi1a\VarDumper\Nodes\OptionsInterface;

di()->config()->addDefinition(
    Builder::build(DumperInterface::class)
        ->defineFactory(function () {
            static $dumper;
            if ($dumper === null) {
                $dumper = new Dumper();

                $dumper->pushHandler(new HtmlHandler());
            }

            return $dumper;
        })
    ->getDefinition()
);

di()->config()->addDefinition(
    Builder::build(OptionsInterface::class)
    ->defineClass(Options::class)
    ->getDefinition()
);
