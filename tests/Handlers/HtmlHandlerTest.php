<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Handlers;

use Fi1a\VarDumper\Handlers\HtmlHandler;
use Fi1a\VarDumper\Nodes\NodeFactory;
use Fi1a\VarDumper\Nodes\ObjectNode;
use Fi1a\VarDumper\Nodes\ReflectionNode;
use Fi1a\VarDumper\Nodes\ResourceNode;
use Fi1a\VarDumper\Nodes\StringNode;
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
            ->onlyMethods(['handleString', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleString');

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

    /**
     * Вывод bool
     */
    public function testHandleBool(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleBool', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleBool');

        $handler->handle(NodeFactory::factory(true));
    }

    /**
     * Вывод null
     */
    public function testHandleNull(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleNull', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleNull');

        $handler->handle(NodeFactory::factory(null));
    }

    /**
     * Вывод array
     */
    public function testHandleArray(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleArray', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleArray');

        $handler->handle(NodeFactory::factory([1, 2, 3]));
    }

    /**
     * Вывод callable
     */
    public function testHandleCallable(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleCallable', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleCallable');

        $handler->handle(NodeFactory::factory(function () {
        }));
    }

    /**
     * Вывод reflection
     */
    public function testHandleReflection(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleReflection', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleReflection');

        $handler->handle(new ReflectionNode('string'));
    }

    /**
     * Вывод object
     */
    public function testHandleObject(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleObject', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleObject');

        $handler->handle(new ObjectNode($this));
    }

    /**
     * Вывод resource
     */
    public function testHandleResource(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['handleResource', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('handleResource');

        $handler->handle(new ResourceNode(fopen(__FILE__, 'r')));
    }

    /**
     * Вывод места вызова
     */
    public function testCallPlace(): void
    {
        $handler = $this->getMockBuilder(HtmlHandler::class)
            ->onlyMethods(['callPlace', 'addAssets'])
            ->getMock();

        $handler->expects($this->once())->method('addAssets');
        $handler->expects($this->once())->method('callPlace');

        $handler->handle(new StringNode('test'), __FILE__);
    }
}
