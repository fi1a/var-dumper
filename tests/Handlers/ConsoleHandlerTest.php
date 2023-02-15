<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper\Handlers;

use Fi1a\Console\IO\ConsoleOutput;
use Fi1a\Console\IO\ConsoleOutputInterface;
use Fi1a\Console\IO\Formatter;
use Fi1a\Console\IO\Stream;
use Fi1a\VarDumper\Handlers\ConsoleHandler;
use Fi1a\VarDumper\Nodes\ImageNode;
use Fi1a\VarDumper\Nodes\NodeFactory;
use Fi1a\VarDumper\Nodes\ObjectNode;
use Fi1a\VarDumper\Nodes\Options;
use Fi1a\VarDumper\Nodes\ResourceNode;
use Fi1a\VarDumper\Nodes\StringNode;
use PHPUnit\Framework\TestCase;

/**
 * Html обработчик
 */
class ConsoleHandlerTest extends TestCase
{
    protected function getConsoleOutput(): ConsoleOutputInterface
    {
        $output = new ConsoleOutput(new Formatter());
        $output->setStream(new Stream(fopen('php://memory', 'w')));

        return $output;
    }

    /**
     * Вывод строки
     */
    public function testHandleString(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleString'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleString');

        $handler->handle(NodeFactory::factory('string', new Options()));
    }

    /**
     * Вывод int
     */
    public function testHandleInt(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleInt'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleInt');

        $handler->handle(NodeFactory::factory(100, new Options()));
    }

    /**
     * Вывод float
     */
    public function testHandleFloat(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleFloat'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleFloat');

        $handler->handle(NodeFactory::factory(100.1, new Options()));
    }

    /**
     * Вывод bool
     */
    public function testHandleBool(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleBool'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleBool');

        $handler->handle(NodeFactory::factory(true, new Options()));
    }

    /**
     * Вывод null
     */
    public function testHandleNull(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleNull'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleNull');

        $handler->handle(NodeFactory::factory(null, new Options()));
    }

    /**
     * Вывод array
     */
    public function testHandleArray(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleArray'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleArray');

        $handler->handle(NodeFactory::factory([1, 2, 3], new Options()));
    }

    /**
     * Вывод callable
     */
    public function testHandleCallable(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleCallable'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleCallable');

        $handler->handle(NodeFactory::factory(function () {
        }, new Options()));
    }

    /**
     * Вывод reflection
     */
    public function testHandleReflection(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleImage'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleImage');

        $handler->handle(new ImageNode('string'));
    }

    /**
     * Вывод object
     */
    public function testHandleObject(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleObject'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleObject');

        $handler->handle(new ObjectNode($this, new Options()));
    }

    /**
     * Вывод resource
     */
    public function testHandleResource(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleResource'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleResource');

        $handler->handle(new ResourceNode(fopen(__FILE__, 'r')));
    }

    /**
     * Вывод места вызова
     */
    public function testCallPlace(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['callPlace'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('callPlace');

        $handler->handle(new StringNode('test', new Options()), __FILE__);
    }

    /**
     * Вывод значения массива по ссылке
     */
    public function testByReference(): void
    {
        $handler = $this->getMockBuilder(ConsoleHandler::class)
            ->onlyMethods(['handleByReference'])
            ->setConstructorArgs([$this->getConsoleOutput()])
            ->getMock();

        $handler->expects($this->once())->method('handleByReference');

        $array = [1, 2, 3];
        $handler->handle(NodeFactory::factory([1, 2, 3, &$array], new Options()));
    }
}
