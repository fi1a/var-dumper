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
    protected function setUp(): void
    {
        parent::setUp();
        ob_start();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        ob_end_clean();
    }

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
     * Вывод int
     */
    public function testHandleInt(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleInt', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleInt');

        $handler->handle(NodeFactory::factory(100));
    }

    /**
     * Вывод float
     */
    public function testHandleFloat(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleFloat', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleFloat');

        $handler->handle(NodeFactory::factory(100.1));
    }
}
