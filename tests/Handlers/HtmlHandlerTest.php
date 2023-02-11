<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Handlers;

use Fi1a\VarDumper\Handlers\HtmlHandler;
use Fi1a\VarDumper\Nodes\NodeFactory;
use PHPUnit\Framework\TestCase;

/**
 * Html обработчик
 */
class HtmlHandlerTest extends TestCase
{
    /**
     * Вывод строки
     */
    public function testHandleString(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleString', 'handleCountable', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleString');
        $handler->expects($this->once())->method('handleCountable');

        $handler->handle(NodeFactory::factory('string'));
    }

    /**
     * Вывод строки
     */
    public function testHandleInt(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleInt', 'handleCountable', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleInt');

        $handler->handle(NodeFactory::factory(100));
    }
}
